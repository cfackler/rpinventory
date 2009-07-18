function show( caller_id ) {
var element = document.getElementById('tipLayer');
var caller = document.getElementById(caller_id);

element.style.display = "block";

element.innerHTML = help[ basenameLocation() ][caller_id];
element.style.zIndex = 2;
element.style.position = 'fixed';
element.style.visibility = 'visible';

var pos;
pos = findPos( caller );

element.style.left = pos[0] + 20 + 'px';
element.style.top = ( pos[1] - 10 ) + 'px';
}

function hide() {
var element = document.getElementById('tipLayer');

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

function basenameLocation( ) {
	var loc = document.location.pathname.match( /^.*?\/(\w*)\.php/ );

	if( loc == null ) {
		return;
	}
	else {
		return loc[1];
	}
}

var help = new Array();

help['addPurchase'] = new Array();

help['addPurchase']['ignoreBusinessHelp'] = 'Check this option if you do not want to enter any business information';
