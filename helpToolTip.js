function showToolTip( caller_id, message ) {
var element = document.getElementById('helpToolTip');
var caller = document.getElementById(caller_id);

element.style.display = "block";

element.innerHTML = message;
element.style.zIndex = 2;
element.style.position = 'fixed';
element.style.visibility = 'visible';

var pos;
pos = findPos( caller );
scroll = getScrollOffset();

element.style.left = (pos[0] + 20 - scroll[0]) + 'px';
element.style.top = (( pos[1] - 10 ) - scroll[1]) + 'px';
}

function hideToolTip() {
var element = document.getElementById('helpToolTip');

element.style.display = "none";
}

function findPos(obj) {
	var curleft = curtop = 0;

	if( obj.offsetParent) {
		do {
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);

		return [curleft,curtop];
	}
}

/* Get the scrolled offset of the current page */
function getScrollOffset() {
	var x = 0, y = 0;
	x = window.pageXOffset;
	y = window.pageYOffset;

	if( document.documentElement && navigator.appName == 'Microsoft Internet Explorer' ) {
		x = documentElement.scrollLeft;
		y = documentElement.scrollRight;
	}
	return [x,y];
}
