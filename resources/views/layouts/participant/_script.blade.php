<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js')
                .then(registration => {
                    console.log('✅ Service Worker enregistré avec succès:', registration.scope);
                })
                .catch(error => {
                    console.error('❌ Échec de l’enregistrement du Service Worker:', error);
                });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const loadingScreen = document.getElementById('loading-screen');
        const page = document.getElementById('page');

        window.addEventListener('beforeunload', function () {
            loadingScreen.classList.remove('hidden');
            page.classList.add('hidden');
        });
    });
</script>

<script>
if ('serviceWorker' in navigator && 'PushManager' in window) {
    window.addEventListener('load', () => {
        // Enregistre le service worker
        navigator.serviceWorker.register('/service-worker.js').then(registration => {
            console.log('Service Worker enregistré', registration);

            // Demande la permission de notification
            return Notification.requestPermission().then(permission => {
                if (permission !== 'granted') {
                    console.log('Permission de notification refusée');
                    return;
                }

                // S'abonner au push
                subscribeUserToPush(registration);
            });
        }).catch(err => {
            console.error('Erreur enregistrement service worker:', err);
        });
    });
}

async function subscribeUserToPush(registration) {
    try {
        // Récupère la clé publique VAPID depuis une variable Blade
        const vapidPublicKey = "{{ config('webpush.vapid.public_key') }}";

        // Convertit la clé VAPID de base64 en Uint8Array
        const convertedVapidKey = urlBase64ToUint8Array(vapidPublicKey);

        // S'abonne via PushManager
        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: convertedVapidKey,
        });

        // Envoie l'abonnement au serveur Laravel
        await sendSubscriptionToServer(subscription);

        console.log('Abonnement push réussi:', subscription);
    } catch (error) {
        console.error('Erreur lors de l\'abonnement push:', error);
    }
}

// Fonction utilitaire pour convertir la clé VAPID
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = atob(base64);
    return Uint8Array.from([...rawData].map(char => char.charCodeAt(0)));
}

// Envoie les données d'abonnement au backend via fetch
async function sendSubscriptionToServer(subscription) {
    // Récupère le token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch("{{ route('push.subscribe') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            endpoint: subscription.endpoint,
            publicKey: subscription.getKey('p256dh') ? btoa(String.fromCharCode(...new Uint8Array(subscription.getKey('p256dh'))) ) : null,
            authToken: subscription.getKey('auth') ? btoa(String.fromCharCode(...new Uint8Array(subscription.getKey('auth'))) ) : null,
        }),
        credentials: 'same-origin',
    });

    if (!response.ok) {
        throw new Error('Erreur lors de l\'enregistrement de l\'abonnement push');
    }

    return response.json();
}

</script>