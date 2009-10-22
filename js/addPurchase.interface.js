(jQuery)(document).ready(function(){
	
	autoClearClass();
	
	category_select_behavior();
	
	(jQuery)('.saveNewCategory').livequery('click', function()
	{
		//get item_index
		var $item_index = (jQuery)(this).attr('id').split('-')[1];
		
		// get category_index
		var $cat_index = (jQuery)(this).attr('id').split('_')[1].split('-')[0];
		
		//validate field
		var $newCatName = (jQuery)('#newCategory_'+$cat_index+'-'+$item_index).val();
		
		if( $newCatName == '' || $newCatName == (jQuery)('#newCategory_'+$cat_index+'-'+$item_index).attr('title'))
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
					//re-populate dropdown, and select new category
					getSelectOptions('category_'+$cat_index+'-'+$item_index, 'categories', $newCatName);
					
					//re-populate all other dropdowns, and select the previously selected item
					$cat_count = (jQuery)('#category_count-'+$item_index).val();
					for(var $i = 0; $i < $cat_count; $i++)
					{
						/* Do not do this for the select box that initated the process */
						if($i == $cat_index)
							continue;
							
						/* currently selected text */
						var $currText = (jQuery)('#category_'+$i+'-'+$item_index).attr('options');
						$currText = $currText[(jQuery)('#category_'+$i+'-'+$item_index).attr('selectedIndex')].text;

						/* repopulate dropdown */
						getSelectOptions('category_'+$i+'-'+$item_index, 'categories', $currText);
					}
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
		(jQuery)('category_notification-'+$id).html('<input type="text" value="New category name" id="newCategory-'+$id
			+'" name="newCategory-'+$id+'" title="New category name" class="autoClear" size="40" />'
			+'<input type="button" id="saveNewCategory-'+$id
			+'" class="saveNewCategory" value="Save Category" />');
		
	});
	
});