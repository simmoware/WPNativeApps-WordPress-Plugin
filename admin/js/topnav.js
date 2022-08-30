function addTopNavHamburgerItem(el){

			var section = $(el).parents('section.navStructureRow');
			var pagecount = $(el).parents('.topNavPageSettings').attr('data-pagecount');
			var structureCount = $(el).parents('.navStructureRow').attr('data-structure');
			var navItemsCount = parseInt($(section).find('.topNavPageIconItem').length);

			var newIconHtml = $('#topNavNaviagionHamburgerItemGeneric').html();
			newIconHtml = newIconHtml.replaceAll('{{iconCount}}',navItemsCount+1).replaceAll('{{topNavTabCount}}',pagecount).replaceAll('{{structureCount}}',structureCount);
			if(navItemsCount >=1){
				var removeIcon = '<span class="button removeNavigationIconRow" onclick="removeTopNavigationIconForHamburger(this);">Remove</span>';
			}else{
				var removeIcon = '';
			}


			$(section).find('span.removeNavigationIconRow').remove();

			$(el).parent().before('<div class="flex-column topNavPageIconItem">'+newIconHtml+'</div>'+removeIcon);


				$(section).find('.addNewNavigationIcon').removeClass('hide');
		



}
function removeTopNavigationIconForHamburger(el){
	$=jQuery;
	var section = $(el).parents('section.navStructureRow');

	var count = parseInt($(section).find('.topNavPageIconItem').length);
	// console.log(count);
	// if(count >= 1){
		if(confirm("Do you want to remove this?")){
			$(section).find('.topNavPageIconItem:nth('+(count-1)+')').remove()
			// $(removeel).remove();
			$(section).find('.addNewNavigationIcon').removeClass('hide');
			console.log(count);
			if(count == 2){
					$(section).find('span.removeNavigationIconRow').remove();
			}
		}

	// }
}
