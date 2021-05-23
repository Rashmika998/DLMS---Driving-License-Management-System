$('document').ready(function () {
          
    $('#google_translate_element').on("click", function () {

        // Change font family and color
        $("iframe").contents().find(".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div") //, .goog-te-menu2 *
        .css({
            'color': '#544F4B',
            'background-color': 'inherit',
            'font-family': 'sans-serif'
        });

        // Change Google's default blue border
        $("iframe").contents().find('.goog-te-menu2').css('border', '1px solid #17548d');

        $("iframe").contents().find('.goog-te-menu2').css('background-color', '#e3e3ff');

        // Change the iframe's box shadow
        $(".goog-te-menu-frame").css({
            '-moz-box-shadow': '0 3px 8px 2px #666666',
            '-webkit-box-shadow': '0 3px 8px 2px #666',
            'box-shadow': '0 3px 8px 2px #666'
        });
    });
});