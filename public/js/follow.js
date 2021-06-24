
$(function () {

    $(document).on('click','.follow-btn',function () {



        var id=$(this).data('follow');

        $button = $(this);

        if ($button.hasClass('following-btn')){

            $button.removeClass('following-btn');
            $button.removeClass('unfollow-btn');
            $button.html('<i class="fa fa-user-plus"></i>دنبال کنید');

            $('.count-following').text( parseInt($('.count-following').text()) - 1 );


            $.ajax('/unfollow_it', {
                    type: 'post',
                    data: {
                        unfollow: id
                    }
                }
            );

        } else {


            $button.removeClass('follow-btn');
            $button.addClass('following-btn');
            $button.text('در حال دنبال کردن');

            $('.count-following').text( parseInt($('.count-following').text()) + 1 );


            $.ajax('/follow_it', {
                    type: 'post',
                    data: {
                        follow: id
                    }
                }
            );
        }


    });

    $('.follow-btn').hover(function () {

        if ($(this).hasClass('following-btn')){

            $(this).text('دنبال نکردن');
            $(this).addClass('unfollow-btn');
        }


    },function () {

        if ($(this).hasClass('following-btn')){
            $(this).removeClass('unfollow-btn');
            $(this).text('در حال دنبال کردن');
        }
    });

});