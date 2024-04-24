$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(url)
{
    if(confirm('Bạn có chắc chắn muốn xóa không ?')) {
        $.ajax({
            type: "DELETE",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'JSON',
            success: function (result) {
                if(result.error === false) {
                    // alert(result.message);
                    location.reload();
                } else {
                    alert('Có lỗi khi xóa !')
                }
            }
        })
    }
}

$(document).ready(function () {
    $('.select_status').change(function () {
        var url = $(this).data("action");
        var orderId = $(this).data("order-id");
        var status = $(this).val();


        if(confirm('Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng!')) {
            $.ajax({
                type: 'PUT',
                url: url,
                data: {
                    id: orderId,
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if(result.error === false) {
                        location.reload();
                    }
                }
            })
        }
    })
});



