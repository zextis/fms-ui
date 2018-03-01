(function ($) {
	//Tab Functionality
	$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');

	$('.tab ul.tabs li a').click(function (g) {
		var tab = $(this).closest('.tab'),
			index = $(this).closest('li').index();

		tab.find('ul.tabs > li').removeClass('current');
		$(this).closest('li').addClass('current');

		tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
		tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();

		g.preventDefault();
	});

	//Create Dynatable
	function makeTable(tableId, queryId) {
		return $(tableId).dynatable({
			dataset: {
				perPageDefault: 10,
				perPageOptions: [10, 20, 30]
			},
			inputs: {
				queries: $(queryId)
			}
		});
	}

	//Dynatable Initializations
	makeTable('#requestTable', "#search-status");
	makeTable('#driverTable', "#search-status");
	makeTable('#vehicleTable', "#search-availability");
	makeTable('#userTable', "#search-facility");

	//Selectric
	$('select').selectric();
})(jQuery);