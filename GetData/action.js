$(document).ready(function(){
	loadListCateData();
	loadDiscountListData();

	//Insert Category Data to Database
	$(document).on('submit','#insertCateFrm',function(e){
			e.preventDefault();
			$.ajax({
			method:"POST",
			url: "GetData/InsertCate.php",
			data:$(this).serialize(),
			success: function(data){
				loadListCateData();
				$('#ms').html(data);
				$('#insertCateFrm').find('input').val('');
		}});
		document.getElementById('description').value = "";
	});

	//Insert Discount Data to Database
	$(document).on('submit','#inserDiscountData',function(e){
			e.preventDefault();
			$.ajax({
			method:"POST",
			url: "GetData/InsertDiscount.php",
			data:$(this).serialize(),
			success: function(data){
				loadDiscountListData();
				$('#ms1').html(data);
				$('#inserDiscountData').find('input').val('');
		}});
		document.getElementById('desc').value = "";
	});
	
});

//Get Category List Data From Database
function loadListCateData(){
	$.get('GetData/getCate.php',function(data){
		$('#listCate').html(data);
	});
}

//Get Discount List Data From Database
function loadDiscountListData(){
	$.get('GetData/getDiscount.php',function(data){
		$('#displayData').html(data);
	});
}