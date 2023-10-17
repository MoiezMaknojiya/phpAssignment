function getBiddingList()
{
    $.ajax({
        method: "GET",
        url: "modules/item_listing.php",
        data: {},
        dataType: 'json',
        success: function (data)
        {
            if (data.status)
            {
                jQuery('.bids').html(data.response);
            }
        }
    });
}


$(document).ready(function($){
    getBiddingList();
    $('body').on('click', '.place_bid_btn', function(){
        $('.bid_popup').css('display', 'block');
        $('.item_id').val($(this).data('id'));
        $('.current_bid_price').val($(this).data('amount'));
    });

    $('body').on('click', '.bid_popup_content_close', function(){
        $('.bid_popup').css('display', 'none');
        $('.item_id').val('');
        $('.current_bid_price').val('');
    });
    
    jQuery('body').on('click', '.buy_it_btn', function(){
        $.ajax({
            method:"POST",
            url  : "modules/buy_it_now.php",
            data : {
                item_id: $(this).data('id')
            },
            dataType: 'json',
            success: function(data)
            {
                if(data.status)
                {
                    setTimeout(function() { 
                        window.location.href="bidding.php";
                    }, 8000);
                }
                else
                {
                }
            }
        });
    });
});


$(document).on('submit','#placeBidForm',function(e){
    e.preventDefault();
    $.ajax({
        method:"POST",
        url  : "modules/bidding.php",
        data : $(this).serialize(),
        dataType: 'json',
        success: function(data)
        {
            if(data.status)
            {
                $('#msg').html(data.message);
                $('#placeBidForm').find('input').val('')
                setTimeout(function() { 
                    window.location.href="bidding.php";
                }, 8000);
            }
            else
            {
                $('#msg').html(data.message);
            }
        }
    });
});