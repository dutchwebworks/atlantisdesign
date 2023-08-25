/* -- Function index

// Common functions

addLoadEvent(func);									// create a que of functions for window.onload
getQueryString();									// return a key/value array of the current URL query string
setItemMouseOver(obj, currentClass, addClass);		// create a rollover (hover) function on an 'obj' the 'addClass' css class wil act as the hover
addClass(element, value);							// add a class of 'value' to 'element'
appendClass(append, obj, currentClass, addClass)	// add, remove or check for a classname
ie6FixInputAttributeType();							// Win/IE6 doesn't understand css attribute-type selectors. Fix this by adding a css class like: textInput, submitInput to it
stripeTable();										// table alternating row colors: 'odd', 'even'. Table requires a <tbody>-tag
imgMouseHovers();									// Unobtrusive img rollover (hover) function: when rollover 'example.gif' becomes 'example_hover.gif'
preloadContent(url);								// preload: css, js, gif, jpg, png files

// Pro Javascript Techniques by John Resig

prev(elem);											// find previous element in relation to element
next(elem);											// find next element in relation to elem
first(elem);										// find first child element of elem
last(elem);											// find last child elemnt of elem
theParent(elem, num);								// find parent of elem, use 'num' to navigate up multipe parents at a time
id(name);											// get element by ID
tag(name, elem);									// find elemens by tagname, 'elem' is specific element or the whole document
hasClass(name, type);								// hassClass("myNav", "li"); find all element with specific class name of 'myNav' and html type is <li>
text(e);											// generic function for retrieving text contents of an element
hasAttribute(elem, name);							// check if element has a certain attribute
attr(elem, name, value);							// getting and setting elements attributes, third parameter is optional for SETTING a attribute value
hasClassName(elm, name);							// check if 'elem' has / contains a specified classname 'name'
				
create(elem);										// create element
before(parent, before, elem);						// insert element before another element
append(parent, elem);								// append an element as child to another element
checkElem(elem);									// helper function for before() and append() functions
				
remove(elem);										// remove node
empty(elem);										// remove all childeren of elem

-- */


// ---- Common functions


// qued function loader for window.onload
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

// create array of URL query string
function getQueryString() {
	var querystring = new Array;
 
	// parse current url into an array with the keys/values
	var q = String (document.location).split ('?')[1];
	
	// return if there is no url query string
	if (!q) return false;
	q = q.split ('&');
	
	for (var i = 0 ; i < q.length; i++)	{
		// for each key/value, split them at the '='
		// and add them to the qerystring array
		var o = q[i].split('=');
		
		// create the array and url decode the string
		querystring[o[0]] = unescape(o[1]);
	}
	
	// return the querystring
	return querystring;
}

// rollover div's functions
function setItemMouseOver(obj, currentClass, addClass){
	// get al div-tag's within id of obj
	var items = tag("div", id(obj));

	if(items){
		// loop trough
		for(var i = 0; i < items.length; i++){
			var itm = items[i];

			// check if contains classname
			if(hasClassName(itm, currentClass)) {
				itm.onmouseover = function(){
					appendClass("add", this, this.className, addClass);
					this.onmouseout = function(){
						appendClass("remove", this, this.className, addClass);
						this.onmouseout = null;
					}
				}
			}
		}
	}
}

// add a classname to an element
function addClass(element, value) {
	if(!element.className){
		element.className = value;
	} else {
		element.className += " "+value;
	}
}

// add, remove or check a class
function appendClass(append, obj, currentClass, addClass){
	switch (append){
		case "add":
		  if(!appendClass("check",obj,addClass)){obj.className+=obj.className?" "+addClass:addClass;}
		break;
		case "remove":
		  var rep=obj.className.match(" "+addClass)?" "+addClass:addClass;
		  obj.className=obj.className.replace(rep,"");
		break;
		case "check":
		  return new RegExp("\\b"+addClass+"\\b").test(obj.className);
		break;
 	}
}


