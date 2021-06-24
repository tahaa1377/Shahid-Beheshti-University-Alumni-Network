$(function () {

    $(document).on('click','#notifi',function () {


        
        $.ajax('/notificationU', {
            type: 'post',
            success: function (data) {
                $('#notification_result').show('fast');
                $('#notification_result').html(data);
                $('#counternotification').hide();

                $('.close-retweet-popup').click(function () {
                    $('#notification_result').hide('fast');
                });
                $('.cancel-it').click(function () {
                    $('#notification_result').hide('fast');
                });



            }
        });


    });




});