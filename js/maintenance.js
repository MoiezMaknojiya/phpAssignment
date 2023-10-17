function process_auction_items()
{
    $.ajax({
        method: "GET",
        url: "modules/maintenance.php",
        dataType: 'json',
        success: function (data)
        {
            if (data.status)
            {
                $('#msg').html(data.message);
            }
            else
            {

            }
        }
    });
}
$(document).ready(function($){

    $('body').on('click', '.generate_report', function(){
        $.ajax({
            type: "POST",
            url: "modules/generate_report.php",
            dataType: 'json',
            success: function(data)
            {
                $("#report_table").html(data.html);
            }
        });
    });

    $('body').on('click', '.process_auction_items', function(){
        process_auction_items();
    });
});