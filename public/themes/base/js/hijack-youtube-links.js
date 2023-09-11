document.addEventListener("DOMContentLoaded", () => {
	const tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	
	document.querySelector("body").append(tag);
});

var player;

function onYouTubeIframeAPIReady() {
	player = new YT.Player('youTubePlayer', {
		height: '390',
		width: '640',
		videoId: 'RTkuCXRZnyM'
	});
}