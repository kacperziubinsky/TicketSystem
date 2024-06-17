$(document).ready(function() {
    $('.delete-btn').click(function() {
        const index = $(this).data('index');
        $.ajax({
            url: 'deleteCart.php',
            method: 'POST',
            data: { index: index },
            success: function(data) {
                if (data.status === 'success') {
                    showAlert('success', data.message)
                    setTimeout(function(){
                        location.reload();
                    }, 2000)
                } else {
                    alert('Błąd: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Wystąpił błąd podczas usuwania produktu z koszyka');
            }
        });
    });

    $('.cart-items').on('input', 'input[id^="quantity-"]', function() {
        const index = $(this).closest('.cart-item').data('index');
        const quantity = $(this).val();
        $.ajax({
            url: 'changeCart.php',
            method: 'POST',
            data: {
                index: index,
                quantity: quantity
            },
            success: function(data) {
                if (data.status === 'success') {
                    showAlert('success', data.message)
                    setTimeout(function(){
                        location.reload();
                    }, 2000)
                } else {
                    alert('Błąd: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Wystąpił błąd podczas aktualizacji ilości produktu');
            }
        });
    });
});