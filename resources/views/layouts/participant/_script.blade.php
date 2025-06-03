<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js')
                .then(registration => {
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

