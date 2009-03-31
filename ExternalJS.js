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

function sendValidateRequest(itemID){
    var item = document.getElementById( itemID );
    itemValue = item.value;

    if ( itemID == 'location_edit' ){
	locID = document.getElementById( 'location_id' );
	new Ajax.Request("validateFormItem.php?itemValue=" + itemValue + "&itemID=" + itemID + "&locID=" + locID.value,
		     { 
			 method: 'post', 
			     parameters: $(itemID).serialize(true),
			     onSuccess: validateAction
			     });
    }
    else if ( itemID.match("newlocation") ){
	new Ajax.Request("validateFormItem.php?itemValue=" + itemValue + "&itemID=" + itemID,
			 { 
			     method: 'post', 
				 parameters: $(itemID).serialize(true),
				 onSuccess: validateAction
				 });
    }
    else{
	new Ajax.Request("validateFormItem.php?itemValue=" + itemValue + "&itemID=" + itemID,
			 { 
			     method: 'post', 
				 parameters: $(itemID).serialize(true),
				 onSuccess: validateAction
				 });
    }
}


function validateAction(oReq, oJSN){
    if ( oJSN.numRows > 0 ){
	if ( oJSN.itemID == 'location_edit' || oJSN.itemID.match( "newlocation" ) ){
	    alert( 'A location already exists with the name, ' + oJSN.itemValue );
	}
	else{
	    alert( 'A ' + oJSN.itemID + ' already exists with the name, ' + oJSN.itemValue );
	}

	$(oJSN.itemID).focus();
	$(oJSN.itemID).select();
    }
}


function OnChange(item1, item2){
    var Menu = document.getElementById(item1);
    var blankFields = document.getElementById(item2);
    
    //If you have selected the last element in the list
    //	(will always be "new Location" (or new whatever)
    if(Menu.selectedIndex == Menu.length-1){
	blankFields.style.display = '';
    }
    else{
	blankFields.style.display = 'none';
    }
}


function OnChangeDouble(item1, item2, item3){
    OnChange(item1, item2);
    OnChange(item1, item3);
}


