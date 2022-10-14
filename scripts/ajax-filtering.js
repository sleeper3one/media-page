;
(function($) {
    $(document).ready(function() {
        $(document).on('click', '.js-filter-item > a', function(e) {
            e.preventDefault()

            var category = $(this).attr('href')

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: { action: 'filter', category: category },
                dataType: 'html',
                type: 'POST',
                success: function(result) {
                    $('.js-filter main').html(result)
                },
                error: function(result) {
                    console.warn(result)
                },
            })
        })
    })
})(jQuery)