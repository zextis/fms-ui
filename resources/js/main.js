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


var request_options = {
    valueNames: ['id', 'user', 'fac', 'dep', 'nop', 'reqdate', 'deptime', 'dest', 'contno', 'driver', 'stat', 'edit']
};

var requestList = new List('reqList', request_options);

// var status = document.getElementsByClassName('stat');

// if (status.textContent == "approved"){
//     status.classList.addClass("good");
// }

function resetReqList() {
    resetList(requestList);
}

function resetList(listObj) {
    // requestList.search();
    // requestList.filter();
    // requestList.update();
    // $(".filter-all").prop('checked', true);
    // $('.filter').prop('checked', false);
    // $('.search').val('');
    //console.log('Reset Successfully!');
    document.querySelector('.search').value = "";
    // $('.search').val('');
    listObj.search("");
};

function updateList() {
    var values_status = querySelector("input[name=status]:checked").value;
}