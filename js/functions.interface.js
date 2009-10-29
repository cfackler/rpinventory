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

/**
 *	makeSelectionMultiple is just like the makeSelection functions above,
 *	except it works for a select multiple.
 *
 *	@param	id				-	The id of the <select multiple> object.
 *	@param	textArray	-	The array of selected options text attribute
 **/
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
 *	makeSelectionMultipleValue is just like the makeSelectionValue function above,
 *	except it works for a select multiple.
 *
 *	@param	id					-	The id of the <select multiple> object.
 *	@param	valueArray	-	The array of selected options value attribute
 **/
function makeSelectionMultipleValue(id, valueArray)
{
	var $options = (jQuery)('#'+id).attr('options');
	
	for(var i = 0; i < $options.length; i++)
	{
		for(var j = 0; j < valueArray.length; j++)
		{
			if($options[i].value == valueArray[j])
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
	else if(type == 'locations')
	{
		//get locations
		(jQuery).ajax({
			url: 'ajax.php?operation=options',
			type: 'GET',
			asynchronous: true,
			data: {table_name: 'locations', value_column: 'location_id', display_column: 'location'},
			success: function(msg)
			{
				//load the options into the <select> object
				(jQuery)('#'+selectID).html(msg);
				
				//select certain option (if desired)
				if(postSelectedOptionText)
				{
					makeSelection(selectID, postSelectedOptionText);
				}
			}
		});
	}
	
	
}

/**
 *	ui_hover_behavior just makes jQuery ui objects work
 *	as expected.  Changing the class when hovered over.
 **/
function ui_hover_behavior() {
	(jQuery)('.ui-state-default').livequery(function()
	{
		(jQuery)(this).hover(function()
		{
			(jQuery)(this).addClass('ui-state-hover');
		}, function()
		{
			(jQuery)(this).removeClass('ui-state-hover');
		});
	});
}


/**
 *	add_category_behavior handles the behavior of the add_category_button
 **/
function add_category_behavior() {
	(jQuery)('.add_category_button').livequery('click', function()
	{
		/* Add Category Button was clicked */
		/* get item index on page */
		var $id = (jQuery)(this).attr('id').split('-')[1];

		/* show new category form */
		(jQuery)('#category_notification-'+$id).html('<input type="text" value="New category name" id="newCategory-'+$id
			+'" name="newCategory-'+$id+'" title="New category name" class="autoClear" size="40" />'
			+'<input type="button" id="saveNewCategory-'+$id
			+'" class="saveNewCategory" value="Save Category" />');		
	});
}

/**
 *	save_category_behavior handles the behavior of the save_category_button
 **/
function save_category_behavior() {
	(jQuery)('.saveNewCategory').livequery('click', function()
	{
		//get item_index
		var $item_index = (jQuery)(this).attr('id').split('-')[1];
		
		//validate field
		var $newCatName = (jQuery)('#newCategory-'+$item_index).val();
		
		if( $newCatName == '' || $newCatName == (jQuery)('#newCategory-'+$item_index).attr('title'))
		{
			//if field is empty, or user hasn't typed anything in yet, display error
			alert('Please enter a valid category name.');
			return;
		}
		
		//if new category name is valid, insert it into DB via ajax
		(jQuery).ajax({
			type: 'GET',
			url: 'ajax.php?operation=insertCategory',
			data: {category_name: $newCatName},
			success: function(msg)
			{
				if(msg == 'success')
				{	
					/* get currently selected categories */
					var $options = (jQuery)('#category-'+$item_index).attr('options');
					var $selectedArray = new Array();
					var $selectedArrayIndex = 0;
					for(var i = 0; i < $options.length; i++)
					{
						if($options[i].selected)
						{
							$selectedArray[$selectedArrayIndex++] = $options[i].text;
						}
					}
					$selectedArray[$selectedArrayIndex++] = $newCatName;
					
					
					//re-populate dropdown, and select old categories and new category
					getSelectOptions('category-'+$item_index, 'categories_multiple', $selectedArray);
					
					
					//re-populate all other dropdowns, and select the previously selected items
					var $cat_selects_count = (jQuery)('.category_select').length;
					for(var $i = 0; $i < $cat_selects_count; $i++)
					{
						
						/* Do not do this for the select box that initated the process */
						if($i == $item_index)
							continue;
							
						/* save currently selected options text */
						$selectedArray = new Array();
						$selectedArrayIndex = 0;
						$options = (jQuery)('#category-'+$i).attr('options');
						for(var $j = 0; $j < $options.length; $j++)
						{
							if($options[$j].selected)
							{
								$selectedArray[$selectedArrayIndex++] = $options[$j].text;
							}
						}
						
						/* repopulate dropdown, re-selecting previously selected items */
						getSelectOptions('category-'+$i, 'categories_multiple', $selectedArray);
						
					}
					
					/* remove save category form and notify user */
					(jQuery)('#category_notification-'+$item_index).html('<a id="add_category_button-'+$item_index
						+'" class="ui-state-default ui-corner-all icon_button add_category_button">'
						+'<span class="ui-icon ui-icon-plus icon_button_icon"><!-- --></span>Add Category'
						+'</a> Category successfully saved.');
					
				}
				else
					alert(msg);
			}
		});
	});
	
}

/**
 *	add_location_behavior handles the behavior of the add_location_button
 **/
function add_location_behavior() {
	(jQuery)('.add_location_button').livequery('click', function()
	{
		/* add location button was clicked */
		/* get item index on page */
		var $id = (jQuery)(this).attr('id').split('-')[1];
		
		/* show new location form */
		(jQuery)('#location_notification-'+$id).html(
			'<br/><label for="newLocation-'+$id+'">New location name:</label><br/>'
			+'<input type="text" id="newLocation-'+$id+'" name="newLocation-'+$id+'" size="40" />'
			+'<br/>'
			+'<label for="newLocationDescription-'+$id+'">Description:</label><br/>'
			+'<textarea rows="6" cols="30" id="newLocationDescription-'+$id+'" name="newLocationDescription-'+$id+'" />'
			+'<br/>'
			+'<input type="button" id="saveNewLocation-'+$id+'" class="saveNewLocation" value="Save Location" />');
		
	});
}
/**
 *	save_location_behavior handles the behavior of the save_location_button
 **/
function save_location_behavior() {
	(jQuery)('.saveNewLocation').livequery('click', function()
	{
		//get item_index
		var $item_index = (jQuery)(this).attr('id').split('-')[1];
		
		//validate field
		var $newLocName = (jQuery)('#newLocation-'+$item_index).val();
		if( $newLocName == '')
		{
			//if field is empty, display error
			alert('Please enter a valid location name.');
			return;
		}
		
		//No need to validate, because description could be NULL
		var $newLocDesc = (jQuery)('#newLocationDescription-'+$item_index).val();
		
		//if new location name is valid, insert it into DB via Ajax
		(jQuery).ajax({
			type: 'GET',
			url: 'ajax.php?operation=savelocation',
			data: {location: $newLocName, description: $newLocDesc},
			success: function(msg)
			{
				if(msg == 'success')
				{
					/* refresh location dropdown, and select newly added item */
					getSelectOptions('location-'+$item_index, 'locations', $newLocName);
					
					/* Change form back to normal, and notify user of success */
					(jQuery)('#location_notification-'+$item_index).html(
						'<a id="add_location_button-'+$item_index+'" class="ui-state-default ui-corner-all icon_button add_location_button">'
						+'<span class="ui-icon ui-icon-plus icon_button_icon"><!-- --></span>Add Location</a> New Location saved successfully.');
						
					/* update all other dropdowns */
					var $loc_selects_count = (jQuery)('.location_select').length;
					for(var $i = 0; $i < $loc_selects_count; $i++)
					{
						if($i == $item_index)
							continue;
							
						//Get currently selected item (text) in dropdown
						var $curr_selected_index = (jQuery)('#location-'+$i).attr('selectedIndex');
						var $curr_selected_text = (jQuery)('#location-'+$i).attr('options')[$curr_selected_index].text;
						
						//repopulate dropdown and select previously selected item
						getSelectOptions('location-'+$i, 'locations', $curr_selected_text);
					}
				}
				else
					alert(msg);
			}
		});
	});
}

function table_sortable(startingCol, startingDir) {
	if(!startingCol)
	{
		startingCol = 0;
	}
	if(!startingDir)
	{
		startingDir = 0;
	}
	/* make table javascript sortable */
	(jQuery)('table.sortable').tablesorter( {sortList: [[startingCol,startingDir]]} );
	
	/* upon sort end, remove and re-assign class for alternate row color */
	(jQuery)('table.sortable').bind("sortStart", function(){
		/*Loading notification eventually */
	}).bind("sortEnd", function(){
		(jQuery)('table.sortable tr.alt').removeClass('alt');
		(jQuery)('table.sortable tr:even').addClass('alt');
	});
}
function table_searchable() {
	var theTable = (jQuery)('table.searchable');
	
	theTable.find("tbody > tr").find("td:eq(1)").mousedown(function(){
    (jQuery)(this).prev().find(":checkbox").click()
  });

	(jQuery)('#searchField').keyup(function() {
		(jQuery).uiTableFilter(theTable, this.value);
		(jQuery)('table.searchable tr.alt').removeClass('alt');
		(jQuery)('table.searchable tr:even').addClass('alt');
	});
	
}
