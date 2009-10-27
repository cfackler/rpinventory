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

