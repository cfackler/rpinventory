(jQuery)(document).ready(function(){
	
	/* Get categories for each item, and select the proper category */
	initialize_category_dropdowns();
});

function initialize_category_dropdowns()
{
	/* Get amount of items */
	var $itemCount = (jQuery)('#count').attr('value');

	/* for each item on page */
	var $i;
	for($i = 0; $i<$itemCount; $i++)
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
			data: {inventory_id: $inventory_id},

			success: function(transport)
			{
				/* separate into array of category_ids */
				$category_ids = transport.split(',');
				//initialize_category_dropdowns($i, $category_ids);
			}
		});
				
	
	
		/* for first category, just select item from pulldown because it is already on page */
		makeSelectionValue('category_0-'+$i, $category_ids[0]);
	
		/* For each following category, copy pulldown menu and select proper category */
		for(var $j = 1 ; $j<$category_ids.length; $j++)
		{
			/* select last category <select> object for this item, insert a <br /> after it */
			(jQuery)('#category_'+($j-1)+'-'+$i).after('<br />')
			/* clone it, change attributes of clone */
			.clone().attr('name', 'category_'+$j+'-'+$i).attr('id', 'category_'+$j+'-'+$i)
			/* insert it into the DOM after the previous <select><br /> */
			.insertAfter( (jQuery)('#category_'+($j-1)+'-'+$i).next() );
		
			/* select proper category in new dropdown */
			makeSelectionValue('category_'+$j+'-'+$i, $category_ids[$j]);
		}
	}
	
}