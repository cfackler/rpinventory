(jQuery)(document).ready(function(){
	
	autoClearClass();
	
	category_select_behavior();
	
	(jQuery)('.saveNewCategory').livequery('click', function()
	{
		//get count
		var $count = (jQuery)(this).attr('id').split('-')[1];
		
		//validate field
		var $newCatName = (jQuery)('#newCategory-'+$count).val();
		
		if( $newCatName == '' || $newCatName == (jQuery)('#newCategory-'+$count).attr('title'))
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
					getSelectOptions('category-'+$count, 'categories', $newCatName);
				}
				else
					alert(msg);
			}
		});
	});
	
});

function category_select_behavior()
{
	(jQuery)('.category_select').livequery('change', function(){
		//get count (number after id)
		var $count = (jQuery)(this).attr('id').split('-')[1];

		//if new category was selected
		if((jQuery)(this).val() == 'newCategory')
		{
			//pop up new category text field
			(jQuery)('#category_notification-'+$count).html('<input type="text" value="New category name" id="newCategory-'+$count
				+'" name="newCategory-'+$count+'" title="New category name" class="autoClear" size="40" />'
				+'<input type="button" id="saveNewCategory-'+$count
				+'" class="saveNewCategory" value="Save Category" />');
		}
		else
		{
			//category was selected from list, so hide input field
			(jQuery)('#category_notification-'+$count).html('<!-- -->');
		}
	});
}