// deze functie maakt een soort wachtrij aan voor
// body.onload functies die uitgevoerd moeten worden.
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

// deze functie zorgt ervoor dat het lijntje bij a-tags 'verwijderd' wordt voor Internet Explorer browsers
function onfocusBlur() {
	if(document.getElementsByTagName) { // check of de webbrowser dit snapt
		var links = document.getElementsByTagName("a"); // haal alle a-tags op
		for(var i=0; i<links.length; i++) { // loop ze allemaal af
			links[i].onfocus = function (){ // zet er een functie op
				this.blur(); // als je erop klikt, geef dan geen lijntje (blur)
			}
		}
	}
}

// hier wordt de onfocusBlur functie in de wachtrij gezet
// zodra de HTML pagina klaar is met laden wordt deze uitgevoerd
addLoadEvent(onfocusBlur);