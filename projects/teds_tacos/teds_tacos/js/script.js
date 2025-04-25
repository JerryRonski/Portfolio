$(function() {
    $('.addToCart').click(function() {
        $id = $(this).siblings('input[name="id"]').val();
        $qtyStr = $(this).siblings('input[name="qty"]').val();
        $qty = parseInt($qtyStr);

        $.ajax({
            url: 'includes/cart_functions.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: $id,
                qty: $qty
            },
            success: function(response) {
                if (response.success) {
                    console.log('Cart updated:', response.cart);
                } else {
                    alert('Error: ' + response.message);
                }
                window.location.reload();
            },
            error: function(xhr, status, err) {
                console.group('AJAX Error Details');
                console.error('Error message:', err);
                console.log('Status:', status);
                console.log('Raw responseText:', xhr.responseText);
                console.groupEnd();
            }
        });

    });

    $('.removeFromCart').click(function() {
        $id = $(this).siblings('input[name="id"]').val();
        $qty = -1;

        $.ajax({
            url: 'includes/cart_functions.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: $id,
                qty: $qty
            },
            success: function(response) {
                if (response.success) {
                    console.log('Cart updated:', response.cart);
                } else {
                    alert('Error: ' + response.message);
                }
                window.location.reload();
            },
            error: function(xhr, status, err) {
                console.group('AJAX Error Details');
                console.error('Error message:', err);
                console.log('Status:', status);
                console.log('Raw responseText:', xhr.responseText);
                console.groupEnd();
            }
        });

    });
});