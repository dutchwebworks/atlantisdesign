// common functions for Atlantisdesign.nl

// qued function loader for multiple window.onload functions
function addLoadEvent(func) {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	var oldOnLoad = window.onload;
	if(typeof window.onload != "function") {
		window.onload = func;
	} else {
		window.onload = function() {
			oldOnLoad();
			func();
		}
	}
}

// insert a YouTube .swf file using UFO
function loadSWF(youtubeUrl, divId){
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	
	var params = {
		wmode: "transparent",
		menu: "false"		
	};

	// load embed code in div ID
	swfobject.embedSWF(youtubeUrl, divId, "480", "395", "7.0.0","/swf/expressInstall.swf", false, params, false);
}

// get all 'youtube' classes from an  a-element and attach a youtube load function
function prepYouTubes() {
	if(!document.getElementsByTagName) return false;
	if(!document.getElementById) return false;

	var links = tag("a");
	for(var i = 0; i < links.length; i++) {
		if(hasClassName(links[i], "youtube")){
			links[i].onclick = function(){
				loadYouTubeSWF(attr(this, "href"), attr(this, "title"), true);
				return false;
			}
		}
	}
}

// load the YouTube video
function loadYouTubeSWF(youTubeUrl, title, scrollToAnchor){
	if(!document.getElementsByTagName) return false;
	if(!document.getElementById) return false;
	
	var playerDiv = "youTubePlayer";
	
	// set the title
	id("youTubeTitle").firstChild.nodeValue = title ? title : "No title";

	// load the UFO object with youtube url
	loadSWF(youTubeUrl, playerDiv);
	
	if(scrollToAnchor) window.location.hash = "youTubeTitle"; // jump to anchor
}

// put a 'rel' attribute on all a-elements wich don't have a img-element as child
// css wil add a icon on it
function prepExternalLinks() {
	var relName = "link";

	var links = tag("a");	
	for(var i = 0; i < links.length; i++) {
		var currentLink = links[i];
		if(attr(currentLink, "target") == "_blank") {
			attr(links[i], "rel", relName);
		}
	}
	
	var imgs = tag("img");	
	for(var j = 0; j < imgs.length; j++) {	
		var currentParent = theParent(imgs[j]);	
		if(attr(currentParent, "rel") == relName) {
			attr(currentParent, "rel", "")
		}
	}
	
}

// sIFR replacements
function sIFRLoad(){
	if(typeof sIFR == "function" && !sIFR.UA.bIsIEMac){
		sIFR.setup();
		sIFR.replaceElement(named({sSelector:"h1", sFlashSrc:"/swf/sifr-futura-condensed.swf", sWmode:"transparent", sColor:"#D64F20", sLinkColor:"", sHoverColor:"", sEmColor:"", sStrongColor:"", sSpanColor:"", nPaddingTop:0, nPaddingBottom:0, sFlashVars:"textalign=left&offsetTop=0"}));	
	};
}

// execute the following javascripts directly

// prep the youtube classes
addLoadEvent(prepYouTubes);

// prep external links
addLoadEvent(prepExternalLinks);

// prep external links
addLoadEvent(prepExternalLinks);


// alteranting row css-classes on tables with class="stripe"
addLoadEvent(stripeTable);