const CACHE_NAME = 'theLast-v1';

const STATIC_ASSETS = [
    '/login',
    '/offline.html',
    '/manifest.json',
    '/css/app.css',
    '/js/app.js',
    '/icons/icon-192.png',
    '/icons/icon-512.png',
    '/images/bg.jpg',
    '/images/bg-1.jpg',
    'https://fonts.bunny.net/css?family=instrument-sans:400,500,600',
    'https://fonts.bunny.net',
    'https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css',
    'https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4',
];

// ✅ INSTALLATION
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return cache.addAll(STATIC_ASSETS);
        })
    );
    self.skipWaiting();
});

self.addEventListener('install', event => {
    self.skipWaiting(); // ⚠️ essentiel pour activer immédiatement le nouveau SW
});


// ✅ ACTIVATION : nettoyage ancien cache
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(
                keys.filter(key => key !== CACHE_NAME)
                    .map(key => caches.delete(key))
            )
        )
    );
});

self.addEventListener('fetch', event => {
    const { request } = event;
    const url = new URL(request.url);

    // Gestion spéciale pour les requêtes de navigation
    if (request.mode === 'navigate') {
        if (url.pathname.startsWith('/participant')) {
            // Cache dynamique des vues /participant/*
            event.respondWith(
                fetch(request)
                    .then(response => {
                        return caches.open(CACHE_NAME).then(cache => {
                            cache.put(request, response.clone());
                            return response;
                        });
                    })
                    .catch(() => {
                        return caches.match(request) || caches.match('/offline.html');
                    })
            );
            return;
        }

        // Pour les autres navigations HTML
        event.respondWith(
            fetch(request).catch(() => caches.match('/offline.html'))
        );
        return;
    }

    // Pour les assets statiques : cache-first
    event.respondWith(
        caches.match(request).then(cached => {
            return cached || fetch(request).then(response => {
                return caches.open(CACHE_NAME).then(cache => {
                    cache.put(request, response.clone());
                    return response;
                });
            }).catch(() => {
                if (request.destination === 'image') {
                    return caches.match('/images/bg.jpg');
                }
            });
        })
    );
});
