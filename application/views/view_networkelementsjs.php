<script>
var callBackMethod;
var selectedNetworkElement = 'Entire Network';

function SetSelectedValue(Value) {
    $("select#networkNodeSelector").val(Value);
}

function CreateNetworkElementDropDownList() {

    var html = '';
    var key = '';
    $(networkElementList).each(function () {
        if (key == $(this).attr('Key')) {
            var val = $(this).attr('Value');
            html += '<option level=' + key + '>' + val + '</option>'
        }
        else {
            if (key == '') {
                key = $(this).attr('Key');
                html += '<optgroup label=' + key + '>';

                var val = $(this).attr('Value');
                html += '<option level=' + key + '>' + val + '</option>'
            }
            else {
                html += '</optgroup>';
                key = $(this).attr('Key');
                html += '<optgroup label=' + key + '>';

                var val = $(this).attr('Value');
                html += '<option level=' + key + '>' + val + '</option>'
            }
        }
    });
    $('select#networkNodeSelector').append(html);

    if (selectedNetworkElement == '' || selectedNetworkElement == 'Network')
        SetSelectedValue('Entire Network');
    else
        SetSelectedValue(selectedNetworkElement);
}


var Markets = [];
var Countries = [];
var Regions = [];
var Clusters = [];
var RNCs = [];

var networkElementList = new Array();
var arrayObj = new Object;
var defaultNetworkElements = new Array();

$(document).on("displayNetworkData", function (evt) {

    kendo.ui.progress($("#mainContainer"), false);

    if (evt.status == 0) {
        bootbox.alert(evt.message);
        return;
    }
    Countries = evt.response[1];;
    Regions = evt.response[2];;
    Clusters = evt.response[3];
    RNCs = evt.response[4];

    if (hasEntireNetworkGlobal == true) {
        var obj = new Object("Entire Network" );
        defaultNetworkElements.push(obj);
    }

    if (hasVendorsGlobal == true) {
        defaultNetworkElements.push("Ericsson Network");
        defaultNetworkElements.push("Nokia Network");
        defaultNetworkElements.push("Hauwei Network");
    }

    defaultNetworkElements.forEach(function (item) {
        $(arrayObj).attr({ "Key": "Network", "Value": item });
        networkElementList.push(arrayObj);
        arrayObj = new Object;
    });

    if (hasCountryGlobal == true) {
        $(Countries).each(function () {
            $(arrayObj).attr({ "Key": "Country", "Value": $(this).attr('Country') });
            networkElementList.push(arrayObj);
            arrayObj = new Object;
        });
    }

    if (hasRegionsGlobal == true) {
        $(Regions).each(function () {
            $(arrayObj).attr({ "Key": "Region", "Value": $(this).attr('Region') });
            networkElementList.push(arrayObj);
            arrayObj = new Object;
        });
    }

    if (hasClustersGlobal == true) {
        $(Clusters).each(function () {
            $(arrayObj).attr({ "Key": "Cluster", "Value": $(this).attr('Cluster') });
            networkElementList.push(arrayObj);
            arrayObj = new Object;
        });
    }

    if (hasRncsGlobal == true) {
        $(RNCs).each(function () {
            $(arrayObj).attr({ "Key": "RNC", "Value": $(this).attr('RNCName') });
            networkElementList.push(arrayObj);
            arrayObj = new Object;
        });
    }

    CreateNetworkElementDropDownList();

    $.event.trigger({
        type: callBackMethod,
        status: 1,
        message: 'Success',
    });
});

var hasEntireNetworkGlobal = false;
var hasCountryGlobal = false;
var hasVendorsGlobal = false;
var hasRegionsGlobal = false;
var hasClustersGlobal = false;
var hasRncsGlobal = false;

function GetNetworkElementData(parameters, callback) {

    //var networkElement = $("select#networkNodeSelector option:selected").val();
    var sql = new SQLUtil();
    kendo.ui.progress($("#mainContainer"), true);
    sql.getSPData('NQI.dbo.sp_GetNetworkElements_v3 ', {}, null, 'displayNetworkData');

    var params = [];
    for (var i in parameters) {

        if (parameters.hasOwnProperty(i))
        {
            if (i == "EntireNetwork")
            {
                hasEntireNetworkGlobal = parameters[i];
            }
            else if (i == "Vendor") {
                hasVendorsGlobal = parameters[i];
            }
            if (i == "Country") {
                hasCountryGlobal = parameters[i];
            }
            else if (i == "Region") {
                hasRegionsGlobal = parameters[i];
            }
            else if (i == "Cluster") {
                hasClustersGlobal = parameters[i];
            }
            else if (i == "Rnc") {
                hasRncsGlobal = parameters[i];
            }
        }

    }
    callBackMethod = callback;
}
</script>