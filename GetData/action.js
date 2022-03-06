$(document).ready(function(){
	loadData();
	
	//Insert Data to Database
	$(document).on('submit','#insertCateFrm',function(e){
			e.preventDefault();
			$.ajax({
			method:"POST",
			url: "GetData/InsertCate.php",
			data:$(this).serialize(),
			success: function(data){
				loadData();
				$('#ms').html(data);
				$('#insertCateFrm').find('input').val('');
		}});
		document.getElementById('description').value = "";
	});
	
});

//GetData From Database
function loadData(){
	$.get('GetData/getCate.php',function(data){
		$('#listCate').html(data);
	});
}