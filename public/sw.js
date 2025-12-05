const CACHE_NAME = 'retell-cache-v4';

const STATIC_ASSETS = [
  '/manifest.webmanifest',
  '/favicon.ico',
];

// semua request HTML dilewatkan langsung ke server
function isHTML(request) {
  return request.headers.get('accept')?.includes('text/html');
}

self.addEventListener('install', event => {
  self.skipWaiting();
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(STATIC_ASSETS))
  );
});

self.addEventListener('activate', event => {
  self.clientsClaim();
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(keys.filter(k => k !== CACHE_NAME).map(k => caches.delete(k)))
    )
  );
});

self.addEventListener('fetch', event => {
  const req = event.request;

  // HTML = never cache
  if (isHTML(req)) {
    return event.respondWith(fetch(req).catch(() => caches.match('/')));
  }

  // non-HTML = cache normally
  event.respondWith(
    caches.match(req).then(cached =>
      cached ||
      fetch(req).then(res => {
        const clone = res.clone();
        caches.open(CACHE_NAME).then(cache => cache.put(req, clone));
        return res;
      })
    )
  );
});
