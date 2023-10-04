$(document).on('submit','#registerForm',function(e){
    e.preventDefault();
    $.ajax({
        method:"POST",
        url  : "modules/register.php",
        data :$(this).serialize(),
        dataType: 'json',
        success: function(data)
        {
            if(data.status)
            {
                $('#msg').html(data.message);
                $('#registerForm').find('input').val('')
                window.location.href="index.php";
            }
            else
            {
                $('#msg').html(data.message);
            }
        }
    });
});