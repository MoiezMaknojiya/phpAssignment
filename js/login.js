$(document).on('submit','#loginForm',function(e){
    e.preventDefault();
    $.ajax({
        method:"POST",
        url  : "modules/login.php",
        data :$(this).serialize(),
        dataType: 'json',
        success: function(data)
        {
            if(data.status)
            {
                $('#msg').html(data.message);
                window.location.href="listing.php";
                $('#loginForm').find('input').val('')
            }
            else
            {
                $('#msg').html(data.message);
            }
        }
    });
});