// css attribute type selector fix for Win/IE6 via extra css classes
function ie6FixInputAttributeType(){
	var inputElements = tag("input");
	for (var i=0; i < inputElements.length; i++) appendClass("add", inputElements[i], null, inputElements[i].type+"Input");
}

// alternating css rows 'odd' & 'even', table requires a <tbody> tag!
function stripeTable(){
	// object detection, if it failes leave now
	if(!document.getElementsByTagName) return false;
	if(!document.getElementById) return false;
	
	// set initial
	var odd = true;	

	// get all tables with class 'stipe'
	var stripedTables = hasClass("stripe", "table");

	// loop trough all the striped tables
	for(st = 0; st < stripedTables.length; st++) {	

		// get all the tbody-tags
		var tbodies = tag("tbody", stripedTables[st]);
		
		// loop trough tbody-tags
		for(tb = 0; tb < tbodies.length; tb++) {
			
			// reset, begin with odd
			var odd = true;	
			
			// get all tr-tags
			var rows = tag("tr", tbodies[tb]);
			
			// loop trough all tr's
			for(tr = 0; tr < rows.length; tr++) {
				var currentRow = rows[tr];
				if(odd == true) {			
					// set class to current row
					appendClass("add", currentRow, null, "odd");
					odd = false;
				} else {
					// set class to current row
					appendClass("add", currentRow, null, "even");
					odd = true;
				}	
			}		
		}	
	}	
}

// create mouseover (hover) function on img class="imgHover"
// 'example.gif' hovers to 'example_hover.gif' in the same dir.
function imgMouseHovers(){

	// get all img tag's with class 'imgHover'
	var elmList = hasClass("imgHover", "img");
	
	// loop trough all img tag's
	for(var i=0;i<elmList.length;i++) {
		
		// create a current referer
		elm = elmList[i];
		
		// create new img
		elm.imgNormal = new Image();
		
		// set current src attribute
		attr(elm.imgNormal, "src", attr(elm, "src"));
		
		// create new img
		elm.imgHover = new Image();		
		
		// get its file extention: '.gif' or '.jpg' etc
		var imgExtention = attr(elm, "src").substring(attr(elm, "src").length -4);
		
		// create a var 'imgHover' and swap the img 'example.gif' to 'example_hover.gif'
		attr(elm.imgHover, "src", attr(elm, "src").replace(imgExtention, "_hover"+imgExtention));	
		
		// pun anonymous function on the current img
		elm.onmouseover = function() {				
			// set the src attribute to imgHover on mouse over
			attr(this, "src", attr(this.imgHover, "src"));
			this.onmouseout = function() {				
				// restore on mouse out
				attr(this, "src", attr(this.imgNormal, "src"));
				this.onmouseout = null;
			}
		}
	}
}

// simple universal css | js | jpg | gif | png preloader
function preloadContent(url) {
	
	// get the file extention of url
	var urlSplit = url.split(".");
	var fileExtention = urlSplit[urlSplit.length-1];
	
	if(fileExtention) {
		switch(fileExtention.toLowerCase()){
			case "css":
				// css file: append to HTML-HEAD
				var elem = create("link");
				attr(elem, "rel", "stylesheet");
				attr(elem, "type", "text/css");
				attr(elem, "href", url);
				append(tag("head")[0], elem);	
				break;
			case "js":
				// javascript file: append to HTML-BODY
				var elem = create("script");
				attr(elem, "type", "text/javascript");
				attr(elem, "language", "javascript");
				attr(elem, "src", url);
				append(tag("body")[0], elem);
				break;
			case "jpg":
			case "gif":
			case "png":
				// preload the image
				var elem = new Image();
				attr(elem, "src", url);
				attr(elem, "alt", "preloaded-image");		
				break;
			default :
				return;
		}
	}
}

// ---- Pro Javascript Techniques by John Resig

// find previous element in relation to element
function prev(elem){
	do {
		elem = elem.previousSibling;
	} while (elem && elem.nodeType != 1);
	return elem;
}

