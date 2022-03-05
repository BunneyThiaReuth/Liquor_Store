$(document).on('submit','#insertCateFrm',function(e){
        e.preventDefault();
        $.ajax({
        method:"POST",
        url: "InsertCate.php",
        data:$(this).serialize(),
        success: function(data){
        $('#ms').html(data);
        $('#insertCateFrm').find('input').val('')
    }});
	document.getElementById('description').value = "";
});
