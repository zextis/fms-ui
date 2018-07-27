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
			features: {
				pushState: false,
				sort: true
			},
			dataset: {
				perPageDefault: 10,
				perPageOptions: [10, 20, 30],
			},
			inputs: {
				queries: $(queryId)
			}
		});
	}

	$('#requestTable').bind('dynatable:init', function (e, dynatable) {
		dynatable.sorts.add('requiredDate', 1);
	}).dynatable({
		features: {
			pushState: false,
			sort: true
		},
		dataset: {
			perPageDefault: 10,
			perPageOptions: [10, 20, 30],
		},
		inputs: {
			queries: $('#search-status')
		}
	});


	//Dynatable Initializations
	makeTable('#requestTable', "#search-status");
	makeTable('#driverTable', "#search-status");
	makeTable('#vehicleTable', "#search-availability");
	makeTable('#userTable', "#search-facility");


	//Selectric
	$('select').selectric({
		maxHeight: 100
	  });

	alertify.closeLogOnClick(true)
		.logPosition("top right");

	$(".btn-reset").click(function () {
		alertify.error("Form has been reset");
	});

	$(".newform").submit(function () {
		alertify.success("Updated");
	});





	$('#driver_opt').change(function () {
		var driver_id = $('#driver_opt').val();
		var required_date = $('#reqdate').val();
		var driverString = 'driver_id=' + driver_id + '&required_date=' + required_date;

		$.ajax({
			type: "post",
			url: url + "requests/checkDriver",
			data: driverString,
			cache: false,
			success: function (response) {
				if (response != false) {
					showResponse(response, ".reply");
				} else {
					formFooterReset('driver');
				}
			}
		});
	});

	$('#vehicle_opt').change(function () {
		var license_plate = $('#vehicle_opt').val();
		var required_date = $('#reqdate').val();
		var vehicleString = 'license_plate=' + license_plate + '&required_date=' + required_date;

		$.ajax({
			type: "post",
			url: url + "requests/checkVehicle",
			data: vehicleString,
			cache: false,
			success: function (responsetwo) {
				if (responsetwo != false) {
					showResponse(responsetwo, ".reply-two");
				} else {
					formFooterReset('vehicle');
				}
			}
		});
	});

	function showResponse($reply, $box_id) {
		$($box_id).removeClass("form__hidden");
		$($box_id).html($reply);
		$("input[type=submit]").attr("disabled", "disabled");
		$num_msgs = $num_msgs + 1;
	}

	function formFooterReset($opt) {
		if ($opt == 'vehicle') {
			$('.reply-two').addClass("form__hidden");
			$('.reply-two').html("");
			if ($num_msgs > 0) {
				$num_msgs = $num_msgs - 1;
			}
		} else if ($opt == 'driver') {
			$('.reply').addClass("form__hidden");
			$('.reply').html("");
			if ($num_msgs > 0) {
				$num_msgs = $num_msgs - 1;
			}
		}
		if ($num_msgs < 1) {
			enableSubmit();
		}

	}

	function enableSubmit() {
		var $this = $("input[type=submit]");
		if ($this.attr('disabled')) $this.removeAttr('disabled');
	}

	$('#status-approved').click(function () {
		$('#comments').prop("required", false);
		$('#comments').val("");
		$('.comment').removeClass("in_form animated fadeInUp");
		$('.comment').addClass("form__hidden");
		$('.condopt').removeClass("form__hidden");
		$('.condopt').addClass("in_form animated fadeInUp");
		$('#vehicle_opt , #driver_opt').prop("required", true);
		$('#vehicle_opt, #driver_opt').prop('selectedIndex', 0).selectric('refresh');
		$num_msgs = 0;
		formFooterReset('vehicle');
		formFooterReset('driver');
	});

	$('#status-rejected').click(function () {
		$num_msgs = 0;
		formFooterReset('vehicle');
		formFooterReset('driver');
		$('.condopt').addClass("form__hidden");
		$('#vehicle_opt, #driver_opt').prop('required', false);
		$('#comments').prop("required", true);
		$('.comment').removeClass("form__hidden");
		$('.comment').addClass("in_form animated fadeInUp");
		$('.condopt').removeClass("in_form animated fadeInUp");
	});




})(jQuery);