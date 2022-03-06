$(document).ready(function() {
	loadData();
});

function loadData(){
	$.get('ListData/getListCate.php',function(data){
		$('#listCate').html(data);
		$('.deleteCate').click(function(e){
			e.preventDefault();
			$.ajax({
			type:'get',
			url:$(this).attr('href'),
			success: function(data){
				loadData();
				$('#ms').html(data);
			}});
		});
	});
}
