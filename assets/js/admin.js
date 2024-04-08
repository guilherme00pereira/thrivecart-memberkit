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
            alert('Ingrese el ID del producto y el ID del grupo.');
            $('#loading-integrate').removeClass('is-active');
        } else if (alreadyIntegrated(pid, cid) === true) {
            alert('Este producto y grupo ya están integrados.');
            $('#loading-integrate').removeClass('is-active');
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
                        window.location.reload()
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
                obj.ajax_url,
                {
                    action: obj.action_remove_integration,
                    nonce: obj.nonce,
                    product_id: pid,
                    classroom_id: cid
                },
                function (res) {
                    if (res.success) {
                        window.location.reload()
                    } else {
                        tcmkErrorMessage(res.data.message);
                    }
                }, 'json'
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
                    $('#settings-message-container').html(tcmkSuccessMessage('La configuración ha sido guardada.'));
                } else {
                    $('#settings-message-container').html(tcmkErrorMessage(res.data.message));
                }
                $('#loading-settings').removeClass('is-active');
            }, 'json');
    });

    function alreadyIntegrated(pid, cid) {
        let r = false;
        $('.integration-row').each(function () {
            const code = pid.toString() + cid.toString();
            if ($(this).data('set') == code) {
                r = true;
            }
        });
        return r;
    }

})(jQuery);

function tcmkErrorMessage(message) {
    return `<div class="notice notice-error is-dismissible"><p>${message}</p></div>`;
}

function tcmkSuccessMessage(message) {
    return `<div class="notice notice-success is-dismissible"><p>${message}</p></div>`;
}