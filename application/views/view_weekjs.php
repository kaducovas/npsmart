<script>
function weekPicker()
{
	$('.week-picker').datepicker({
		showOtherMonths: true,
		selectOtherMonths: true,
		showWeek: true,
		dateFormat: "yy-mm-dd",
		calculateWeek: myWeekCalc,
		onSelect: alert("oi")
	});



	function myWeekCalc(date) {
		var checkDate = new Date(date.getTime());
		// Find Thursday of this week starting on Sunday
		checkDate.setDate(checkDate.getDate() + 4 - (checkDate.getDay()));
		var time = checkDate.getTime();
		checkDate.setMonth(0); // Compare with Jan 1
		checkDate.setDate(1);
		return Math.floor(Math.round((time - checkDate) / 86400000) / 7) + 1;
	}
	
	function getMonday(d) {
		d = new Date(d);
		var day  = d.getDay(), 
			diff = d.getDate() - day + (day == 6 ? 7:0); // adjust when day is sunday
		console.log(day);
		return new Date(d.setDate(diff));
	}

	function onSelect(dateString, inst) {
		console.log(getMonday(dateString));
		$('input[name=date]').val(dateString);
		$(this).val('Week ' + myWeekCalc(getMonday(dateString)));
	}

	console.log('week-picker value: ' + $('.week-picker').val());

	if ($('input[name=date]').val() === "") {
		$('input[name=date]').val($('.week-picker').val());
		$('.week-picker').val('Week ' + myWeekCalc(new Date($('.week-picker').val())));

		$('.ui-datepicker').on('mousemove', 'tr', function() {
			$(this).find('td a').addClass('ui-state-hover');
		});
		$('.ui-datepicker').on('mouseleave', 'tr', function() {
			$(this).find('td a').removeClass('ui-state-hover');
		});
	}

}

</script>

