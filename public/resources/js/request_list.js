// List Options
var request_options = {
    valueNames: ['id', 'user', 'fac', 'dep', 'nop', 'reqdate', 'deptime', 'dest', 'contno', 'driver', 'status', 'edit']
};

// Create List
var requestList = new List('reqList', request_options);

// Sort List
requestList.sort('reqdate', {
    order: "asc"
});
requestList.sort('status', {
    order: "desc"
});

//Call to reset list
function resetReqList() {
    resetList(requestList);
}

function updateReqList() {
    var values_status = $("input[name=status]:checked").val();
    console.log(values_status);

    requestList.filter(function (item) {
        var statusFilter = false;

        if (values_status == "all") {
            statusFilter = true;
        } else {
            statusFilter = item.values().status == values_status;
        }

        return statusFilter
    });
    requestList.update();
    //console.log('Filtered: ' + values_gender);
}

$(function () {
    $("input[name=status]").change(updateReqList);

    requestList.on('updated', function (list) {
        if (list.matchingItems.length > 0) {
            $('.no-result').hide()
        } else {
            $('.no-result').show()
        }
    });
});