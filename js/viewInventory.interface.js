(jQuery)(document).ready(function(){

	/* make table sortable */
	table_sortable(1, 0);
	
	/* auto clear text fields with autoClear class */
	autoClearClass();
	
	/* make buttons look nice when hovered */
	ui_hover_behavior();
	
	/* make table with "searchable" class searchable */
	table_searchable();
	
	/* make table with "clickable" class clickable */
	table_clickable();
});


