/**
 * Created by thanh on 4/27/2018.
 */
jQuery(document).ready(function () {
    registerDownload();
    closeModal();

    function registerDownload() {

        jQuery('#register_download').submit(function (e) {
            e.preventDefault();
            jQuery('#notice-download').html('');
            jQuery('#notice-download').html('<div class="text-center" style="margin: 5px 0 10px 0;"><div class="loader" align="center"></div></div>');
            console.log(jQuery('#register_download').serialize());
            jQuery.ajax({
                type: jQuery('#register_download').attr('method'),
                url: jQuery('#register_download').attr('action'),
                data: jQuery('#register_download').serialize(),
                success: function (response) {
                    if(response.null){
                        jQuery('#notice-download').html('<b>Yêu cầu của bạn đã dược gửi đi. Hãy đợi được cấp phép để có thể tải tài liệu về.</b>')
                        jQuery('#notice-permission').css('display','none');
                    }
                    else{
                        console.log(response.error);
                        jQuery('#notice-download').html('<div class="alert-danger" style="margin: 5px 0 10px 0;"><p><strong>'+response.error+'</strong></p></div>');
                    }
                },
                error: function (data) {
                    console.log(data);
                    // jQuery('#notice-download').html('<div class="alert-danger" style="margin: 5px 0 10px 0;"><p><strong>Số điện thoại hoặc email không dược để trống</strong></p></div>');
                }
            });

        });
    }

    function closeModal(){
        jQuery('.btn-close').click(function () {
            jQuery('#notice-download').html('');
            jQuery('.phone-number-form').val('');
            jQuery('.email-form').val('');
            jQuery('.description-form').val('');
        });
    }
});