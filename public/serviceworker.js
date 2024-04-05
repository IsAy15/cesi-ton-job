var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    "/",
    "/offline",
    "/css/general.css",
    "/js/welcome.js",
    "/images/icons/icon-72x72.png",
    "/images/icons/icon-96x96.png",
    "/images/icons/icon-128x128.png",
    "/images/icons/icon-144x144.png",
    "/images/icons/icon-152x152.png",
    "/images/icons/icon-192x192.png",
    "/images/icons/icon-384x384.png",
    "/images/icons/icon-512x512.png",
];

// Cache on install
self.addEventListener("install", (event) => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName).then((cache) => {
            return cache.addAll(filesToCache);
        })
    );
});

// Clear cache on activate
self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter(
                        (cacheName) =>
                            cacheName.startsWith("pwa-") &&
                            cacheName !== staticCacheName
                    )
                    .map((cacheName) => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache or Network
self.addEventListener("fetch", (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            // Cache hit - return response
            if (response) {
                return response;
            }

            // Clone the request because it's a stream and can be consumed once
            let fetchRequest = event.request.clone();

            return fetch(fetchRequest)
                .then((response) => {
                    // Check if we received a valid response
                    if (
                        !response ||
                        response.status !== 200 ||
                        response.type !== "basic"
                    ) {
                        return response;
                    }

                    // Clone the response because it's a stream as well
                    let responseToCache = response.clone();

                    caches.open(staticCacheName).then((cache) => {
                        cache.put(event.request, responseToCache);
                    });

                    return response;
                })
                .catch(() => {
                    return caches.match("offline");
                });
        })
    );
});
