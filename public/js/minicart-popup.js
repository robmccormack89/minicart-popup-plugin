jQuery(function($) {
  // add to cart button triggers modal when item is added to cart
	$(document).on('added_to_cart', function(e, fragments, cart_hash, this_button) {
		var modal = UIkit.modal("#MiniCartModal");
		modal.show();
	});
});