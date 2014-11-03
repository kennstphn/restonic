console.log('hello world');



jQuery(document).ready(function($){

    var genericCloseBtnHtml = '<button type="button" class="close" aria-hidden="true">&times;</button>';

    /* receipt */

    // get the container element to build the popopver
    receipt = $('#tbl_warranty_claim_oct___original_receipt');

    // popover object created with bootstrap
    receipt.popover({
        html: true,
        trigger: 'manual',
        placement: 'bottom',
        title: 'Please note',
        content: 'If you do not have your original receipt, your claim will be received but cannot be processed.'
    });

    // on change check value and show popover
    $('input[name="tbl_warranty_claim_oct___original_receipt[]"]').change(function(){

        // convert the input to boolean
        var inputValue = parseBool(this.value);

        if (! inputValue)
        {
            receipt.popover('show');
            setTimeout(function() {
               receipt.popover('hide')
            }, 5000); // auto hide after 5 seconds
        }

        // if we have a popover go ahead and hide it
        if (inputValue)
        {
            receipt.popover('hide');
        }
    }); // receipt popover

    /* end receipt */

    /* rigid support */

    // get the container element to build the popopver
    rigidSupport = $('#tbl_warranty_claim_oct___rigid_center_support');

    // popover object created with bootstrap
    rigidSupport.popover({
        html: true,
        trigger: 'manual',
        placement: 'bottom',
        title: 'Please note',
        content: 'Queen and King size bedding requires a metal frame (or bed case) with rigid center support as outlined in our warranty policy'
    });

    // on change check value and show popover
    $('input[name="tbl_warranty_claim_oct___rigid_center_support[]"]').change(function(){

        // convert the input to boolean
        var inputValue = parseBool(this.value);

        if (! inputValue)
        {
            rigidSupport.popover('show');
            setTimeout(function() {
                rigidSupport.popover('hide')
            }, 5000); // auto hide after 5 seconds
        }

        // if we have a popover go ahead and hide it
        if (inputValue)
        {
            rigidSupport.popover('hide');
        }
    }); // rigidSupport popover

    /* end rigid support */

    /*  Soiled free */

    // get the container element to build the popopver
    soiledFree = $('#tbl_warranty_claim_oct___soils_stains');

    // popover object created with bootstrap
    soiledFree.popover({
        html: true,
        trigger: 'manual',
        placement: 'bottom',
        title: 'Please note',
        content: 'Mattress must be free from soils and stains for a warranty claim to be processed.'
    });

    // on change check value and show popover
    $('input[name="tbl_warranty_claim_oct___soils_stains[]"]').change(function(){

        // convert the input to boolean
        var inputValue = parseBool(this.value);

        if (! inputValue)
        {
            soiledFree.popover('show');
            setTimeout(function() {
                soiledFree.popover('hide')
            }, 5000); // auto hide after 5 seconds
        }

        // if we have a popover go ahead and hide it
        if (inputValue)
        {
            soiledFree.popover('hide');
        }
    }); // soiledFree popover

    /* end soiledFree support */

    // law tag modal popup - markup found in default.php
    $('.fb_el_tbl_warranty_claim_oct___mattress_model_number label').append('<a id="lawtag">(located on label)</a>'); // add the link

    $('#lawtag').click(function(){
        $('#myModal').modal('show'); // display modal on click
    });
});

/*
* Useful function I found to turn a string into a boolean.
*
*
*/

var parseBool = function(str)
{
    // console.log(typeof str);
    // strict: JSON.parse(str)

    if(str == null)
        return false;

    if (typeof str === 'boolean')
    {
        if(str === true)
            return true;

        return false;
    }

    if(typeof str === 'string')
    {
        if(str == "")
            return false;

        str = str.replace(/^\s+|\s+$/g, '');
        if(str.toLowerCase() == 'true' || str.toLowerCase() == 'yes')
            return true;

        str = str.replace(/,/g, '.');
        str = str.replace(/^\s*\-\s*/g, '-');
    }

    // var isNum = string.match(/^[0-9]+$/) != null;
    // var isNum = /^\d+$/.test(str);
    if(!isNaN(str))
        return (parseFloat(str) != 0);

    return false;
}