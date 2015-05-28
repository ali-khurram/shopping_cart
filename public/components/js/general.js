var Shopping = Shopping || {};

(function($){

    Shopping.Cart = {
        init: function() {
            $('.addButton').click(function(){
                var qty = $(this).attr('data-quantity');
                if(qty === "0") {
                    alert("Sorry, item is out of stock");
                    return false;
                }
            });
            $('#cat-filter').change(function(){
               $('#filter').submit();
            });
        }
    }
})(jQuery);