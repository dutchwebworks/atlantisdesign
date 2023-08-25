/* menu dropdowns */

var nav_current = null, nav_hide_delay = null;
var incompetent_browser = document.all && navigator.userAgent.indexOf('MSIE') > -1 && navigator.userAgent.indexOf('Opera') == -1;

/* message box editing functions */

var target = null;
var name = null;
function initMessageBox(name)
{
	target = document.getElementById(name);
	if (target != null)
	{
		target.focus();
		if (typeof target.createTextRange != 'undefined')
		{
			target.onkeydown = shortkey;
			target.onkeyup = storeCursor;
			target.onclick = storeCursor;
			target.onselect = storeCursor;
			target.onselect();
		}
		else
		{
			target.onkeypress = shortkey;
		}
	}
}

function storeCursor()
{
	this.cursorPos = document.selection.createRange().duplicate();
}

function det_replace(type, text)
{
	var val = '';
	switch (type)
	{
		case 'plain':
			break;
		case 'AND':
			if (text != '')	text = text.replace(/(\w+)\s+/g, '$1 AND ');
			else text = ' AND ';
			break;
		case 'OR':
			if (text != '')	text = text.replace(/(\w+)\s+/g, '$1 OR ');
			else text = ' OR ';
			break;
		case 'brackets':
			if (text != '')	text = '('+text+')';
			else text = '()';
			break;
		case 'title':
			if (text != '')	text = 'title:('+text+')';
			else text = 'title:';
			break;
		case 'start':
			if (text != '')	text = 'start:('+text+')';
			else text = 'start:';
			break;
		case 'bold':
			text = '[b]'+text+'[/b]';
			break;
		case 'italic':
			text = '[i]'+text+'[/i]';
			break;
		case 'underline':
			text = '[u]'+text+'[/u]';
			break;
		case 'strike':
			text = '[strike]'+text+'[/strike]';
			break;
		case 'sub':
			text = '[sub]'+text+'[/sub]';
			break;
		case 'sup':
			text = '[sup]'+text+'[/sup]';
			break;
		case 'small':
			text = '[small]'+text+'[/small]';
			break;
		case 'left':
			text = '[div align="left"]'+text+'[/div]';
			break;
		case 'center':
			text = '[center]'+text+'[/center]';
			break;
		case 'right':
			text = '[div align="justify"]'+text+'[/div]';
			break;
		case 'listbullet':
			text = '[list]\r\n[*]'+(text.split(/\r?\n/).join('\r\n[*]'))+'\r\n[/list]';
			break;
		case 'listnum':
			text = '[list]\r\n[*]'+(text.split(/\r?\n/).join('\r\n[*]'))+'\r\n[/list]';
			break;
		case 'bgcolor':
			val = prompt('Voer een hexadecimale kleurcode in:','#');
			if (val !== null) text = '[bgcolor="'+val+'"]'+text+'[/bgcolor]';
			break;
		case 'color':
			val = prompt('Voer een hexadecimale kleurcode in:','#');
			if (val !== null) text = '[color="'+val+'"]'+text+'[/color]';
			break;
		case 'url':
			if (/^(http:\/\/|www\.)/i.test(text))
			{
				val = prompt('Voer omschrijving in:', text);
				if (val !== null && val != '') text = '[url='+text+']'+val+'[/url]';
			}
			else
			{
				val = prompt('Voer de URL in:','http:\/\/');
				if (val !== null && val != 'http:\/\/')
				{
					if (text == '') text = '[url='+val+']'+val+'[/url]';
					else text = '[url='+val+']'+text+'[/url]';
				}
			}
			break;
		case 'img':
			if (text == '')
			{
				val = prompt('Voer de URL in:','http:\/\/');
				if (val !== null && val != 'http:\/\/') text = '[img]'+val+'[/img]';
			}
			else
			{
				text = '[img src="'+text+'" /]';
			}
			break;
		case 'table':
			text = '[table]\r\n[tr]\r\n[td]'+(text.split(/\r?\n/).join('[/td]\r\n[/tr]\r\n[tr]\r\n[td]'))+'[/td]\r\n[/tr]\r\n[/table]';
			break;
		case 'hr':
			text += '[hr]';
			break;
		case 'kop':
			text = '[h1]' + text + '[/h1]';
			break;
		case 'kop2':
			text = '[h2]' + text + '[/h2]';
			break;	
		case 'kop3':
			text = '[h3]' + text + '[/h3]';
			break;
		case 'kop4':
			text = '[h4]' + text + '[/h4]';
			break;			
	}
	return text;
}

function putStr(text)
{
	putExt('plain', text);
}

