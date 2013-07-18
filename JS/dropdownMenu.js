/* ------------

JS code for the dropdown menu at Brain Freeze Studios,
used for screens 790px and under.
Created by : Andres Mrad (Q-ro).
Creation date: June 25 2013.

-------------- */

$(document).ready(function () {

    //Hide submenu on page load.    
    $(".submenu").hide();
    
    $(".dorpdown_Menu_Icon").click(function () {
        var X = $(this).attr('id');
        if (X == 1) {
            $(".submenu").hide();
            $(this).attr('id', '0');
        } else {
            $(".submenu").show();
            $(this).attr('id', '1');
        }

    });

    //Mouse click on sub menu
    $(".submenu").mouseup(function () {
        return false
    });

    //Mouse click on dorpdown_Menu_Icon
    $(".dorpdown_Menu_Icon").mouseup(function () {
        return false
    });


    //Document Click
    $(document).mouseup(function () {
        $(".submenu").hide();
        $(".dorpdown_Menu_Icon").attr('id', '');
    });
});