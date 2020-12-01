window.onload = calendar;

function calendar(){
	var date=new Date();
	var day=date.getDate();
	var month=date.getMonth()+1;
	var year=date.getYear()+1900;
	$("#expenseDatePicker").attr('value',year+"-"+month+"-"+day);
						 
	$("#expenseDatePicker").datepicker({
		dateFormat: "yy-mm-dd"
	});
}




		
	