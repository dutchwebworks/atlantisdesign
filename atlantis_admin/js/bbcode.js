// Javascript voor gebruik i.c.m: bbcode() functie

// globale bbcode tag
function addBBTag(bbtag, field){
	var input_field = eval("document.bbform."+field);
	
	// check to see if it's a heading tag starting with a: 'h'
	if(bbtag.charAt(0) == "h"){
		input_field.value += "\n\n["+bbtag+"][/"+bbtag+"]\n";
	} else{
		input_field.value += "["+bbtag+"][/"+bbtag+"]";
	}
}

// add link from pulldown and/or use input field name
function addBBUrl(url, label, field){
	var input_field = eval("document.bbform."+field);	
	var option_value = eval("document.bbform."+url+".value");
	
	// use input field as name or url specified
	if(eval("document.bbform."+label+".value")){
		var label_name = eval("document.bbform."+label+".value");
	} else{
		var label_name = eval("document.bbform."+url+".value");
	}	
	
	input_field.value += "\n[url="+option_value+"]"+label_name+"[/url]\n";
}

// add image tag from pulldown
function addBBImg(img, css_class, field){
	var input_field = eval("document.bbform."+field);
	
	var form = eval("document.bbform");
	for (var i = 0; i < form.css_class.length; i++) {
		if (form.css_class[i].checked) {
			break
		}
	}
	var checked = form.css_class[i].value;	
	
	var img_list = eval("document.bbform."+img+".value");
	input_field.value += "\n[img="+checked+"]"+img_list+"[/img]\n";
}


// add link from article pulldown
function addArticleURL(url, label, field){
	var input_field = eval("document.bbform."+field);	
	var option_value = eval("document.bbform."+url+".value");
	
	// use input field as name or url specified
	if(eval("document.bbform."+label+".value")){
		var label_name = eval("document.bbform."+label+".value");
	} else{
		var label_name = eval("document.bbform."+url+".value");
	}	
	
	input_field.value += "\n[article="+option_value+"]"+label_name+"[/article]\n";
}