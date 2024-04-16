$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('#sort-select').change(function() {
        var option = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/shop/sort',
            data: {price: option},
            success: function (response) {
                $('#product_list_container').html(response.html);
            }
        })
    });
});
