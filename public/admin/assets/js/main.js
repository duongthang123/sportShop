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



