(jQuery)(document).ready(function(){

	/* make table javascript sortable */
	(jQuery)('#itemsTable').tablesorter( {sortList: [[1,0]]} );
	
	/* upon sort end, remove and re-assign class for alternate row color */
	(jQuery)('#itemsTable').bind("sortStart", function(){
		/*Loading notification eventually */
	}).bind("sortEnd", function(){
		(jQuery)('#itemsTable tr.alt').removeClass('alt');
		(jQuery)('#itemsTable tr:even').addClass('alt');
	});
	
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
		(jQuery)('#itemsTable tr.alt').removeClass('alt');
		(jQuery)('#itemsTable tr:even').addClass('alt');
	});
	
});

