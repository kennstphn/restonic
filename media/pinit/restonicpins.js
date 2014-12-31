jQuery(document).ready(function($) {

    var blog = $('.itemFullText img');

    var mattresses = $('.mattress-item-image img');

    addPinit(blog);
    addPinit(mattresses);
    buildImageShareToolbar(blog);

    function addPinit(selector) {

        selector.each(function () {
            // get the image float
            var float = $(this).css("float");

            // determine our position
            var position = getPosition(float);

            // wrap the image in a div so we can float it
            $(this).wrap('<div class="' + position + '"></div>');

            // get root path
            if (!window.location.origin)
                window.location.origin = window.location.protocol + "//" + window.location.host;

            // get pin media info
            var pinurl      = encodeURIComponent(_pinurl); // we get the global
            var pinmedia    = encodeURIComponent(window.location.origin + $(this).attr('src')); // we get this from global
            var alt         = encodeURIComponent($(this).attr('alt'));

            // build the final share markup
            var shareMarkup = '<div class="pinit-btn">';

            // get the pin markup
            shareMarkup += buildPinitButton(pinurl, pinmedia, alt);

            // close link
            shareMarkup += '</div>';

            // prepend before the image
            $(this).before(shareMarkup);

        }); // end each

        // execute pinit after we're done with our markup
        (function (d) {
            var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
            p.type = 'text/javascript';
            p.async = true;
            p.src = '//assets.pinterest.com/js/pinit.js';
            f.parentNode.insertBefore(p, f);
        }(document));
    } // end addpinit

    /*
     * Float our image container div as needed. Gets this from the image style.
     */

    function getPosition(float)
    {
        var position = 'share-img-';

        // determine our float for the container div
        if (float == 'left' || float == 'right') {
            // if our position is right or left add it
            position += float;
        }
        else {
            // no position specified so default to none
            position += 'none';
        }

        return position;
    }

    function buildImageShareToolbar(selector)
    {
        // var pinit = buildPinitButton(link, image, description);
        selector.each(function () {
            console.log(selector);
        });

        //return '<div class="image-share-toolbar"></div>';
    }

    /*
     * Create a pinterest share button markup.
     */
    function buildPinitButton(link, image, description)
    {
        var pinitMarkup = '<a href="//www.pinterest.com/pin/create/button/?';

        // add url params
        pinitMarkup += 'url=' + link;
        pinitMarkup += '&media=' + image;
        pinitMarkup += '&description=' + description;

        pinitMarkup += '"'; // close href

        // additional href options
        pinitMarkup += 'data-pin-do="buttonPin" data-pin-config="none">';

        // insert image
        pinitMarkup += '<img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" />';

        // close link
        pinitMarkup += '</a>';

        return pinitMarkup;
    }
});