//  ---------------------------------------------------------------------
//  Page Tab Function ---------------------------------------------------
//  ---------------------------------------------------------------------
function openPage(pageName, elmnt, color) {
	// Hide all elements with class="tabcontent" by default */
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}

	// Remove the background color of all tablinks/buttons
	tablinks = document.getElementsByClassName("tablink");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].style.backgroundColor = "";
	}

	// Show the specific tab content
	document.getElementById(pageName).style.display = "block";

	// Add the specific color to the button used to open the tab content
	elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


//  ---------------------------------------------------------------------
//  Reset List Function -------------------------------------------------
//  ---------------------------------------------------------------------
function resetList(list) {
	list.search();
	list.filter();
	list.update();
	list.sort('reqdate', {
		order: "asc"
	});
	list.sort('status', {
		order: "desc"
	});
	$(".filter-all").prop('checked', true);
	$('.filter').prop('checked', false);
	$('.search').val('');
	//console.log('Reset Successfully!');
};



// ----- TEMPLATE CODE DO NOT TOUCH!!!!!!!!! -------
/* function updateList(){
  var values_gender = $("input[name=gender]:checked").val();
	var values_address = $("input[name=address]:checked").val();
	console.log(values_gender, values_address);

	userList.filter(function (item) {
		var genderFilter = false;
		var addressFilter = false;
		
		if(values_gender == "all")
		{ 
			genderFilter = true;
		} else {
			genderFilter = item.values().gender == values_gender;
			
		}
		if(values_address == null)
		{ 
			addressFilter = true;
		} else {
			addressFilter = item.values().address.indexOf(values_address) >= 0;
		}
		return addressFilter && genderFilter
	});
	userList.update();
	//console.log('Filtered: ' + values_gender);
}
                               
$(function(){
  //updateList();
  $("input[name=gender]").change(updateList);
	$('input[name=address]').change(updateList);
	
	userList.on('updated', function (list) {
		if (list.matchingItems.length > 0) {
			$('.no-result').hide()
		} else {
			$('.no-result').show()
		}
	});
}); */
// ----- TEMPLATE CODE DO NOT TOUCH!!!!!!!!! -------