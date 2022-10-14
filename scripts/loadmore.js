;
(function($) {
    $(document).on('click', '.load-more:not(.loading)', function(e) {
        e.preventDefault()

        var that = $(this)
        var page = that.data('page')
        var newPage = page + 1
        var ajaxurl = that.data('url')

        that.addClass('loading').find('.text').slideUp(640)
        that.find('.loading-icon').addClass('spin')

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: { page: page, action: 'load_more' },
            error: function(response) {
                console.log(response)
            },
            success: function(response) {
                if (response == 0) {
                    that.slideUp(640)
                } else {
                    that.data('page', newPage)
                    $('.dropdown-filter-list main').append(response)

                    setTimeout(function() {
                        that.removeClass('loading').find('.text').slideDown(320)
                        that.find('.loading-icon').removeClass('spin')
                    }, 1000)
                }
            },
        })
    })
})(jQuery)