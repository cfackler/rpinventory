/**
 *  The autoClearClass function loads the behaviour for a text field.
 *  The text field will be cleared when clicked on, and then the original
 *  value (from title tag) will be restored if nothing was typed in, and the focus is moved
 *  away from the text field.
 **/
function autoClearClass(){
  //This will clear the text field when it is clicked on
  (jQuery)('.autoClear').livequery('focus', function(){
    if((jQuery)(this).val() == (jQuery)(this).attr('title'))
      (jQuery)(this).val('');
  });
  //put the text back if it is blurred, and nothing was typed in
  (jQuery)('.autoClear').livequery('blur', function(){
    if((jQuery)(this).val() == '')
      (jQuery)(this).val((jQuery)(this).attr('title'));
  });
}
/**
 *  makeSelection takes an id of a <select> object, and some text
 *  that is an item in the list, and selects it.
 *
 *  @param id   - The id of the <select> object.
 *  @param text - The text of the option to select.
 **/
function makeSelection(id, text)
{
  var options = (jQuery)('#'+id).attr('options');
  for(i = 0; i<options.length; i++)
  {
    if(options[i].text == text)
    {
      (jQuery)('#'+id).attr('selectedIndex', i);
			(jQuery)('#'+id).change(); //incase any behavior is mapped to change
      break;
    }
  }
}
/**
 *	makeSelectionValue takes an id of a <select> object, and some value
 *	of one of the options in the list, and selects it.
 *
 *	@param id			-	The id of the <select> object on the page.
 *	@param value	-	The value of the option to select.
 **/
function makeSelectionValue(id, value)
{
  var options = (jQuery)('#'+id).attr('options');
  for(i = 0; i<options.length; i++)
  {
    if(options[i].value == value)
    {
      (jQuery)('#'+id).attr('selectedIndex', i);
			(jQuery)('#'+id).change(); //incase any behavior is mapped to change
      break;
    }
  }
}

function makeSelectionMultiple(id, textArray)
{
	var $options = (jQuery)('#'+id).attr('options');
	
	for(var i = 0; i < $options.length; i++)
	{
		for(var j = 0; j < textArray.length; j++)
		{
			if($options[i].text == textArray[j])
			{
				$options[i].selected = true;
			}
		}
	}
	(jQuery)('#'+id).change();
}

/**
 *	getSelectOptions takes the ID of a select object, the kind of dropdown it is
 *	(locations, businesses), and the optional text of the option to select when 
 *	the select is refreshed.
 *	
 *	@param	selectID								-	The id of the <select> object.
 *	@param	type										-	The type of option (business, location, ect)
 *	@param	postSelectedOptionText	-	The optional text to select when the <select> is refreshed.
 **/
function getSelectOptions(selectID, type, postSelectedOptionText)
{
	//this is a business pulldown
	if(type == 'businesses'){
		//get options
		(jQuery).ajax({
			url: 'ajax.php?operation=businesses',
			type: 'POST',
			asynchronous: true,
			success: function(msg)
			{
				//load the options into the <select> object
				(jQuery)('#'+selectID).html(msg);
				
				//select a certain option (if desired)
				if(postSelectedOptionText)
				{
					makeSelection(selectID, postSelectedOptionText);
				}
				
			}
		});
	}
	else if(type == 'categories')
	{
		//get options
		(jQuery).ajax({
			url: 'ajax.php?operation=options',
			type: 'GET',
			asynchronous: true,
			data: {table_name: 'categories', value_column: 'id', display_column: 'category_name'},
			success: function(msg)
			{				
				//load the options into the <select> object
				(jQuery)('#'+selectID).html('<option value="-1">Select a Category</option>'
					+msg+'<option value="newCategory">New Category</option>');	
					
				//select a certain option (if desired)
				if(postSelectedOptionText)
				{
					makeSelection(selectID, postSelectedOptionText);
				}
								
			}
		});
	}
	else if(type == 'categories_multiple')
	{
		//get options
		(jQuery).ajax({
			url: 'ajax.php?operation=options',
			type: 'GET',
			asynchronous: true,
			data: {table_name: 'categories', value_column: 'id', display_column: 'category_name'},
			success: function(msg)
			{
				//load the options into the <select> object
				(jQuery)('#'+selectID).html(msg);
				
				//select certain options (if desired)
				if(postSelectedOptionText)
				{
					makeSelectionMultiple(selectID, postSelectedOptionText);
				}
			}
		});
	}
	
	
}
