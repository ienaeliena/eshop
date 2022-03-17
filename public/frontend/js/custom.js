$(document).ready(function () {

    loadCart();
    loadWishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadCart(){
        $.ajax({
            method: "GET",
            url:"/load-cart-data",
            success: function (response) {
                // $('.cart-count').html('');
                $('.cart-count').html(response.count);
                // console.log(response.count)
            }
        });
    }

    function loadWishlist(){
        $.ajax({
            method: "GET",
            url:"/load-wishlist-data",
            success: function (response) {
                // $('.cart-count').html('');
                $('.wishlist-count').html(response.count);
                // console.log(response.count)
            }
        });
    }

    // $('.addToCartBtn').click(function (e) {  iena remove
    $(document).on('click','.addToCartBtn', function (e){
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();


        $.ajax({
            type: "POST",
            url: "/add-to-cart",
            data: {
                'product_id' : product_id,
                'product_qty' : product_qty
           },
           success: function (response) {
               loadCart();
               loadWishlist();//iena baru add
               $('.wishlistItems').load(location.href + " .wishlistItems");//iena baru add
               swal(response.status);

            }
        })

    });

    $('.addToWishlist').click(function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id' : product_id,
           },
           success: function (response) {
               swal(response.status);
               loadWishlist();

            }
        })

    });


    $(document).on('click','.increment-btn', function (e){
        e.preventDefault();

        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value,10);
        value = isNaN(value) ? 0 : value;
        if(value < 10){
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $(document).on('click','.decrement-btn', function (e){
        e.preventDefault();

        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value,10);
        value = isNaN(value) ? 0 : value;
        if(value > 1){
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    // import$('.delete-cart-item').click(function (e){
    $(document).on('click','.delete-cart-item', function (e){
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();


        $.ajax({
            method: 'POST',
            url: 'delete-cart-item',
            data: {
                'prod_id' : prod_id,
            },
            success: function (response) {
               //indow.location.reload();
               loadCart();
               $('.cartItems').load(location.href + " .cartItems");
                swal("", response.status,"success");
            }
        });
    });

   // $('.remove-wishlist-item').click(function (e){
    $(document).on('click','.remove-wishlist-item', function (e){
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();


        $.ajax({
            method: 'POST',
            url: 'delete-wishlist-item',
            data: {
                'prod_id' : prod_id,
            },
            success: function (response) {
               // window.location.reload();
               loadWishlist();
               $('.wishlistItems').load(location.href + " .wishlistItems");
                swal("", response.status,"success");
            }
        });
    });

    $(document).on('click','.changeQuantity', function (e){
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty =  $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'prod_id' : prod_id,
            'prod_qty' : qty,
        }

        $.ajax({
            method: 'POST',
            url: 'update-cart',
            data: data,
            success: function (response) {
                $('.cartItems').load(location.href + " .cartItems");
                //$('.wishlistItems').load(location.href + " .wishlistItems");

            }
        });

    });


});
