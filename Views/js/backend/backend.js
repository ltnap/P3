/**
 * Created by Ltnap on 13/11/2017.
 */

jQuery(function($)
{
    $(".tooltip-action").tooltip();

    var alert = $('#alert');
    if(alert.length > 0){
        alert.hide().slideDown(500).delay(2000).slideUp();
    }
});