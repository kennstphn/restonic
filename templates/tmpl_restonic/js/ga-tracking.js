// ga tracking links
jQuery(document).ready(function($){
    $('.ga').on('click', function(){

        var event = $(this).attr('data-analytics-event');
        var category = $(this).attr('data-analytics-category');
        var action = $(this).attr('data-analytics-action');
        var label = $(this).attr('data-analytics-alias');
        // log the event to ga

        window.ga_debug = {trace: true};

        ga('send', 'event', category, action, label);
    })
});