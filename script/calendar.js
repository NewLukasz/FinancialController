window.onload = calendar;

function calendar(){
	var date=new Date();
	var day=date.getDate();
	var month=date.getMonth()+1;
	var year=date.getYear()+1900;
	$("#incomeDatePicker").attr('value',year+"-"+month+"-"+day);
						 
	$("#incomeDatePicker").datepicker({
		dateFormat: "yy-mm-dd"
	});
}




		
	