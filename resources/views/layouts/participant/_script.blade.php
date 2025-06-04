<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<script>
    let deferredPrompt = null;

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault(); // Empêche le prompt automatique
        deferredPrompt = e;

        const installButton = document.getElementById('install-button');
        if (installButton) {
            installButton.classList.remove('hidden');

            installButton.addEventListener('click', () => {
                installButton.disabled = true;
                deferredPrompt.prompt();

                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('L’utilisateur a accepté l’installation');
                    } else {
                        console.log('L’utilisateur a refusé l’installation');
                    }
                    deferredPrompt = null;
                    installButton.classList.add('hidden');
                });
            });
        }
    });

    // Masquer le bouton si l’app est déjà installée
    window.addEventListener('appinstalled', () => {
        console.log('PWA installée');
        const installButton = document.getElementById('install-button');
        if (installButton) {
            installButton.classList.add('hidden');
        }
    });

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js')
                .then(registration => {
                    console.log('test');
                    registration.onupdatefound = () => {
                        const newWorker = registration.installing;

                        newWorker.onstatechange = () => {
                            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                console.log('Nouvelle version installée, rechargement...');
                                // Recharge la page pour activer le nouveau SW
                                window.location.reload();
                            }
                        };
                    };
                })
                .catch(error => {
                    console.error('Échec de l’enregistrement du ServiceWorker:', error);
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

<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.8.1/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.8.1/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyAbv6K8xUZaaaPzoe3B0jezJJBQJshumbg",
        authDomain: "thelast-78c11.firebaseapp.com",
        projectId: "thelast-78c11",
        storageBucket: "thelast-78c11.firebasestorage.app",
        messagingSenderId: "1035734482610",
        appId: "1:1035734482610:web:29298cff5a0f69b91353ab",
        measurementId: "G-60F96PFSE9"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
</script>

<script type="module">
    import { initFirebaseMessagingRegistration } from '/js/firebase-messaging.js';
    window.addEventListener('load', () => {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/firebase-messaging-sw.js').then(() => {
                initFirebaseMessagingRegistration();
            });
        }
    });
</script>
