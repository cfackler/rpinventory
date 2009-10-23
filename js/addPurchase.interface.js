(jQuery)(document).ready(function(){
	
	autoClearClass();
	
	
	(jQuery)('.category_select').livequery(function(){ (jQuery)(this).asmSelect(); });
	
	//category_select_behavior();
	
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
					$cat_selects_count = (jQuery)('.category_select').length;
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
					(jQuery)('#category_notification-'+$item_index).html('Category successfully saved.');
					
				}
				else
					alert(msg);
			}
		});
	});
	
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
	
});