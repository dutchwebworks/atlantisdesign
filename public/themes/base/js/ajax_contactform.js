 // --------- common fuction --------- //

// create a XMLHttpObject / ajax object
function getHTTPObject(){
	var xhr = false;
	if(window.XMLHttpRequest) {
		xhr = new XMLHttpRequest();
	} else if (window.ActiveXObject){
		try {
			xhr = new ActiveXObject("MsXML2.SMLHTTP");			
		} catch(e) {
			try {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {
				xhr = false;
			}
		}
	}
	return xhr;
}

// loading animation, during ajax waiting
function displayLoading(element) {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	// set image
	var image = create("img");
	attr(image, "src", "/img/progressbar.gif");
	attr(image, "alt", "Bezig met verzenden");
	
	// insert
	var resultDiv = id("contactDisplay");
	append(resultDiv, image);
}

// display the ajax result

// !! This function is not used! Result is displayed by a PHP (HTML) string !!

function displayMessage(resultStatus, message) {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	var resultDiv = id("contactDisplay");
	
	// empty the div
	empty(resultDiv);
	
	var heading = create("h3");
	var para = create("p");
	
	switch(resultStatus) {
		case "succes":
			headingText = "Succesvol verstuurd";
			paraText = "Het formulier is succesvol verstuurd. Bedankt voor uw reactie.";
			break;
		case "failed":
			headingText = "Verwerkingsfout";
			paraText = "Fout in het verwerken van het formulier. Probeert u het later nogmaals.";
			break;
		default:
			headingText = "Server response";
			paraText = message;
			break;
	}
	
	// append text nodes
	append(heading, headingText);
	append(para, paraText);	
	
	// insert
	//append(resultDiv, heading);
	append(resultDiv, para);
}

// display the ajax result
function parseResponse(request) {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	var resultDiv = id("contactDisplay");
	
	if (request.readyState == 4) {
		if (request.status == 200 || request.status == 304) {
			
			// PHP (HTML) string result is displayed
			resultDiv.innerHTML = request.responseText;
			//displayMessage("succes", request.responseText);
		} else if(request.status == 404) {	
			resultDiv.innerHTML = "<h3>Ajax request status error 404</h1><p>File not found.</h3>";
			//displayMessage("failed", request.responseText);
		}
  }
}

// send the form
function sendPostForm(data) {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	var request = getHTTPObject();
	if (request) {
		// loading animation
		displayLoading(id("contactDisplay")); 
		
		// handle request
		request.onreadystatechange = function() {
		parseResponse(request);
		};
		request.open( "POST", "http://www.atlantisdesign.nl/atlantisMail.php", true ); // full path is apparently required by opera
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send(data+"&ajaxresponse=1");
		//request.send(data);
		return true;
	} else {
		return false;
	}
}

// --------- contact form actions --------- //

// prepare the form
function prepareContactForm() {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	id("contact").onsubmit = function(){
		var data = "ajaxresponse=1&";
		if(this.elements.length > 1) {
			for (var i=0; i<this.elements.length; i++) {
			  data+= this.elements[i].name;
			  data+= "=";
			  data+= escape(this.elements[i].value);
			  data+= "&";
			}
			return !sendPostForm(data);
		}
  	};
}

// Load event que
addLoadEvent(prepareContactForm);