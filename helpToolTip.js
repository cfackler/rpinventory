function showToolTip( caller_id ) {
var element = document.getElementById('helpToolTip');
var caller = document.getElementById(caller_id);

element.style.display = "block";

element.innerHTML = help[ basenameLocation() ][caller_id];
element.style.zIndex = 2;
element.style.position = 'fixed';
element.style.visibility = 'visible';

var pos;
pos = findPos( caller );
scroll = getScrollXY();

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

/* Returns the basename of the current page
 *
 * i.e. If on 'addPurchase.php'
 *
 * basenameLocation() => 'addPurchase'
	*/
function basenameLocation( ) {
	var loc = document.location.pathname.match( /^.*?\/(\w*)\.php/ );

	if( loc == null ) {
		return;
	}
	else {
		return loc[1];
	}
}

function getScrollXY() {
	var scrOfX = 0, scrOfY = 0;
	if( typeof( window.pageYOffset ) == 'number' ) {
		//Netscape compliant
		scrOfY = window.pageYOffset;
		scrOfX = window.pageXOffset;
	} else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
		//              //DOM compliant
		scrOfY = document.body.scrollTop;
		scrOfX = document.body.scrollLeft;
	} else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
		//                            //IE6 standards compliant mode
		scrOfY = document.documentElement.scrollTop;
		scrOfX = document.documentElement.scrollLeft;
	}
	return [ scrOfX, scrOfY ];
}

/* Datastructure to hold all of help data 
 *
 * An associative array of associative arrays
 *
 * help[ basename-of-page ][ id-of-caller-element ]
 *
 * i.e. For the page addPurchase.php with a help image with id="caller", the appropriate
 * line would be:
 *
 * help['addPurchase']['caller'] 
 *    or
 * help[basenameLocation()]['caller']
 *
 * The basenameLocation() function will get the name of the page and grab just the basename
 * 
*/
var help = new Array();

help['addPurchase'] = new Array();

help['addPurchase']['ignoreBusinessHelp'] = 'Check this option if you do not want to enter any business information';
