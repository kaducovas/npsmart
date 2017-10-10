<script>
//var serviceURL = "http://localhost:64721/MSAService.svc/";


var serviceURL = "";
var marketName = "";
var kendoDarkTheme = "metroblack";
var kendoLightTheme = "uniform";
var bsDarkTheme = "slate";
var invalidBrowser = false;
//var weekDuration = getStartDayForCurrentWeek();
var Start_Date = getCurrentDate();

var radarFullExportPath = "/Content/RadarExportRepository/ExcelExport_"
var radarExportLink = "";
var validAccess = true;

//Color

var tier1 = "#38AA58";//Green 
var tier2 = "#DAB143";//Yellow 
var tier3 = "#DA7643";//Orange 
var tier4 = "#DA3243";//Red 


String.prototype.replaceAll = function (target, replacement) {
    return this.split(target).join(replacement);
};

function changeUITheme(theme) {

    var oldTheme = getUITheme();

    if (oldTheme == theme)
        return;

    var url = window.location.href;
    if (url[url.length - 1] == '#')
        url = url.substring(0, url.length - 1);

    if (url.indexOf('?') >= 0) {

        if (url.indexOf("Theme=") >= 0) {
           url = url.replace("Theme=" + oldTheme, "Theme=" + theme);
        }else
            url = url + "&Theme=" + theme;
    }
    else
        url = url + "?Theme=" + theme;
   
    window.location = url;
    
}

function GetVendorId(vendor)
{
    var VendorId = -1;
    if (vendor == "Ericsson Network") {
        VendorId = 1;
    }
    else if (vendor == "Nokia Network") {
        VendorId = 2;
    }
    else if (vendor == "Hauwei Network") {
        VendorId = 6;
    }
    return VendorId;
}


function GetPivotTable(table,pivotColumn,valueColumnName,aggregationTypeUsed,aggregationColumnName)
{
    var pv = new JSPivot({
        data: trendGridData, //Unpivoted Data
        pivotColumnName: pivotColumn, //Week Coloumn to be pivoted
        valueColumnName: valueColumnName,// QDA Value for pivoted column
        aggregationType: aggregationTypeUsed, //SUM Supported Aggregations: SUM|AVG|MAX|MIN
        aggregationColumns: aggregationColumnName //Region Aggregation Columns
    });

    var pvData = pv.getPivotedData();
    var pivotedCols = pv.getPivotedColumns();
    var obj = new Object();
    $(obj).attr({ "Count": $(pivotedCols), "Data": pvData });;

    
    return obj;
}



function getStartDayForCurrentWeek() {
    var d = new Date();
    var day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6 : 1); // adjust when day is sunday
    var d1 = new Date(d.setDate(diff));
    var startDate = (d1.getFullYear() + '/' + (d1.getMonth() + 1) + '/' + (d1.getDate() - 1));
    var sD = new Date(startDate);
    var newdate = new Date(sD);
    newdate.setDate(newdate.getDate() + 6);
    var endDate = (newdate.getFullYear() + '/' + (newdate.getMonth() + 1) + '/' + newdate.getDate());
    return startDate + "-" + endDate;
}

function getCurrentDate()
{
    $today = new Date();
    $yesterday = new Date($today);
    $yesterday.setDate($today.getDate() - 7);// u can change 7 to any number for which u want to set the detault date.
    var formattedDate = new Date($yesterday.getFullYear() + '/' + ($yesterday.getMonth() + 1) + '/' + ($yesterday.getDate()));
    return formattedDate;
}

function HideShowControl(control)
{
    
    $(control).toggle("slow", function () {
        // Animation complete.
    });
}

function setUITheme(theme) {

    
    SessionManager.set("rts_Theme", theme);

}

function getUITheme() {

    var rtsTheme = SessionManager.get("rts_Theme");
    if (rtsTheme == null) {
        rtsTheme = "dark";
        SessionManager.set("rts_Theme", "dark");
    }

    return rtsTheme;
}

function GetVersion()
{
    var sqlUser = new SQLUtil();
    sqlUser.getSQLData('Select top 1 Version from RADAR_DW.[reference].[ApplicationVersion] order by 1 desc', null, 'OnGetVersion'); 

}

$(document).on("OnGetVersion", function (evt) {
  
    if (evt.response != null && evt.response != undefined && evt.response[0][0]!=undefined)
    {
        var version = evt.response[0][0].Version;
        $('#appVersionTitle').text(version); 
        $('#sVersion').text(version); 
        document.title = "Radar Tool Suite "+version;
    }

    
    

    if (!(controllerName.toLowerCase() === "home" && actionName.toLowerCase() === "index")
        &&
        !(controllerName.toLowerCase() === "admin" && actionName.toLowerCase() === "index")
        ) {

        var userInfo = SessionManager.get("radarUserInfo");

        if (controllerName.toLowerCase() === "admin" && userInfo.IsAdmin == false) {

            displayInvalidAccessMessage();

            return;
        }

        var menuArr = SessionManager.get("radarAccessInfo");

        checkUserAndCustomizeMenu(menuArr);

        setDisplayUsername();

        logFeatureAccess();
    }
});


