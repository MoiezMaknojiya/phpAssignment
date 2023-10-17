$(document).ready(function($){
    $('body').on('change', '#categories', function(){
        if(this.value == "Other")
        {
            $('.other_category_field').show();
        }
        else
        {
            $('.other_category_field input[name="other_category"]').val('');
            $('.other_category_field').hide();
        }
    });
});


$(document).on('submit','#listingForm',function(e){
    e.preventDefault();
    $.ajax({
        method:"POST",
        url  : "modules/listing.php",
        data :$(this).serialize(),
        dataType: 'json',
        success: function(data)
        {
            if(data.status)
            {
                $('#msg').html(data.message);
                $('#listingForm').find('input').val('')
                setTimeout(function() { 
                    window.location.href="listing.php";
                }, 8000);
            }
            else
            {
                $('#msg').html(data.message);
            }
        }
    });
});