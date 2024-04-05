(function ($) {
    $(document).ready(function () {
        $('#tcmk-tabs').tabs();
    });

    $('#btn-integrate').click(function () {
        $('#loading-integrate').addClass('is-active');
        const pid = $('#product_id').val();
        const cid = $('#classroom_id').val();
        const pname = $('#product_id option:selected').text();
        const cname = $('#classroom_id option:selected').text();
        if (pid === '' || cid === '') {
            alert('Please enter both Product ID and Classroom ID');
        } else {
            const params = {
                action: obj.action_save_integration,
                nonce: obj.nonce,
                product_id: pid,
                classroom_id: cid,
                product_name: pname,
                classroom_name: cname
            };
            $.post(
                obj.ajax_url,
                params,
                function (res) {
                    if (res.success) {
                        console.log('Integration successful');
                    } else {
                        console.log(res.data.message);
                    }
                    $('#loading-integrate').removeClass('is-active');
                }, 'json');
        }
    });

    $('.btn-remove-integration').click(function (){
        if( confirm('Tem certeza?') ) {
            const pid = $(this).data('product')
            const cid = $(this).data('classroom')
            $.post(

            )
        }
    })

    $('#btn-settings').click(function () {
        $('#loading-settings').addClass('is-active');
        const params = {
            action: obj.action_save_settings,
            nonce: obj.nonce,
            thrivecart_api_key: $('#thrivecart_api_key').val(),
            memberkit_api_key: $('#memberkit_api_key').val(),
            memberkit_api_url: $('#memberkit_api_url').val(),
        };
        $.post(
            obj.ajax_url,
            params,
            function (res) {
                if (res.success) {
                    console.log('Settings saved');
                } else {
                    console.log(res.data.message);
                }
                $('#loading-settings').removeClass('is-active');
            }, 'json');
    });

})(jQuery);
