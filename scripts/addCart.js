function addToCart(product, quantityId, price) {
    const quantity = $(`#${quantityId}`).val();
    $.ajax({
        url: 'addCart.php',
        method: 'POST',
        data: {
            product: product,
            quantity: quantity,
            price: price
        },
        success: function(data) {
            if (data.status === 'success') {
                showAlert('success', data.message)

            } else {
                alert('Błąd: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Wystąpił błąd podczas dodawania produktu do koszyka');
        }
    });
}
