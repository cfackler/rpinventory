


function submitItems()
{
	var ids = "";
	
	//Look at all item ids (if they're checked)
	for (var i=0; i < document.itemList.elements.length; i++) {
		var element = document.itemList.elements[i];
		
		if(element.checked == true)
		{
			if(ids.length != 0)
			{
				ids += ",";
			}
			
			ids += element.name;
			
		}
	}
	
	//No Ids
	if(ids.length == 0)
	{
		alert('You must select at least one item');
		return;
	}
	
	var dropdown = $('action_list');
	var action = dropdown.options[dropdown.selectedIndex].value;
	
	if(action == "Loan")
		window.location="loanItem.php?ids=" + ids;
	else if(action == "Delete")
	{
		confirmation("Are you sure you want to delete these items?", "deleteItem.php?ids=" + ids);
	}
	else if(action == "Edit")
	{
		window.location="editItem.php?ids=" + ids;
	}
	else if(action == "Repair")
	{
		window.location="repairItems.php?ids=" + ids;
	}
	
	//alert(action);
}

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
		$('useOld').disabled = true;
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
	$('useOld').disabled = false;
	
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