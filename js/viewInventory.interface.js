(jQuery)(document).ready(function(){

	/* make table javascript sortable */
	(jQuery)('#itemsTable').tablesorter( {sortList: [[1, 0]]} );
	
	/* auto clear text fields with autoClear class */
	autoClearClass();
	
	/* Change all category_selects into fancy ones */
	(jQuery)('.category_select').livequery(function(){ (jQuery)(this).asmSelect(); });
	
	/* make buttons look nice when hovered */
	ui_hover_behavior();
	
	var theTable = (jQuery)('#itemsTable');
	
	theTable.find("tbody > tr").find("td:eq(1)").mousedown(function(){
    (jQuery)(this).prev().find(":checkbox").click()
  });

	(jQuery)('#searchField').keyup(function() {
		(jQuery).uiTableFilter(theTable, this.value);
	});
	
});