// find next element in relation to elem
function next(elem){
	do {
		elem = elem.nextSibling;
	} while (elem && elem.nodeType != 1);
	return elem;
}


// find first child element of elem
function first(elem){
	elem = elem.firstChild;
	return elem && elem.nodeType != 1 ? next(elem) : elem;
}

// find last child elemnt of elem
function last(elem) {
	elem . elem.lastChild;
	return elem && elem.nodeType != 1 ? prev(elem) : elem;
}

// find parent of elem, use 'num' to navigate up multipe parents at a time
// very strange but the function name 'parent()' is intefering with Firebug
function theParent(elem, num) {
	num = num || 1;
	for(var i = 0; i < num; i++) {
		if( elem != null) elem = elem.parentNode;
	}
	return elem;
}

// get element by ID
function id(name) {
	return document.getElementById(name);
}

// find elemens by tagname
function tag(name, elem){
	// if context of element is not provided, search the whole document
	return (elem || document).getElementsByTagName(name);
}

// find all element with specific class name
function hasClass(name, type){
    var r = [];
    // Locate the class name (allows for multiple class names)
    var re = new RegExp("(^|\\s)" + name + "(\\s|$)");
    
    // Limit search by type, or look through all elements
    var e = document.getElementsByTagName(type || "*");  
    for ( var j = 0; j < e.length; j++ ) {
        // If the element has the class, add it for return
        if ( re.test(attr(e[j], "class")) ) r.push( e[j] );
	}
    // Return the list of matched elements
    return r;
}

// generic function for retrieving text contents of an element
function text(e) {
	var t = "";
	// if an element was passed, get its childeren
	// otherwise assume it's an array
	e = e.childNodes || e;
	
	// look through all child noded
	for(var j = 0; j < e.length; j++) {
		// if it's not an element, append its text value
		// otherwise recurse through all the elemnt's childeren
        t += e[j].nodeType != 1 ?
            e[j].nodeValue : text(e[j].childNodes);
	}
	// return the matched text
	return t;
}

// check if element has a certain attribute
function hasAttribute(elem, name) {
	return elem.getAttribute(name) != null;
}

// getting and setting elements attributes
function attr(elem, name, value) {
	// make sure that a valid value name was provided
	if(!name || name.constructor != String) return '';
	
	// figure out if the name is one of the weird naming cases
	name = { 'for': 'htmlFor', 'class': 'className' }[name] || name;
	
	// if the user is setting a value, also
	if(typeof value != 'undefined') {
		// set the quick way first
		elem[name] = value;
		
		// if we can, use setAttribute
		if(elem.setAttribute) {
			elem.setAttribute(name, value);
		}
	}
	// return the value of the attribute
	return elem[name] || elem.getAttribute(name) || '';
}

// check if elm has / contains a specified classname
function hasClassName(elm, name) {
	return new RegExp('\\b'+name+'\\b').test(elm.className);
}



// ---- Modifying the DOM

// create element
function create(elem) {
	return document.createElementNS ? 
		document.createElementNS('http://www.w3.org/1999/xhtml', elem) : 
		document.createElement(elem);
}

// insert element before another element
function before(parent, before, elem){
	// check to see if no parent node was provided
	if(elem == null){
		elem = before;
		before = parent;
		parent = before.parentNode;
	}
	parent.insertBefore(checkElem(elem), before);
}

// append an element as child to another element
function append(parent, elem){
	parent.appendChild(checkElem(elem));
}

// helper function for before() and append() functions
function checkElem(elem) {
	// if only a string was provided, convert it into a Text Node
	return elem && elem.constructor == String ? 
		document.createTextNode(elem) : elem;
}

// ---- Removing nodes from the DOM

// remove node
function remove(elem){
	if(elem) elem.parentNode.removeChild(elem);
}

// remove all childs form elem
function empty(elem){
	while(elem.firstChild) {
		remove(elem.firstChild);
	}
}