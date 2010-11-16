var agent=null;
var version=parseFloat(navigator.appVersion);
if(navigator.userAgent.indexOf(" MSIE ")>-1)
	agent="IE";
else if(navigator.userAgent.indexOf(" Firefox/")>-1)
	agent="FF";
else if(navigator.userAgent.indexOf(" Safari/")>-1)
	agent="SF";
else if(navigator.userAgent.indexOf("Opera/")>-1)
	agent="OP";

function removePathSpecialCharacters(v)
   {
      v = v.replace(/&/g, "and");
      v = v.replace(/ /g, "-");
      //v = v.replace(/-/g, "_");
      return v.replace(/[ .,;:'"*+=&^%$#@!?\~`]/gi, "");
   }	

function getClientBounds() {
	var clientWidth;
	var clientHeight;
	switch(agent) {
		case "IE":
			clientWidth = document.documentElement.clientWidth;
			clientHeight = document.documentElement.clientHeight;
			break;
		case "SF":
			clientWidth = window.innerWidth;
			clientHeight = window.innerHeight;
			break;
		case "OP":
			clientWidth = Math.min(window.innerWidth, document.body.clientWidth);
			clientHeight = Math.min(window.innerHeight, document.body.clientHeight);
			break;
		default:
			clientWidth = Math.min(window.innerWidth, document.documentElement.clientWidth);
			clientHeight = Math.min(window.innerHeight, document.documentElement.clientHeight);
			break;
	}
	return clientWidth + '|' + clientHeight;
}

function NewWindow(sURL, sWindowName, iWidth,iHeight, sScrollYesNo, sResizableYesNo){
	var fLeftPosition, fTopPosition;
	var sSettings;	
	
	fLeftPosition = (screen.width) ? (screen.width-iWidth)/2 : 0;
	fTopPosition = (screen.height) ? (screen.height-iHeight)/2 : 0;
	
	sSettings =
	'height='+ iHeight +',width='+ iWidth +',top='+ fTopPosition +',left='+ fLeftPosition +',scrollbars='+ sScrollYesNo +',resizable=' + sResizableYesNo
	
	window.open(sURL, sWindowName, sSettings)
}

function ShowDiv(name) {
    var divOverlay = document.getElementById(name);
    if (divOverlay != null) divOverlay.style.display = 'block';
}

function getElement(name) {
  return document.getElementById(name);
}

function HideDiv(name) {
    var divOverlay = document.getElementById(name);
    if (divOverlay != null) divOverlay.style.display = 'none';
}

function isCurrency(Field) {

	strValue = Field.value;

	regexp = /^(([0-9]{1,3}(\,[0-9]{3})*)|([0-9]{0,3}))(\.[0-9]{2})?$/

	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isFloat(Field) {

	strValue = Field.value;

	regexp = /^(\+|\-)?([0-9]+)(((\.|\,)?([0-9]+))?)$/

	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isInteger(Field) {
	strValue = getValue(Field);

	regexp = /^(\+|\-)?([0-9]+)$/
	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isUserName(Field) {
	strValue = getValue(Field);

	regexp = /^([^$@\\ ]+)$/
	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isEmail(Field) {
	strValue = getValue(Field);

	regexp = /^[A-Za-z0-9']+([\.\-]?[a-zA-Z0-9'_]+)*\@([A-Za-z0-9\-]+\.)+[A-Za-z]{2,5}$/

	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isEmptyFCK(Field) {
    var FieldId = Field.id + '_ccEditor';
	strValue = FCKeditorAPI.GetInstance(FieldId).GetXHTML();

	// delete all default tags
	rexp = /&nbsp;/gi;
	strValue = strValue.replace(rexp, '');
	rexp = /<p><\/p>/gi;
	strValue = strValue.replace(rexp, '');
	rexp = /<p>&nbsp;<\/p>/gi;
	strValue = strValue.replace(rexp, '');
	rexp = /\<br \/\>/gi;
	strValue = strValue.replace(rexp, '');
		
	if (isEmpty(strValue)) {
		return true;
	}
	return false;
}

function isNotEmptyFCK(val) {
	var ctrl = document.getElementById(val.controltovalidate);
	return !isEmptyFCK(ctrl);
}

function isURL(Field) {
	strValue = getValue(Field);
	
	regexp = /^http(s?):\/\/([^$@\\ ]+)$/i
	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isEmailList(Field) {
	strValue = getValue(Field);

	// delete all spaces near comma
	rexp = /, /gi;
	strValue = strValue.replace(rexp, ',');
	rexp = / ,/gi;
	strValue = strValue.replace(rexp, ',');
	strArray = strValue.split(",");

	regexp = /^[A-Za-z0-9']([\.\-]?[a-zA-Z0-9'_]+)*\@([A-Za-z0-9\-]+\.)+[A-Za-z]{2,5}$/

	for (var i=0; i < strArray.length; i++) {
		if (isEmpty(strArray[i])) return false;
		if (!regexp.test(strArray[i])) return false;
	}
	// set new field value (with removed spaces between comma and addresses)
	Field.value = strValue;
	return true;
}

function isZip(Field) {
	strValue = getValue(Field);

	if (isEmpty(strValue)) {
		return false;
	}

	if (strValue.indexOf('-') >=0 ) {
		regexp = /^\d{5}-\d{4}$/
	} else {
		regexp = /^\d{5}$/
	}

	return regexp.test(strValue);
}

function isPhone(Field) {
	strValue = getValue(Field);

	regexp = /^1{0,1} *(-| ){0,1} *[\(]*[0-9]{0,3}[\)]* *(-| ){0,1} *[0-9]{3} *(-| ){0,1} *[0-9]{4}$/;

	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isFax(Field) {
	strValue = getValue(Field);

	regexp = /^\d{3}-\d{3}-\d{4}$/
	if (isEmpty(strValue)) {
		return false;
	}
	return regexp.test(strValue);
}

function isEmpty(s) {
	if (s == null || trim(s) == '') {
		return true;
	}
	else {
		return false;
	}
}

function isText(f) {
	return !isEmptyField(f);
}

function isNotEmptyDate(val) {
    return !isEmptyDate(val);
}

function isNotEmptyTime(val) {
    return !isEmptyTime(val);
}

function isEmptyDate(val) {
	var ctrl = document.getElementById(val.controltovalidate + '_cal');
	return isEmptyField(ctrl);
}

function isEmptyTime(val) {
	var ctrl_h = document.getElementById(val.controltovalidate + '_H');
	var ctrl_m = document.getElementById(val.controltovalidate + '_M');
	var ctrl_ampm = document.getElementById(val.controltovalidate + '_AMPM');
        
    if (ctrl_h.selectedIndex == 0) return true;
    if (ctrl_m.selectedIndex == 0) return true;
    if (ctrl_ampm.selectedIndex == 0) return true;

	return false;
}

function isValidDate(val) {
	var ctrl = document.getElementById(val.controltovalidate + '_cal');
	return isDate(ctrl);
}

function isValidTime(val) {    
	var ctrl_h = document.getElementById(val.controltovalidate + '_H');
	var ctrl_m = document.getElementById(val.controltovalidate + '_M');
	var ctrl_ampm = document.getElementById(val.controltovalidate + '_AMPM');
                
    if (ctrl_h.selectedIndex == 0 && ctrl_m.selectedIndex == 0 && ctrl_ampm.selectedIndex == 0) return true;
    if (ctrl_h.selectedIndex == 0) return false;
    if (ctrl_m.selectedIndex == 0) return false;
    if (ctrl_ampm.selectedIndex == 0) return false;

	return true;
}

function isDate(Field) {
	if (isEmptyField(Field)) return true;

    var dtArray = Field.value.split('/');
    if (dtArray.length != 3) return false;
	return CheckDate(dtArray[0],dtArray[1],dtArray[2]);
}

function CheckDate(m,d,y) {
	Months = "31/!/28/!/31/!/30/!/31/!/30/!/31/!/31/!/30/!/31/!/30/!/31";
	MonthArray  = Months.split("/!/");

	if (isNaN(parseInt(m,10))) return false;
	if (isNaN(parseInt(d,10))) return false;
	if (isNaN(parseInt(y,10))) return false;

    if (d != parseInt(d,10)) return false;
    if (m != parseInt(m,10)) return false;
    if (y != parseInt(y,10)) return false;

	d = parseInt(d,10);
	m = parseInt(m,10);
	y = parseInt(y,10);

	y = convertYear(y);
	
	if (y <= 1900 ) return false;
	if (y >= 2100 ) return false;
	if (m < 1 || m > 12 ) return false;
	if ( isLeapYear(y)) MonthArray[1] = eval(eval(MonthArray[1]) + 1);

	if (d<1 || MonthArray[m-1] < d ) return false;
	return true;
}

function convertYear(y) {
	var borderYEAR = 40;

	yearvalue = parseInt(y,10);
	if (isNaN(yearvalue)) return y;

	if (yearvalue - borderYEAR <= 0) {
		yearvalue = yearvalue + 2000
	} else if (yearvalue - 100 < 0) {
		yearvalue = yearvalue + 1900
	}

	return yearvalue;
}

function isLeapYear(Year)
{
	if(Math.round(Year/4) == Year/4){
		if(Math.round(Year/100) == Year/100){
			if(Math.round(Year/400) == Year/400)
				return true;
			else return false;
		}else return true;
	}
	return false;
}

function getValue(Field) {
	fieldType = Field.type;

	if (fieldType == "text") {
		return getTextValue(Field);
	} else if (fieldType == "hidden") {
		return getTextValue(Field);
	} else if (fieldType == "select-one") {
		return getListValue(Field);
	} else if (fieldType == "textarea") {
		return getTextValue(Field);
	} else if (fieldType == "file") {
		return getTextValue(Field);
	} else if (fieldType == "password") {
		return getTextValue(Field);
	} else if (fieldType == "checkbox") {
		return getCheckboxValue(Field);
	} else if (isNaN(fieldType)) {
		return getRadioValue(Field);
	} else {
		return getTextValue(Field);
	}
}

function getListValue(Field) {
	return Field[Field.selectedIndex].value;
}

function getTextValue(Field) {
	return Field.value;
}

function getCheckboxValue(Field) {

	if (Field.checked) return Field.value;
	return '';
}

function getRadioValue(Field) {
	found = false;

	if(isNaN(Field.length)) {
		return Field.value;
	}

	for(var i=0; i< Field.length; i++) {
		if ( Field[i].checked ) {
			return Field[i].value;
			break;
		}
	}
	return !found;
}

function trim(str) {
	while (str.substring(0,1) == " ") {
		str = str.substring(1,str.length);
	}
	while (str.substring(str.length-1,str.length) == " ") {
		str = str.substring(0,str.length-1);
	}
	return str;
}

function isEmptyList(Field) {
	return isEmpty(Field[Field.selectedIndex].value);
}

function isEmptyText(Field) {
	return isEmpty(Field.value)
}

function isEmptyCheckbox(Field) {
	return !Field.checked;
}

function isEmptyField(Field) {
	fieldType = Field.type;

	if (fieldType == "text") {
		return isEmptyText(Field);
	} else if (fieldType == "hidden") {
		return isEmptyText(Field);
	} else if (fieldType == "file") {
		return isEmptyText(Field);
	} else if (fieldType == "select-one") {
		return isEmptyList(Field);
	} else if (fieldType == "textarea") {
		return isEmptyText(Field);
	} else if (fieldType == "password") {
		return isEmptyText(Field);
	} else if (fieldType == "checkbox") {
		return isEmptyCheckbox(Field)
	} else if (isNaN(fieldType)) {
		return isEmptyRadio(Field)
	} else {
		return isEmptyText(Field);
	}
}

function isDefined(obj) {

	if(typeof(obj) == "undefined") {
          return false;
	} else {
          return true;
	}
}

function isEmptyRadio(Field) {
	found = false;

	if(isNaN(Field.length)) {
		return !Field.checked;
	}	

	for(var i=0; i< Field.length; i++) {
		if ( Field[i].checked ) {
			found = true;
			break;
		}
	}	
	return !found;
}

function isNotEmptyFile(val) {
    return !isEmptyFile(val);
}

function isEmptyFile(val) {
    var oid, fid, cid, bDelChecked = false;
       
    oid = document.getElementById(val.controltovalidate + '_OLD');
    fid = document.getElementById(val.controltovalidate + '_FILE');
    cid = document.getElementById(val.controltovalidate + '_CHK');
    
    if (cid != null) { bDelChecked = cid.checked; }

    return (isEmptyField(oid) && isEmptyField(fid) || isEmptyField(fid) && bDelChecked);
}

function isNotEmptyCheckBoxList(val) {
    var parent = document.getElementById(val.controltovalidate);
    var checkboxes = parent.getElementsByTagName('INPUT');
    var checked = false;
    for(var i=0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) return true;
    }    
    return false;
}

function isValidFile(val) {
    if (isEmptyFile(val)) return true;
    
    var fid = document.getElementById(val.controltovalidate + '_FILE');
    if (isEmptyField(fid)) return true;

    var filename = getValue(fid);
    var lastDot = filename.lastIndexOf(".")
    
    if (lastDot == -1) return false;
            
    var ext = filename.substring(lastDot+1,filename.length);
    filename = filename.substring(0,lastDot);
    
    if (filename == '') return false;
            
    var aExtensions = val.extensions.split(",");
        
    for (i=0; i < aExtensions.length; i++) {
        if (aExtensions[i] == ext.toLowerCase()) return true;
    }
    return false;
}

function limit(fname, width, maxChar) {
	var ta1, ta2, d; 

	d = document.getElementById(fname + 'DIV');
	if ( maxChar < 1 ) {
		d.innerHTML = "";
		return;
	}

	ctrl = document.getElementById(fname + '_ctrl');

	x = maxChar - ctrl.value.length;
	if (x < 0) {
		ctrl.value = ctrl.value.substring(0, maxChar); x = 0; 
	}
	ta1 = document.getElementById(fname + 'TA1');
	ta1.style.width = Math.floor(width*(maxChar-x)/maxChar) + 'px';
	ta1.alt = maxChar-x+" chars used";
	ta2 = document.getElementById(fname + 'TA2');
	ta2.style.width = Math.floor(width*x/maxChar) + 'px';
	ta2.alt = x + " chars available";
	d.innerHTML = x + " characters left ";

	window.status = ta1.width + " : " + ta2.width;
}

var ctrl_to_disable;
var msg_to_display;

function PleaseWait(ctrl,msg) {
	msg ? msg_to_display = msg : msg_to_display = 'Please wait...';
    ctrl_to_disable = ctrl
    window.setTimeout("PleaseWaitTimeout()", 10);
}

function PleaseWaitImageButton(ctrl) {
    ctrl_to_disable = ctrl
    window.setTimeout("PleaseWaitTimeout()", 10);     
}

function PleaseWaitTimeout(ctrlid) {

    if (ctrl_to_disable.type == 'image') {
        ctrl_to_disable.src = '/images/spacer.gif';
        ctrl_to_disable.onclick = 'return false';
    } else {
        ctrl_to_disable.value = msg_to_display; 
        ctrl_to_disable.disabled = true;
    }
}

function expandit(objid){
		var span = document.getElementById('SPAN' + objid).style;
		var img  = document.getElementById('IMG' + objid);
		var imgtext = document.getElementById('imgtext' +objid);
		if (span.display=="none") {
			span.display="block"
			img.src = img.src.replace(/down/i, "up");
			imgtext.innerText = 'Hide Image';
		} else {
			span.display="none"
			img.src = img.src.replace(/up/i, "down");
			imgtext.innerText = 'View Image';
		}
}

function createCookie(name,value,days) {

    var cookie_string = name + "=" + escape ( value );

	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		cookie_string += "; expires="+date.toGMTString();
	}

	document.cookie = cookie_string + "; path=/"
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}
 
function getCookie(NameOfCookie)
{ if (document.cookie.length > 0) 
{ begin = document.cookie.indexOf(NameOfCookie+"="); 
if (begin != -1) 
{ begin += NameOfCookie.length+1; 
end = document.cookie.indexOf(";", begin);
if (end == -1) end = document.cookie.length;
return unescape(document.cookie.substring(begin, end)); } 
}
return null; 
}

// current animated collapsible panel content
var currentContent = null;

function slideOpen(item, interval, step, page)
{
    var content = document.getElementById(item)
    
    if (content != null) {    
        if (content.style.display == "none"){
            // wait for another animated expand/collapse action to end
            if (currentContent==null)
            {
                currentContent = content;
                var expand = (content.style.display=="none");
                if (expand)
                    content.style.display = "block";
                var max_height = content.offsetHeight;

                var step_height = step + (expand ? 0 : -max_height);
                        
                // schedule first animated collapse/expand event
                content.style.height = Math.abs(step_height) + "px";
                setTimeout("togglePannelAnimatingStatus("
                    + interval + "," + step
                    + "," + max_height + "," + step_height + ")", interval);
                    
                // create cookie
                AddPageSearchVisibleState('AdminSearchFieldVisibility',page);
            }
        }    
    }
}

function slideClose(item, interval, step, page)
{
    var content = document.getElementById(item)
    
    if (content != null) {
        // wait for another animated expand/collapse action to end
        if (content.style.display == "block"){
            if (currentContent==null)
            {
                currentContent = content;
                var expand = (content.style.display=="none");
                if (expand)
                    content.style.display = "block";
                var max_height = content.offsetHeight;

                var step_height = step + (expand ? 0 : -max_height);
                        
                // schedule first animated collapse/expand event
                content.style.height = Math.abs(step_height) + "px";
                setTimeout("togglePannelAnimatingStatus("
                    + interval + "," + step
                    + "," + max_height + "," + step_height + ")", interval);
                    
                // Erase Cookie
                RemovePageSearchVisibleState('AdminSearchFieldVisibility',page)                
            }
        }    
    }       
}

function togglePannelAnimatingStatus(interval,
    step, max_height, step_height)
{
    var step_height_abs = Math.abs(step_height);

    // schedule next animated collapse/expand event
    if (step_height_abs>=step && step_height_abs<=(max_height-step))
    {
        step_height += step;
        currentContent.style.height = Math.abs(step_height) + "px";
        setTimeout("togglePannelAnimatingStatus("
            + interval + "," + step
            + "," + max_height + "," + step_height + ")", interval);
    }
    // animated expand/collapse done
    else
    {
        if (step_height_abs < step)
            currentContent.style.display = "none";
        currentContent.style.height = "";
        currentContent = null;
    }
}

function SetSearchFieldVisibility(name, page) {
    var divOverlay = document.getElementById(name);
    if (divOverlay != null) {
        if (IsPageSearchVisible('AdminSearchFieldVisibility',page))
        {            
            divOverlay.style.display = 'block';
        } else {                
            divOverlay.style.display = 'none';
        }    
    }
}

function AddPageSearchVisibleState(c,page) {
    var cValue = readCookie(c);
    //Maximum number of values the cookie should hold.
    var maxNumOfValues = 90;

    if (cValue == null) {
        eraseCookie(c);
        createCookie(c,page,7300);
    } else {
        var splitCValues = cValue.split("**");
        var isValueExist = false;
        for(i = 0; i < splitCValues.length; i++){
            if (splitCValues[i] == page){
                isValueExist = true;
                break;
            } 
        }
        if(!isValueExist) {
            eraseCookie(c);
            var trimmedValue = (splitCValues.length >= maxNumOfValues) ? (TrimCookieSize(splitCValues)) : (cValue)
            createCookie(c, trimmedValue + "**" + page,7300);
        } 
    }
}

function RemovePageSearchVisibleState(c,page) {
    var cValue = readCookie(c);

    if (cValue != null) {
        var splitCValues = cValue.split("**");
        var isValueExist = false;
        var newCValue = ""
        for(i = 0; i < splitCValues.length; i++){
            if (splitCValues[i] != page){
                    newCValue += (newCValue == "") ? (splitCValues[i]) : ("**" + splitCValues[i]);                 
            } 
        }        
        
        if (cValue != newCValue) {
            eraseCookie(c);
            createCookie(c,newCValue,7300);
        }
    }
}

function IsPageSearchVisible(c,page) {
    var cValue = readCookie(c);
    
    if (cValue != null) {
        var splitCValues = cValue.split("**");
        for(i = 0; i < splitCValues.length; i++){
            if (splitCValues[i] == page){
                return true;
            } 
        }        
    }
    
    return false;
}

// Ensure that cookie does not exceed 4kb.
function TrimCookieSize(valueArray) {
    //Take off the first two values in the list to reduce size.
    var slicedArray = valueArray.slice(1);
    var newValues = "";
    for(i = 0; i < slicedArray.length; i++){
        newValues += slicedArray[i]
    }    
    return newValues;
}
function GetTop(){
    if (window.pageYOffset) {
        sHeight=window.pageYOffset + (document.documentElement.clientHeight / 2) + 'px';
    } else {
        sHeight=(document.documentElement.clientHeight / 2) + 'px';
    };    
    return sHeight;
}

function GetHeight(){
    var sHeight;
    if (window.pageYOffset) {
        sHeight=window.innerHeight - 80 + 'px';
    } else {
        sHeight=document.documentElement.clientHeight - 80 + 'px';
    };    
    return sHeight;
}

function GetWidth(){
    var sWidth;
    if (window.pageYOffset) {
        sWidth=window.innerWidth - 80 + 'px';
    } else {
        sWidth=document.documentElement.clientWidth - 80 + 'px';
    };    
    return sWidth;
}

function acePopulated(source,eventArgs)
{
	var target = source.get_completionList();
	var children = target.childNodes;
	for (var i = 0; i < children.length; i++)
	{
		var child = children[i];
		var value = child._value;
		child.innerHTML = child.innerHTML.replace(/&gt;/g,'>').replace(/&lt;/g,'<');
	}
}

function centerElement(id) {
	var element = document.getElementById(id);
	if (!element) return;

	var clientBounds = getClientBounds();
	var cb = clientBounds.split('|');
	var width = cb[0];
	var height = cb[1];
    
	var pageHeight = getPageHeight();
	var innerHeight = height;
	if(pageHeight > innerHeight) innerHeight = pageHeight; else innerHeight = innerHeight - 10;

	var x = 0;
	var y = 0;

    if (document.documentElement && document.documentElement.scrollTop) {
        x = document.documentElement.scrollLeft;
        y = document.documentElement.scrollTop;
    } else {
        x = document.body.scrollLeft;
        y = document.body.scrollTop;
    }

	x = Math.max(0, Math.floor(x + width / 2.0 - element.offsetWidth / 2.0));
	y = Math.max(0, Math.floor(y + height / 2.0 - element.offsetHeight / 2.0));

	element.style.left = x + 'px';
	element.style.top = y + 'px';
}

function getCoordinates(id) {
	var element = document.getElementById(id);
	if (!element) return;
	
	return element.style.left.replace('px','') + ';' + element.style.top.replace('px','');
}

function centerElementInElement(id,parentid) {
	var element = document.getElementById(id);
	var parent = document.getElementById(parentid);
	if (!element || !parent) return;

	var parentWidth = parent.offsetWidth;
	var parentHeight = parent.offsetHeight;
	
	//alert(parentWidth + '\n' + parentHeight);
    
	var width = element.offsetWidth;
	var height = element.offsetHeight;

	//alert(width + '\n' + height);

	var x = 0;
	var y = 0;

	if(width < parentWidth) x = (parentWidth / 2) - (width / 2);
	if(height < parentHeight) y = (parentHeight / 2) - (height / 2);

	//alert(x + '\n' + y);

	element.style.left = x + 'px';
	element.style.top = y + 'px';
}

 	function getElementsByClassName(oElm, strTagName, strClassName){
        var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
        var arrReturnElements = new Array();
        strClassName = strClassName.replace(/\-/g, "\\-");
        var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
        var oElement;
        for(var i=0; i < arrElements.length; i++){
            oElement = arrElements[i];
            if(oRegExp.test(oElement.className)){
                arrReturnElements.push(oElement);
            }
        }
        return (arrReturnElements)
	}

