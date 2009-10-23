(jQuery)(document).ready(function(){
	
	/* Make all autoClear fields actually work */
	autoClearClass();
	
	/* Change all category_selects into fancy ones */
	(jQuery)('.category_select').livequery(function(){ (jQuery)(this).asmSelect(); });
	
	/* make buttons look nice when hovered */
	ui_hover_behavior();
	
	/* add category button */
	add_category_behavior();
	
	/* save category button */
	save_category_behavior();
	
	/* add location button */
	add_location_behavior();
	
	/* save location button */
	save_location_behavior();
	
});

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