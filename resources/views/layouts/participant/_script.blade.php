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

