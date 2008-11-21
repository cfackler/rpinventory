function confirmation(msg, url) {
	var answer = confirm(msg)
	if (answer){
		window.location = url;
	}
}


function sendAddressRequest() {

	var options = $('user_id')
	var id = options.options[options.selectedIndex].value
	
	//Dont send invalid id
	if(id == -1)
		return
		
	new Ajax.Request("getAddress.php?id=" + id, 
	{ 
		method: 'post', 
		parameters: $('AjaxForm').serialize(true),
		onSuccess: recieveAddress
	});
}


function recieveAddress(oReq, oJSN)
{
	//alert(oJSN.Address);
	
	if(oJSN.Found == "False")
	{
		$('address').value = "";
		$('address2').value = "";
		$('City').value = "";
		$('State').value = "";
		$('Zipcode').value = "";
		$('Phone').value = "";
		$('useOld').checked = false;
		useAddress();
		return;
	}
	
	
	$('address').value = oJSN.Address;
	$('address2').value = oJSN.Address2;
	$('City').value = oJSN.City;
	$('State').value = oJSN.State;
	$('Zipcode').value = oJSN.Zipcode;
	$('Phone').value = oJSN.Phone;
	
	$('useOld').checked = true;
	
	useAddress();
	
}

function useAddress()
{
	var status = true;
	
	if($('useOld').checked != true)
		status = false;
	
	
	$('address').disabled = status;
	$('address2').disabled = status;
	$('City').disabled = status;
	$('State').disabled = status;
	$('Zipcode').disabled = status;
	$('Phone').disabled = status;
	

}