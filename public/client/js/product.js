$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//sort product by price
$(document).ready(function() {
    $('#sort-select').change(function() {
        var option = $(this).val();
        var request = window.location.href;

        var regex = /\/shop\/(\d+)\/category/;
        var match = request.match(regex);

        if(match && match.length > 1) {
            var number = parseInt(match[1]);
            $.ajax({
                type: 'GET',
                url: '/shop/sort',
                data: {price: option, category_id: number},
                success: function (response) {
                    $('#product_list_container').html(response.html);
                }
            })
        } else {
            $.ajax({
                type: 'GET',
                url: '/shop/sort',
                data: {price: option},
                success: function (response) {
                    $('#product_list_container').html(response.html);
                }
            })
        }

    });
});

//filter product by price
$(document).ready(function () {
   $('.filter-by-price').on('click', function (e) {
       e.preventDefault();
       var priceRange = $(this).data('price-range');
       var request = window.location.href;

       var regex = /\/shop\/(\d+)\/category/;
       var match = request.match(regex);

       if(match && match.length > 1) {
           var number = parseInt(match[1]);
           $.ajax({
               type: 'GET',
               url: '/shop/filter-product',
               data: {price_range: priceRange, category_id: number},
               success: function (response) {
                   $('#product_list_container').html(response.html);
               }
           })
       } else {
           $.ajax({
               type: 'GET',
               url: '/shop/filter-product',
               data: {price_range: priceRange},
               success: function (response) {
                   $('#product_list_container').html(response.html);
               }
           })
       }

   })
});

//Update Quantity Cart Product
$(document).ready(function () {
    $('.qtybtn').click(function () {
        var input = $(this).siblings('input.product-quantity-input');
        var oldValue = parseInt(input.val());
        var isIncrement = $(this).hasClass('inc');
        var newValue = isIncrement ? oldValue + 1 : Math.max(0, oldValue - 1);

        input.val(newValue);
        updateCart(input);
    });

    $('.product-quantity-input').change('input', function () {
       updateCart($(this));
    });

    function updateCart(input) {
        var quantity = parseInt(input.val());
        var productId = input.data('product-id');
        var productSize = input.data('product-size');
        var productColor = input.data('product-color');
        var cartId = input.data('cart-id');

        $.ajax({
            type: 'POST',
            url: '/cart/update-cart',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product_id: productId,
                size: productSize,
                color: productColor,
                quantity: quantity
            },
            success: function (result) {
                if(result.error === false) {
                    location.reload()
                }else {
                    location.reload()
                }
            }
        })


    }
});

// Delete Product In Cart
$(document).ready(function () {
   $('.delete-btn-cart').click(function () {
       var product_id = $(this).data('product-id');
       var product_size = $(this).data('product-size');
       var product_color = $(this).data('product-color');

       $.ajax({
           type: 'DELETE',
           url: '/cart/delete-cart/'+ product_id,
           data: {
              product_id: product_id,
               size: product_size,
               color: product_color
           },
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (result) {
               if(result.error === false) {
                   location.reload()
               }else {
                   location.reload()
               }
           }
       });
   })
});
