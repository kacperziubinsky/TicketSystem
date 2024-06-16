function addToCart(product, quantityId, price) {
    const quantity = document.getElementById(quantityId).value;
    fetch('addCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'product': product,
            'quantity': quantity,
            'price': price
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
        } else {
            alert('Błąd: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Wystąpił błąd podczas dodawania produktu do koszyka');
    });
}