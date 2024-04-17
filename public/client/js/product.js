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
