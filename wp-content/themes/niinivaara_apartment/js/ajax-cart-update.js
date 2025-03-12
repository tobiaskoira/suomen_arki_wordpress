(function ($) {
    $(document).on('added_to_cart', function () {
        // Reload the mini cart in the sidebar
        $.ajax({
            url: ajaxCart.ajax_url,
            type: 'POST',
            data: {
                action: 'update_sidebar_cart',
            },
            success: function (response) {
                $('#sidebar-cart-contents').html(response); // Update the sidebar cart
            },
        });
    });
})(jQuery);
