function show() {
var element = document.getElementById('TipLayer');
var caller = document.getElementById('caller');

element.style.display = "block";

element.innerHTML = "HIIIIIIIIIIIIIIIIIIII";
element.style.zIndex = 2;
element.style.position = 'fixed';
element.style.visibility = 'visible';

var pos;
pos = findPos( caller );

element.style.left = pos[0] + 40 + 'px';
element.style.top = pos[1] + 'px';
element.style.height = 50 + 'px';

}

function hide() {
var element = document.getElementById('TipLayer');

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
