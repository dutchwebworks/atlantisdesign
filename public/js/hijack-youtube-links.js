document.addEventListener("DOMContentLoaded", () => {
	const tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";	
	document.querySelector("body").append(tag);

	const youTubeTitle = document.getElementById("youTubeTitle");

	document.querySelectorAll("[data-youtube-link]").forEach((item) => {
		item.addEventListener("click", (event) => {
			event.preventDefault();
			youTubeTitle.innerText = event.target.innerText;
			insertYouTubePlayer(getYouTubeId(event.target.href));
			document.location.href = "#youTubeTitle";
		});
	});
});

function getYouTubeId(url) {
	var video_id = url.split('v=')[1];
	var ampersandPosition = video_id.indexOf('&');
	if (ampersandPosition != -1) {
		video_id = video_id.substring(0, ampersandPosition);
	}
	return video_id;
}

function insertYouTubePlayer(videoId) {
	const playerId = "player";
	const ytId = document.createElement("div");
	ytId.id = playerId;
	const youTubePlayer = document.getElementById("youTubePlayer");
	youTubePlayer.innerHTML = "";
	youTubePlayer.append(ytId);

	new YT.Player(playerId, {
		height: '390',
		width: '640',
		videoId: videoId
	});
}

function onYouTubeIframeAPIReady() {
	insertYouTubePlayer("RTkuCXRZnyM");
}