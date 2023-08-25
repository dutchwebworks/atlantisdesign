// unobtrusive form validation

// reset form fields and reset functionality
function resetFields(wichform) {
	for(var i = 0; i<wichform.elements.length; i++) {
		var element = wichform.elements[i];
		if(element.type == "submit" || element.type == "reset") continue;
		if(!element.defaultValue) continue;
		element.onfocus = function() {
			if(this.value == this.defaultValue) {
				this.value = "";
			}
		}
		element.onblur = function() {
			if(this.value == "") {
				this.value = this.defaultValue;
			}
		}
	}
}

// check to see if field is filled
function isFilled(field){
	if(field.value.length < 1 || field.value == field.defaultValue) {
		return false;
	} else {
		return true;
	}
}

// validate URL
function isURL(field) {
	re = /^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i; // regular expression that checks for valid webaddress
	if(re.test(field.value)) {
		return true;
	} else {
		return false;
	}
}

// check to see if field contains email adres
function isEmail(field){
	re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; // regular expression that checks for valid email adress notation
	if(re.test(field.value)) {
		return true;
	} else {
		return false;
	}
}

// validate form
function validateForm(whichform) {
	for (var i=0; i<whichform.elements.length; i++) {
		var element = whichform.elements[i];
		
		// validate filled
		if(hasClassName(element, "validateRequired")) {
			if (!isFilled(element)) {
			
				if(attr(element, "title")) {
					alert(attr(element, "title"));
				} else {
					alert("Het invulveld \""+attr(element, "name")+"\" is verplicht.");
				}
				
				element.focus();
				element.select();				
				return false;
			}
		}

		// validate URL
		if(hasClassName(element, "validateUrl")) {
			if(isFilled(element) && !isURL(element)){
				if(attr(element, "title")) {
					alert(attr(element, "title"));
				} else {
					alert("Het invulveld \""+attr(element, "name")+"\" is verplicht en moet een correcte URL (webadres) bevatten.");
				}		
				
				element.focus();
				element.select();
				return false;				
			} 
		}
		
		// validate email
		if(hasClassName(element, "validateEmail")) {
			if (!isEmail(element)) {
			
				if(attr(element, "title")) {
					alert(attr(element, "title"));
				} else {
					alert("Het invulveld \""+attr(element, "name")+"\" is verplicht en moet een correct email adres bevatten.");
				}				
			
				element.focus();
				element.select();
				return false;
			}
		}
	}
	return true;
}

// prepare form element with proper functionality
function prepForms() {
	if(!document.getElementById) return false;
	if(!document.getElementsByTagName) return false;
	if(!id("contact")) return;

	for(var i=0; i<document.forms.length; i++) {
		var thisForm = document.forms[i];
		resetFields(thisForm);
		thisForm.onsubmit = function() {
		
			// old way
			//return validateForm(this);
			
			// re-route trough ajax
			if(validateForm(this)){
				var data = "";
				for (var i=0; i<this.elements.length; i++) {
					data+= this.elements[i].name;
					data+= "=";
					data+= escape(this.elements[i].value);
					data+= "&";
				}
				
				// send the form trough ajax
				return !sendPostForm(data);			
			} else {
				return false;
			}		
		}
	}
}
addLoadEvent(prepForms);