function GetWeekNumberBySunday(fullDate)
{
    var date = new Date(fullDate);
    var d = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    var weekEndDate = new Date();
    weekEndDate = new Date(d.setDate(d.getDate() + 6));
    if(weekEndDate.getFullYear()>d.getFullYear())
    {
        return 1;
    }

    var jan1st = new Date(d.getFullYear(), 0, 1);
    var day = jan1st.getDay();
    var previousSundayOffSet = day - 0;
    var FirstSundayDate = new Date(jan1st.setDate(jan1st.getDate() - previousSundayOffSet));

    var dUTC = Date.UTC(d.getFullYear(), d.getMonth(), d.getDate());
    var firstSundatUTC = Date.UTC(FirstSundayDate.getFullYear(), FirstSundayDate.getMonth(), FirstSundayDate.getDate());

    var weekNo = ((((dUTC - firstSundatUTC) / 86400000) + 1) / 7);

    // var weekNo = ((((d - FirstSundayDate) / 86400000)+1) / 7);
    return weekNo;
}


function CreateWeekPicker()
{
    $(function () {
        var startDate;
        var endDate;
        var selectCurrentWeek = function () {
            window.setTimeout(function () {
                $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
            }, 1);
        }

        $('.week-picker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            showWeek: true,
            firstDay: 0,
            calculateWeek: GetWeekNumberBySunday,
            defaultDate: -7,
            onSelect: function (dateText, inst) {
                var date = $(this).datepicker('getDate');
                Start_Date = Start_Date = new Date(date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate());
                var week=Start_Date.getWeek();
                //$("input#inputWeekStartDay").val(week);
                $("#spDate").text("Week " + week);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                selectCurrentWeek();
                HideShowControl($('.week-picker'));
                radarExportLink = radarFullExportPath + week + ".zip";
                setExportLink();
                GetDataOnDateChange();
            },
            beforeShowDay: function (date) {
                var cssClass = '';
                if (date >= startDate && date <= endDate)
                    cssClass = 'ui-datepicker-current-day';
                return [true, cssClass];
            },
            onChangeMonthYear: function (year, month, inst) {
                selectCurrentWeek();
            },
           
        });
       
       
        $('body').on('mousemove', '.week-picker .ui-datepicker-calendar tr',
            function ()
            {
                $(this).find('td a').addClass('ui-state-hover');
            });

        $('body').on('mouseleave', '.week-picker .ui-datepicker-calendar tr',
            function () {
                $(this).find('td a').removeClass('ui-state-hover');
            });


        $(document).mouseup(function (e)
        {
            if ($(e.target).attr('Id') == "spDate" || $(e.target).attr('Id') == "inputWeekStartDay" || $(e.target).attr('Id') == "caretOptions1" || $(e.target).attr('class') == "glyphicon glyphicon-calendar pull-left")
                return;
            var container = $(".week-picker");

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                container.hide("slow");
            }
        });

        var week = Start_Date.getWeek();
        //var week = $(".selector").datepicker("option", "calculateWeek");
        radarExportLink = radarFullExportPath + week + ".zip";
        setExportLink();

        //$("input#inputWeekStartDay").val(week);
        $("#spDate").text("Week " + week);

        $('.week-picker').hide();
    });

    $('#inputWeekStartDay').click(function () {
        //$("#calendarDiv").;
        var calendarDiv = $("#calendarDiv");
        HideShowControl(calendarDiv);
    });
}

function setExportLink()
{
    if($('#exportDataLink')!=undefined)
    $('#exportDataLink').attr("href", radarExportLink);
}

