var currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
var priceElement = document.querySelector('.price');

// Convert text content to a number
var price = parseFloat(priceElement.textContent);

// Format the number
priceElement.textContent = '₱' + price.toLocaleString();

document.querySelectorAll('.minus-cart, .plus-cart').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        console.log('Button clicked:', this.classList.contains('minus-cart') ? 'Minus' : 'Plus');

        var itemId = this.getAttribute('data-product-id');
        var cartId = this.getAttribute('data-cart-id');
        var isMinusAction = this.classList.contains('minus-cart');

        // Send an AJAX request to update the quantity
        sendAjaxRequest(itemId, isMinusAction, cartId);
    });
});

// Function to send the AJAX request
function sendAjaxRequest(itemId, isMinusAction, cartId) {
    // Create an AJAX request using Axios
    axios({
        method: 'post',
        url: isMinusAction ? '/minus-cart/' + itemId + '/' + cartId : '/plus-cart/' + itemId + '/' + cartId,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(function(response) {
        // Update the quantity display
        var quantityElement = document.querySelector(`[data-product-id="${itemId}"] + p`);
        quantityElement.textContent = response.data.quantity;

        priceElement.textContent = ('₱' + response.data.price.toLocaleString());

        // Restore the scroll position after the AJAX request is completed
        window.scrollTo(0, currentScrollPosition);
    })
    .catch(function(error) {
        console.error(error);
    });
}

