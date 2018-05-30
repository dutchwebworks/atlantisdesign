self.addEventListener("install", function(event){
	event.waitUntil(
		caches.open("assets")
			.then(function(cache){
				cache.addAll([
					"/",
					"/index.html",
					"/app.js",
					"/favicon.ico",
					"/img/atlantisdesign.svg",
					"/img/icon-128x128.png",
					"/img/icon-144x144.png",
					"/img/icon-152x152.png",
					"/img/icon-192x192.png",
					"/img/icon-384x384.png",
					"/img/icon-512x512.png",
					"/img/icon-72x72.png",
					"/img/icon-96x96.png",
					"https://fonts.googleapis.com/css?family=Roboto:300",
					"https://fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fBBc4AMP6lQ.woff2"
				])
			})		
	);
	return self.clients.claim();
});

self.addEventListener("fetch", function(event){
	event.respondWith(
		caches.match(event.request)
			.then(function(res){
				return res;
			})
	);
});