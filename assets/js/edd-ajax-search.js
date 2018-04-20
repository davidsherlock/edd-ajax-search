(function($) {
    var cache = {};
    $(".edd-ajax-search-search").each(function() {
        $(this).autocomplete({
            delay: 250, // Delay between searches
            minLength: parseInt(edd_ajax_search.minimum_characters), // Minimum characters to start search
            source: function(request, response) {
                var form_serialized = $(this.element).closest('#edd-ajax-search-form').serialize();
                var autocomplete = $(this.element).closest('.edd-ajax-search-container').find('.edd-ajax-search-autocomplete');

                if( autocomplete.length ) {
                    autocomplete
                        .addClass('.edd-ajax-search-loading')
                        .html('<li><div class="edd-ajax-search-results-loader"><span class="edd-loading"></span></div></li>');
                }

                // Check local storage cache for search term to avoid re-running ajax request
                var term = request.term;
                if (term in cache) {
                    response(cache[term]);
                    return;
                }

                // Ajax request to edd_ajax_search action
                $.ajax({
                    url: edd_ajax_search.ajax_url + '?action=edd_ajax_search&nonce=' + edd_ajax_search.nonce,
                    type: 'GET',
                    dataType: 'json',
                    data: form_serialized,
                    error: function() {
                        response();
                    },
                    success: function(data) {
                        cache[term] = data;
                        response(data);
                    }
                });
            },
            select: function(event, ui){
                // If selected item has a link attr, then navigate to this url
                if(ui.item.link !== undefined) {
                    window.location.href = ui.item.link;
                }
            }
        }).autocomplete( 'instance' )._renderItem = function( ul, item ) {
            // Autocomplete class
            $(ul)
                .addClass('edd-ajax-search-autocomplete')
                .addClass('edd-ajax-search-open');

            // Append the item html inside a li under ul element
            return $("<li>")
                .append(item.html)
                .appendTo(ul);
        };
    });

    // Close autocomplete when user focus out
    $('.edd-ajax-search-container').on('focusout', function(e) {
        var $this = $(this);

        setTimeout(function() {
            if( ! $(document.activeElement).closest('.edd-ajax-search-container').length ) {
                $this.find('.edd-ajax-search-autocomplete').removeClass('edd-ajax-search-open');
            }
        }, 100);
    });

    // Re-execute search on browser window resize
    $(window).resize(function() {
        $(".edd-ajax-search-search").autocomplete("search");
    });

    // jQuery autocomplete prototype min-width tweak
    jQuery.ui.autocomplete.prototype._resizeMenu = function() {
        var ul = this.menu.element;
        ul.outerWidth(this.element.outerWidth());
    }

    // When categories dropdown change triggers again the search
    $('.edd-ajax-search-categories').change(function() {
        $(this).closest('#edd-ajax-search-form').find('#edd-ajax-search-search').autocomplete( 'search' );
    });
})(jQuery);
