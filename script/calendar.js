window.onload = calendar;

function calendar(){
	var date=new Date();
	var day=date.getDate();
	var month=date.getMonth()+1;
	var year=date.getYear()+1900;
	$("#datePicker").attr('value',year+"-"+month+"-"+day);
						 
	$("#datePicker").datepicker({
		dateFormat: "yy-mm-dd"
	});
}




		
	