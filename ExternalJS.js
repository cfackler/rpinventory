function confirmation(msg, url) {
	var answer = confirm(msg)
	if (answer){
        alert("GOTO " + url);
		window.location = url;
	}
    alert("NO");
}