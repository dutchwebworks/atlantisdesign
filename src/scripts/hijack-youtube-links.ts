export function initYouTubePlayer(): void {
    const scriptTag = document.createElement("script");
    scriptTag.src = "https://www.youtube.com/iframe_api";
    document.querySelector("body")!.append(scriptTag);

    const youTubeTitle: HTMLElement | null = document.getElementById("youTubeTitle");

    document.querySelectorAll("[data-youtube-link]").forEach((item) => {
        item.addEventListener("click", (event) => {
            event.preventDefault();
            const target = event.target as HTMLAnchorElement;
            if (youTubeTitle) youTubeTitle.innerText = target.innerText;
            insertYouTubePlayer(getYouTubeId(target.href));
            document.location.href = "#youTubeTitle";
        });
    });
}

function getYouTubeId(url: string): string {
    const video_id: string = url.split("v=")[1];
    const ampersandPosition: number = video_id.indexOf("&");
    if (ampersandPosition != -1) {
        return video_id.substring(0, ampersandPosition);
    }
    return video_id;
}

function insertYouTubePlayer(videoId: string): void {
    const playerId: string = "player";
    const ytId = document.createElement("div");
    ytId.id = playerId;
    const youTubePlayer: HTMLElement | null = document.getElementById("youTubePlayer");
    if (youTubePlayer) {
        youTubePlayer.innerHTML = "";
        youTubePlayer.append(ytId);
    }

    // @ts-ignore - YouTube API loaded externally
    new YT.Player(playerId, {
        height: "390",
        width: "640",
        videoId: videoId,
    });
}

// @ts-ignore - Global function for YouTube API
window.onYouTubeIframeAPIReady = () => {
    insertYouTubePlayer("RTkuCXRZnyM");
};
