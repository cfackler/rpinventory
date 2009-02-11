/*

    Copyright (C) 2008, All Rights Reserved.

    This file is part of RPInventory.

    RPInventory is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RPInventory is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RPInventory.  If not, see <http://www.gnu.org/licenses/>.

*/


function submitItems(){
    var ids = "";
    
    //Look at all item ids (if they're checked)
    for (var i=0; i < document.itemList.elements.length; i++) {
	var element = document.itemList.elements[i];
	
	if(element.checked == true){
	    if(ids.length != 0){
		ids += ",";
	    }
	    
	    ids += element.name;
	    
	}
    }
    
    //No Ids
    if(ids.length == 0){
	alert('You must select at least one item');
	return;
    }
    
    var dropdown = $('action_list');
    var action = dropdown.options[dropdown.selectedIndex].value;
    
    if(action == "Loan")
	window.location="loanItem.php?ids=" + ids;
    else if(action == "Delete"){
	confirmation("Are you sure you want to delete these items?", "deleteItem.php?ids=" + ids);
    }
    else if(action == "Edit"){
	window.location="editItem.php?ids=" + ids;
    }
    else if(action == "Repair"){
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
    var options = $('user_id');
    var id = options.options[options.selectedIndex].value;
    
    //Dont send invalid id
    if(id == -1)
	return;
    
    new Ajax.Request("getAddress.php?id=" + id, 
		     { 
			 method: 'post', 
			     parameters: $('AjaxForm').serialize(true),
			     onSuccess: recieveAddress
			     });
}


function recieveAddress(oReq, oJSN){
    //alert(oJSN.Address);
    
    if(oJSN.Found == "False"){
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

function useAddress(){
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

function OnChange(item1, item2){
    var x = document.getElementById(item1);
    var y = document.getElementById(item2);
    var text = x.options[x.selectedIndex].text;

    if ( text == 'Add a New Business' || text == 'New Location') {
	y.style.display = '';
    }
    else {
	y.style.display = 'none';
    }
}

function OnChangeDouble(item1, item2, item3){
    OnChange(item1, item2);
    OnChange(item1, item3);
}


function ValidateForm(document){
    with(document){
	var objects = new Array(), i=0, cur_id;

	objects = document.getElementsByClassName("validate_cond");

	for(i=0; i<objects.length; i++){
	    if(objects[i].value == "newBusiness"){

		var new_business_tags= new Array();
		new_business_tags= document.getElementsByClassName("validate_cond_bus");
		for(var j=0; j<new_business_tags.length; j++){
		    cur_id= new_business_tags[j].id;
		    if(!ValidateRequired(new_business_tags[j], "Please select a "+cur_id))
		       return false;
		}
	    }
	}
	

	objects = document.getElementsByClassName("validate");
	
	for(i=0; i<objects.length; i++){
	    cur_id = objects[i].id;

	    // Alter prompt so not to include actual ID
	    if(cur_id == "user_id"){ 
		if(!ValidateRequired(objects[i], "Please select a user"))
		    return false;
	    } // Same with id="business_id"
	    else if(cur_id == "business_id"){
		if(!ValidateRequired(objects[i], "Please select a business"))
		    return false;
	    } // Same with id="total_cost"
	    else if(cur_id == "total_cost"){
		if(!ValidateRequired(objects[i], "Please enter a total purchase cost"))
		    return false;
	    }
	    // Use the id as the descriptor for what field to update
	    else{
		var vowel_match= cur_id.match(/^[aeiou]/);
		var message;
		if(vowel_match == null){ // Will change the prompt based on vowels
		    message= "Please enter a ";
		}
		else{
		    message= "Please enter an ";
		}

		var id_match= cur_id.match(/[0-9]*/);
		if( id_match == null){
		    var num;	// Pretty ugly workaround, but gives sensible descriptions now
		    var id;
			
		    num= cur_id.replace(/[a-zA-Z]*/, "");
		    id= cur_id.replace(/[0-9]*/g, "");

		    if (!ValidateRequired(objects[i], message + id + " for item " + num)){
			return false;
		    }
		}
		else{
		    if (!ValidateRequired(objects[i], message + cur_id)){
			return false;
		    }
		}
	    }
	}

	return true;
    }
}

function ValidateRequired(field, alerttext){
    with(field){
	if(value==null || value=="" || value==-1){
	    alert(alerttext);
	    return false;
	}
	else{
	    return true;
	}
    }
}