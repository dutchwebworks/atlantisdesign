if ('serviceWorker' in navigator && location.hostname !== '127.0.0.1' && location.hostname !== 'localhost') {
  window.addEventListener("load", () => {
    navigator.serviceWorker.register("/sw.js");
  });
}