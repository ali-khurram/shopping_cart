var Shopping = Shopping || {};

(function($){

    Shopping.Cart = {
        init: function() {
            var _this = this;
            $('.addButton').click(function(){
                var qty = $(this).data('quantity');
                if(qty === 0) {
                    _this.loadPopup("Sorry, this item is currently out of stock");
                    return false;
                }
            });
            // To hide the modal window
            $(document).on('click', 'a.close', function() {
                _this.hidePopUp();
                return false;
            });
            $('#cat-filter').change(function(){
               $('#filter').submit();
            });
        },
        // Load modal window
        loadPopup: function(message) {
            var _this = this;
            if (message) {
                message = '<div class="message">'+
                    '<a href="#close" title="Close" class="close">X</a>' +
                    '<h2>Error Message</h2>' +
                    '<p>' + message + '</p>' +
                    '</div>';
                _this.showPopup($(message));
            }
        },
        // Hide pop-up
        hidePopUp: function() {
            $('#popup-container').fadeOut(400, function() {
                $('#overlay').fadeOut(400, function() {
                    $('#overlay, #popup-container').remove();
                });
            });
        },
        // Show popup
        showPopup: function(data) {
            $('body').append('<div id="overlay"></div><div id="popup-container" class="modal modal-msg"></div>');
            $('#popup-container').html(data);
            // Position box
            var fromTop = (($(window).height() - $('#popup-container.modal').height()) / 2) - 50;
            if (fromTop < 0) fromTop = 10;

            //Removed: $('#popup-container.modal').css('top', fromTop + $(window).scrollTop() + 'px');
            $('#popup-container.modal').css("top", 50);
            $(window).scrollTop(0);

            $('#overlay').fadeIn(400, function() {
                $('#popup-container').fadeIn(400);
            });
        }
    }
})(jQuery);