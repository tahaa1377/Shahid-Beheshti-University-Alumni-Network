$(function () {
    $(document).on('click','.mytweet',function () {

        let tweet_id = $(this).data('id');

        $.ajax('/delete_tweet_id', {
                type: 'post',
                data: {
                    tweet_id: tweet_id
                }, success: function () {

               location.reload();
            }
            }
        );

    });

});