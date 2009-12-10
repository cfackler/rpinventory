(jQuery)(document).ready(function(){
	
	/* Make auto clear fields work */
	autoClearClass();
	
	/* make buttons look nice when hovered */
	ui_hover_behavior();
	
	/* Change all category_selects into fancy ones */
	(jQuery)('.category_select').livequery(function(){ (jQuery)(this).asmSelect(); });
	
	/* select the proper categories for each item */
	initialize_category_dropdowns();
	
	/* select the proper locations for each item */
	initialize_location_dropdowns();
	
	/* add category button */
	add_category_behavior();
	
	/* save category button */
	save_category_behavior();
	
	/* add location button */
	add_location_behavior();
	
	/* save location button */
	save_location_behavior();
	
	
});

function initialize_location_dropdowns()
{
	/* Get amount of items */
	var $itemCount = (jQuery)('#count').attr('value');
	
	/* for each item on the page */
	for(var $i = 0; $i < $itemCount; $i++)
	{
		/* get inventory id */
		var $inventory_id = (jQuery)('#inventory_id-'+$i).attr('value');

		/* Get location ID for this item */
		//(jQuery).
	}
}
function initialize_category_dropdowns()
{
	/* Get amount of items */
	var $itemCount = (jQuery)('#count').attr('value');

	/* for each item on page */
	for(var $i = 0; $i<$itemCount; $i++)
	{

		/* Create a category pulldown for each category, and select the proper item */

		/* get inventory id */
		var $inventory_id = (jQuery)('#inventory_id-'+$i).attr('value');
		var $category_ids;
		
		/* Get category IDs for this item */
		(jQuery).ajax({
			type: 'POST',
			async: false,
			url: 'ajax.php?operation=itemCategoryIDs',
			data: {inventory_id: $inventory_id, store: 1},

			success: function(transport)
			{
				if(transport != 'Error, no categories retrieved')
				{
					/* separate into array of category_ids */
					$category_ids = transport.split(',');

					/* select categories for this item's dropdown */
					makeSelectionMultipleValue('category-'+$i, $category_ids);
				}				
			}
		});
	}
}