function ValidateForm(){
    var objects = new Array(), i=0, cur_id, obj;
    
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
	    if(vowel_match == null){ // Will change the prompt based on first letter in the id
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
    
    // Returns the bad id, or '-1' if no errors
    return_data = ValidateSaneInput( objects ); 
    
    if( return_data != null ){
	alert( return_data[0] ); // Alert the user, and highlight the offending field
	obj = document.getElementById( return_data[1] );
	obj.focus();
	obj.select();
	return false;
    }
    
    return true;
}

function ValidateSaneInput( objects ){
    var message = '';
    var offending_id = '';
    
    for ( i = 0; i < objects.length && message == ''; i++) {
	cur_id = objects[i].id;
	objects[i].value = rtrim(objects[i].value);
	
	// Regexp's
	if( cur_id == "phone" ){ // Phone numbers
	    if( !objects[i].value.match( /^\d{3}(\.|-)?\d{3}(\.|-)?\d{4}$/ ) ){
		message = "Please enter a phone number in the form 'xxx-xxx-xxxx', 'xxx.xxx.xxxx', or 'xxxyyyzzzz'";
		offending_id = cur_id;
	    }
	    else{		// Removes extra formatting for uniform phone number storage
		objects[i].value = objects[i].value.replace( /[-\.]/g, '' );
	    }
	}
	else if( cur_id == "zip" ){ // Zip code
	    if( !objects[i].value.match( /^\d{5}$/ ) ){
		message = "Please enter a zip code in the form 'xxxxx'";
		offending_id = cur_id;
	    }
	}
	else if( cur_id == "state" ){ // 2-letter state abbreviation
	    if( !validateState(objects[i].value) ) {
		message = "Please enter a state as a two-letter abbreviation";
		offending_id = cur_id;
	    }
	    else{		// Stores the state as capital letters
		objects[i].value = objects[i].value.toUpperCase();
	    }
	} // Check dates in the form yyyy-mm-dd
	else if ( cur_id == "startdate" || cur_id == "enddate" ){
	    if ( !objects[i].value.match( /^\d{4}-\d{2}-\d{2}$/ )){
		message = "Please enter a date in the from 'yyyy-mm-dd'";
		offending_id = cur_id;
	    }
	}
	else if( cur_id == "RIN" ){ // 9-digit RIN
	    if( !objects[i].value.match( /^\d{9}$/ ) ){
		message = "Please enter a RIN in the form 'xxxyyzzzz'";
		offending_id = cur_id;
	    }
	} // Taken from http://xyfer.blogspot.com/2005/01/javascript-regexp-email-validator.html
	else if( cur_id == "email" ){ // Validate email address
	    if( !objects[i].value.match( /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i ) ){
		message = "Please enter a valid email address";
		offending_id = cur_id;
	    }
	}
    }

    return_data = new Array(message, offending_id);
    if( message != '' ){
	return return_data;
    }
    
    return null;
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

function getItemBlockContents(element, idnum)
{
    new Ajax.Request("getItemBlock.php?id=" + idnum,
		     {
			 method: 'post',
			 onSuccess: function(transport) {
			     var response = transport.responseText;
			     element.innerHTML = response;
			 }
		     });
}

function addItemField() {
    var t = document.getElementById("itemTable");
    var divs = t.getElementsByTagName("div");
    var nextnum = divs.length;
    var newrow = document.createElement('div');

    newrow.setAttribute('id', 'item' + nextnum);
    getItemBlockContents(newrow, nextnum);
    t.appendChild(newrow);

    var count = document.getElementById("count");
    count.setAttribute('value', nextnum + 1);

    // show delete button
    document.getElementById("removeButton").style.display="";
}

function removeItemField() {
    var count = document.getElementById("count");
    if (Number(count.value) > 1) {
	var t = document.getElementById("itemTable");
	var divs = t.getElementsByTagName("div");
	t.removeChild(divs[divs.length - 1]);

	// decrement count
	count.setAttribute('value', Number(count.value - 1));

	// hide delete button?
	if (Number(count.value) < 2)
	    document.getElementById("removeButton").style.display="none";
    }
}

function rtrim(str) {		// Trims all trailing whitespace from a string
    return str.replace(/\s+$/, '');
}

function validateState(str) {
    var states = new Array ('AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FL',
			    'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME',
			    'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH',
			    'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI',
			    'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV',
			    'WI', 'WY');

    for ( var i = 0; i < states.length; i++ ) {
	if ( str.toUpperCase() == states[i] ) {
	    return true;
	}
    }
    alert('returns false');
    
    return false;
}

function removeContents( id, defaultValue ) {
    var element = document.getElementById( id );
    if( element.value == defaultValue ){
	element.value = '';
    }
}

function selectAllNone( checkAllNone, formId ) {
    var form = document.getElementById( formId );
    for ( var i = 0; i < form.length; i++ ) {
	if( form[i].type == 'checkbox' && form[i].name != checkAllNone.name ) {
	    form[i].checked = checkAllNone.checked;
	}
    }
}

function getLocationOptions(element)
{
	 new Ajax.Request("ajax.php?operation=locations", 
		     { 
			 method: 'post', 
			     onSuccess: function(transport)
			     {
				     var response = transport.responseText;
				     element.innerHTML = response;
			 	 }
		     });
}

function saveLocation(name, description, result, locationselect, locationTR, descriptionTR)
{
    var resultElement = document.getElementById(result);
    
    var nameText = document.getElementById(name).value;

    var descText = document.getElementById(description).value;
    var locationselectelement = document.getElementById(locationselect);


    new Ajax.Request("ajax.php?operation=savelocation&location="+nameText+"&description="+descText, 
		  { 
		      method: 'post', 
			  onSuccess: function(transport)
			  {
			      resultElement.innerHTML = "Successfully saved.";
			      
			      //refresh elements in pulldown
			      //var oldIndex = locationselectelement.selectedIndex;
			      //alert("oldIndex = "+oldIndex);
			      
			      //locationselectelement.selectedIndex = Number(oldIndex+1);
			      
			      //find newly inserted element and select it
			      //alert( "hi" );
			      document.getElementById( locationTR ).style.display = 'none';
			      document.getElementById( descriptionTR ).style.display = 'none';
			      //alert( 'hi2' );
			      highlightEntry( locationselectelement, nameText );
			      //locationselectelement.focus();
			      //locationselectelement.blur();
			      //var i;//, OptionText;
			      //alert( nameText );
			      //alert(locationselectelement.options[0]);
			      //for(i = 0; i<locationselectelement.length; i++){
			      //OptionText = locationselectelement.options[i].text;
			      //	alert( i );
			      //alert(OptionText);
			      
			      /*if(locationselectelement.options[i].text == nameText){
			      //alert(OptionText+" was found when i="+i); 
			      
			      locationselectelement.selectedIndex = i;
			      break;
			      }
			      }     */
			  },
			  onFailure: function()
			  {
			      alert( "Error saving location!" );
			  }
		  });	     	  
}

function highlightEntry( selectElement, nameText ){
    //    selectElement.focus();
    //selectElement.blur();
    //alert( "Item Saved!" );
    for( var i = 0; i < selectElement.length ; i++ ) {
	if( selectElement.options[i].text == nameText ){
	    selectElement.selectedIndex = i;
	    return;
	}
    }
}