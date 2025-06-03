const CACHE_NAME = 'theLast-v1';

const STATIC_ASSETS = [
    '/participant/dashboard',
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

// ✅ FETCH : stratégie mixte
self.addEventListener('fetch', event => {
    const url = new URL(event.request.url);

    // Pour les ressources statiques
    if (STATIC_ASSETS.includes(url.href) || STATIC_ASSETS.includes(url.pathname)) {
        event.respondWith(
            caches.match(event.request).then(response => {
                return response || fetch(event.request);
            })
        );
        return;
    }

    // Pour certaines routes dynamiques (dashboard par ex.)
    if (url.pathname.startsWith('/participant/dashboard')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    return caches.open(CACHE_NAME).then(cache => {
                        cache.put(event.request, response.clone());
                        return response;
                    });
                })
                .catch(() => caches.match(event.request))
        );
        return;
    }

    // Pour le reste, stratégie network-first avec fallback
    event.respondWith(
        fetch(event.request).catch(() => {
            return caches.match(event.request).then(response => {
                return response || caches.match('/offline.html');
            });
        })
    );
});

