function confirmation(msg, url) {
	var answer = confirm(msg)
	if (answer){
		window.location = url;
	}
}