function putExt(type, text)
{
	if (target != null)
	{
		if (typeof target.cursorPos != 'undefined')
		{
			var cursorPos = target.cursorPos;
			if (type != 'plain') text = cursorPos.text;
			cursorPos.text = det_replace(type, text);
		}
		else if (typeof target.selectionStart != 'undefined')
		{
			// remember scrollposition
			var scrollTop = target.scrollTop;

			var sStart = target.selectionStart;
			var sEnd = target.selectionEnd;
			if (type != 'plain') text = target.value.substring(sStart, sEnd);
			text = det_replace(type, text);
			target.value = target.value.substr(0, sStart) + text + target.value.substr(sEnd);
			var nStart = sStart == sEnd ? sStart + text.length : sStart;
			var nEnd = sStart + text.length;
			target.setSelectionRange(nStart, nEnd);

			// reset scrollposition
			target.scrollTop = scrollTop;
		}
		else
		{
			if (type != 'plain') text = '';
			target.value += det_replace(type, text);
		}

		target.focus();
		if (typeof target.cursorPos != 'undefined') target.onselect();
	}
}

function shortkey(e)
{
	if (!e) e = event;

	var key = 0;
	if (e.KeyCode) key = e.KeyCode;
	else if (e.which) key = e.which - 32;

	if (e.ctrlKey && !e.shiftKey)
	{
		switch (key)
		{
			case 66:
				putExt('bold');
				return cancelEvent(e);
			case 73:
				putExt('italic');
				return cancelEvent(e);
			case 83:
				putExt('strike');
				return cancelEvent(e);
			case 85:
				putExt('underline');
				return cancelEvent(e);
		}
	}

	return true;
}

if (incompetent_browser) document.onkeydown = function()
{
	var key = event.keyCode;
	var a = String.fromCharCode(key).toLowerCase();
	if (event.altKey && key > 64 && key < 91 && acckeys[a])
	{
		window.location.href = /^http:\/\//.test(acckeys[a]) ? acckeys[a] : board_script_url + acckeys[a];
		event.keyCode = 90; // use a valid keycode that is not in IE's context menu
		event.returnValue = 0;
		event.cancelBubble = true;
		return false;
	}
}

function cancelEvent(e)
{
	if (typeof e.preventDefault != 'undefined')
	{
		e.preventDefault();
	}
	else if (typeof e.cancelBubble != 'undefined')
	{
		if (e.keyCode) e.keyCode = 0;
		e.returnValue = 0;
		e.cancelBubble = true;
	}

	return false;
}


var showwarning = false;

function code_tags()
{
	var el = document.getElementsByTagName('table'), i = el.length, row, div, pre, img;

	while (i--)
	{
		if (el.item(i).className == 'phphighlight')
		{
			row = first_child(el.item(i));
			if (row.tagName.toLowerCase() != 'tr') row = first_child(row);
			div = first_child(row.childNodes.item(row.childNodes.length-1));
			if (!div || div.tagName.toLowerCase() != 'div') continue;
			div.style.paddingBottom = '0px';
			pre = first_child(div);
			if (!pre || (pre.tagName.toLowerCase() != 'pre' && pre.tagName.toLowerCase() != 'code')) continue;

			if (div.scrollWidth > div.clientWidth)
			{
				if (incompetent_browser)
				{
					div.orgPadding = (div.scrollHeight - div.clientHeight) + 'px';
					div.style.paddingBottom = div.orgPadding;
				}
				pre.style.width = div.scrollWidth + 'px';
				div.orgWidth = div.clientWidth;
				img = document.createElement('img');
				img.src = aopen.src;
				img.className = 'klipklap hand';
				img.onclick = klipklap_code;
				el.item(i).parentNode.insertBefore(img, node_before(node_before(el.item(i))));
			}
		}
	}

	// pre tags as well
	el = document.getElementsByTagName('div'), i = el.length;

	while (i--)
	{
		if (el.item(i).className == 'pre')
		{
			div = el.item(i);
			div.style.paddingBottom = '0px';
			pre = first_child(div);
			if (!pre || pre.tagName.toLowerCase() != 'pre') continue;

			if (div.scrollWidth > div.clientWidth)
			{
				if (incompetent_browser)
				{
					div.orgPadding = (div.scrollHeight - div.clientHeight) + 'px';
					div.style.paddingBottom = div.orgPadding;
				}
				pre.style.width = div.scrollWidth + 'px';
				div.orgWidth = div.clientWidth;
				img = document.createElement('img');
				img.src = aopen.src;
				img.className = 'klipklap hand';
				img.onclick = klipklap_pre;
				div.parentNode.insertBefore(img, div);
			}
		}
	}
}

var categories = [];
var messageids = [];
var klipklapcookie = [], skipcookie = true;