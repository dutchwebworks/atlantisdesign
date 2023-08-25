// load the latetst youtube according to id=latetstYouTube
function latetstYouTube() {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	var currentLink = id("startYouTube");
	if(currentLink) {
		loadYouTubeSWF(attr(currentLink, "href"), attr(currentLink, "title"), false);
	}
}
// start with latetst youtube
addLoadEvent(latetstYouTube);