function CreateDatePicker()
{
    $(function () {
        var startDate;
        var endDate;
        var selectCurrentWeek = function () {
            window.setTimeout(function () {
                $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
            }, 1);
        }
        
        $('.week-picker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            showWeek: true,
            defaultDate: -7,
            firstday: 0,
            calculateWeek: GetWeekNumberBySunday,
            onSelect: function (dateText, inst) {
                var date = $(this).datepicker('getDate');
                Start_Date = new Date(date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate());
                var selectedDate = Start_Date.getFullYear() + '/' + (Start_Date.getMonth() + 1) + '/' + Start_Date.getDate();
                //$("input#inputWeekStartDay").val(selectedDate);
                $("#spDate").text(selectedDate);
                HideShowControl($('.week-picker'));
                GetDataOnDateChange();
            },
            beforeShowDay: function (date) {
                var cssClass = '';
                if (date >= startDate && date <= endDate)
                    cssClass = 'ui-datepicker-current-day';
                return [true, cssClass];
            },
            onChangeMonthYear: function (year, month, inst) {
             
                selectCurrentWeek();
            }
        });

        var date = $('.week-picker').datepicker('getDate');
        Start_Date =new Date(date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate());
        var selectedDate = date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate();
        //$("input#inputWeekStartDay").val(selectedDate);
        $("#spDate").text(selectedDate);
        $('.week-picker').hide();
    });

    $(document).mouseup(function (e)
    {
        if ($(e.target).attr('Id') == "spDate" || $(e.target).attr('Id') == "inputWeekStartDay" || $(e.target).attr('Id') == "caretOptions1" || $(e.target).attr('class') == "glyphicon glyphicon-calendar pull-left")
            return;
        var container = $(".week-picker");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.hide("slow");
        }
    });

   

    $('#inputWeekStartDay').click(function ()
    {
        var calendarDiv = $("#calendarDiv");
        HideShowControl(calendarDiv);
    });

}
var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
];

//function FormatSelectDate()
//{
//    var dateArray = weekDuration.split('-');
//    var d1 = new Date(dateArray[0]);
//    var startDateValue = monthNames[(d1.getMonth())] + " " + d1.getDate();
//    var d2 = new Date(dateArray[1]);
//    var endDateValue = monthNames[(d2.getMonth())] + " " + d2.getDate();
//    var duration = (startDateValue + " - " + endDateValue);
//    return duration;
//}

Date.prototype.getWeek = function ()
{
    var d = new Date(this);
    d.setHours(0, 0, 0);
    var week = 0;
    if (d.getDay() == 0)
        week = GetWeekNumberBySunday(d);
    else
    {
        var previousSundayDate = new Date();
        previousSundayDate = new Date(d.setDate(d.getDate() - d.getDay()));
        week = GetWeekNumberBySunday(previousSundayDate);
    }
    return week;

    //d.setHours(0, 0, 0);
    //// Set to nearest Thursday: current date + 4 - current day number
    //// Make Sunday's day number 7
    //d.setDate(d.getDate() + 3 - (d.getDay()));
    //// Get first day of year
    //var yearStart = new Date(d.getFullYear(), 0, 1);
    //// Calculate full weeks to nearest Thursday
    //var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7)
    //// Return array of year and week number
    //return [weekNo];
 
};

/************************** Navigate **************************************/

function navigateHome()
{
    window.location.href = "/";
}

function navigateToRoute(route)
{
    window.location.href = route;
}

function CreateBreadCrumbs(path)
{
    var pathArray = path.split('/');
    var html = "<div id='navcontainer'><ul id='navMenulist'>";
    if (pathArray.length == 1)
    {
        html += '<li><p>'+"&#0187;"+'</p></li>'
        var crumbName = "Radar";
        var pathValue = "/";
        html += '<li><a class="dropdown-toggle" title="' + pathValue + '">' + crumbName + '</a></li>'
    }
    else
    {
        for (var i = 0; i < pathArray.length; i++) {
            var crumbName = pathArray[i];
            if (crumbName == "") continue;
            if (i == (pathArray.length - 1)) {
                html += '<li><p>' + "&#0187;" + '</p></li>'
                html += '<li><a class="dropdown-toggle" data-toggle="dropdown" data-target="#"  title="' + path + '">' + crumbName + '</a></li>'
            }
            else
            {
                html += '<li><p>' + "&#0187;" + '</p></li>'
                html += '<li><p>' + crumbName + '</p></li>'
            }
        }
    }
    html = html + "</ul></div>"
    $('#divBreadCrumbs').html(html);
}

Array.prototype.select = function (expr) {
    var arr = this;
    //do custom stuff
    return arr.map(expr); //or $.map(expr);
};

function checkUserAndCustomizeMenu(menuArr) {

    if (controllerName == "Home" && actionName == "Index")
        return;

    if (controllerName == "Admin" && actionName == "Index")
        return;

    if (!menuArr) {
        window.location.href = '/';
        return;
    }

    var controller = controllerName.toLowerCase();

    if (controllerName == "Home")
        controller = "radar";

    validAccess = true;

    var ids = menuArr.select(function (v) {
        if(v.IsAllowed==0)
        return v.FeatureAlias;
    });

    jQuery.each(ids, function (i, val) {

        if (val != null) {
            $("#menuItem" + val).hide();
            if (controller == val)
                validAccess = false;
        }
        
    });


    /*Disable User Management System Code Starts*/
    validAccess = true;
    /*Disable User Management System Code Ends*/
}

