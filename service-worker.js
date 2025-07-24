const CACHE = 'my-pwa-cache-v1';
const url = ['/', '/index.html', '/main.css', '/about.html', '/contacts.html', '/menu.html', '/obr.html'];
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE)
      .then((cache) => cache.addAll(url))
  );
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request)
      .then((response) => response || fetch(event.request))
  );
});