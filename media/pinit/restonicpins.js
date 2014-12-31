jQuery(document).ready(function($){
    $('.itemFullText img').each(function(){

        var position = 'share-img-';

        var float = $(this).css("float");

        // determine our float for the container div
        if (float == 'left' || float == 'right')
        {
            // if our position is right or left add it
            position += float;
        }
        else
        {
            // no position specified so default to none
            position += 'none';
        }

        // wrap the image in a div so we can float it
        $(this).wrap('<div class="' + position + '"></div>');

        // get root path
        if (!window.location.origin)
            window.location.origin = window.location.protocol+"//"+window.location.host;

        var pinurl   = encodeURIComponent(_pinurl); // we get the global
        var pinmedia = encodeURIComponent(window.location.origin + $(this).attr('src')); // we get this from global
        var alt      = encodeURIComponent($(this).attr('alt'));


        var shareMarkup = '<div class="pinit-btn"><a href="//www.pinterest.com/pin/create/button/?';

        // add url params
        shareMarkup += 'url='         + pinurl;
        shareMarkup += '&media='       + pinmedia;
        shareMarkup += '&description=' + alt;

        shareMarkup += '"'; // close href

        // additional href options
        shareMarkup += 'data-pin-do="buttonPin" data-pin-config="none">';

            // insert image
            shareMarkup += '<img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" />';

        // close link
        shareMarkup += '</a></div>';
        console.log(shareMarkup);

        // prepend before the image
        //$(this).before('<div class="share-image">');
        $(this).before(shareMarkup);

    });

    // execute pinit after we're done with our markup
    (function(d){
        var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
        p.type = 'text/javascript';
        p.async = true;
        p.src = '//assets.pinterest.com/js/pinit.js';
        f.parentNode.insertBefore(p, f);
    }(document));
});