function displayInvalidAccessMessage(containerDiv) {

    if (invalidBrowser)
        return;

    if (typeof containerDiv === 'undefined')
        containerDiv = 'mainContainer';

    $("#optionsMenu").hide();
    $("#" + containerDiv).html('<div class="row" id="panelRow">\
    <div class="col-md-2 center-block" style="float:none;margin-top:100px;height:60px;width:400px;" id="panelColumn" ><div class="alert alert-dismissible alert-danger" style="text-align:center">\
  You do not have access to this Section\
</div></div></div>');

}

function setDisplayUsername() {

    var userInfo = SessionManager.get("radarUserInfo");

    if (userInfo.IsAdmin == false)
        $("#liAdmin").hide();

    if (!userInfo) {
        window.location.href = '/';
        return;
    }

    var displayName = userInfo.FullName;
    if (displayName.length > 10 && displayName.indexOf(" ") > 0) {
        displayName = userInfo.FullName.split(" ")[0];
    }
    else
        if (displayName.length > 10 && userInfo.LogInName.length <= 10) {
            displayName = userInfo.LogInName;
        } else
            if (displayName.length > 10 && userInfo.LogInName.indexOf(".") > 0) {
                displayName = userInfo.LogInName.split(".")[0];
            }

    if (displayName.length <= 10)
        $("#spUsername").text(displayName);
    else {
        $("#spUsername").text("Account");
        $("#ulUser").prepend("<li class='disabled'><a href='#'>" + displayName + "</a></li><li class='divider'></li>");
    }
    
}

function logFeatureAccess() {

    if (controllerName.toLowerCase() === "home" && actionName.toLowerCase() === "index")
        return;

    var userInfo = SessionManager.get("radarUserInfo");

    if (!userInfo) {
        window.location.href = '/';
        return;
    }

    var controller = controllerName.toLowerCase();

    if (controllerName == "Home")
        controller = "radar";

    
    var sqlUser = new SQLUtil();
    sqlUser.executeNoResponseSP('RADAR_DW.[ui].[up_UserFeatureAccessLog]', { "LogInName": userInfo.LogInName, "FeatureAlias": controller });
}


function changePassword() {

    var userInfo = SessionManager.get("radarUserInfo");

    if (!userInfo) {
        window.location.href = '/';
        return;
    }


    if ($("#newPassword").val() !== $("#confirmPassword").val()) {

        $("#spanErrorMessageCP").text("Passwords do not match!");
        return;
    }

    if ($("#newPassword").val().length <= 0) {

        $("#spanErrorMessageCP").text("Invalid Password!");
        return;
    }


    if ($("#oldPassword").val() === $("#newPassword").val()) {

        $("#spanErrorMessageCP").text("New Password cannot be same as Old Password!");
        return;
    }

    var sqlUser = new SQLUtil();
    kendo.ui.progress($("#passwordModal"), true);
    sqlUser.getSPData('RADAR_DW.ui.up_UserChangePassword', { "LogInName": userInfo.LogInName, "OldPassword": $("#oldPassword").val(), "NewPassword": $("#newPassword").val() }, null, 'changePassword');

   // $("#passwordModal").modal('hide');

    //spanErrorMessageCP
}


$(document).on("changePassword", function (evt) {

    kendo.ui.progress($("#passwordModal"), false);

    if (evt.status == 0) {
        bootbox.alert(evt.message);
        return;
    }

    if (evt.response[0][0].MessageText.toLowerCase() !== "success") {
        $("#spanErrorMessageCP").text(evt.response[0][0].MessageText);
        return;
    }

    $("#passwordModal").modal('hide');

    bootbox.alert('Password successfully changed!')

});



function logoutUser() {

    SessionManager.set("radarUserInfo", null);
    SessionManager.set("radarAccessInfo", null);


    window.location.href = '/';
}


function reposition() {
    var modal = $(this),
        dialog = modal.find('.modal-dialog');
    modal.css('display', 'block');

    // Dividing by two centers the modal exactly, but dividing by three 
    // or four works better for larger screens.
    dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
}


function usernameIsValid(username) {
    return /^[0-9a-zA-Z_.-]+$/.test(username);
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

// Reposition when the window is resized
$(window).on('resize', function () {
    $('.modal:visible').each(reposition);
});

function getUserInfo() {
    var ui = SessionManager.get("radarUserInfo");
    if (!ui)
        window.location.href = '/';
    else
        return ui;
}

function getUserAccessInfo() {
    var ui = SessionManager.get("radarAccessInfo");
    if (!ui)
        window.location.href = '/';
    else
        return ui;
}

function htmlEncode(value) {
    return $('<div/>').text(value).html();
}

function htmlDecode(value) {
    return $('<div/>').html(value).text();
}
</script>