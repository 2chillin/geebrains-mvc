$(document).ready(function () {
      $('.order-status').change(function () {
        var status = $(this).val();
        var id = $(this).find('#select-order-id').val();
        $.ajax({
            type: "POST",
            url: "./?path=orders/statusChange",
            data: "id="+id+"&status="+status,
            success: function () {
                var message = $('#messages-'+id);
                message.text('статус изменен');
                setTimeout(hideAll, 2000);
                function hideAll() {
                    message.hide();
                    message.text('');
                    message.css('display', 'block');
                }

            }
       })
    });
});