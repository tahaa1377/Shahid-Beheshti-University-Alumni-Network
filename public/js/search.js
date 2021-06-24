$(function () {

    $(document).on('click','.wrapper',function () {

        $('.search-result').html("");
        $('.search').val("");

    });

    $(document).on('keyup','.search',function () {

        let search=$(this).val();

        if (search.length>0){

            $.ajax('/searchUser', {
                type: 'post',

                data:{
                    search:search
                },
                success: function (data) {

                        $('.search-result').html(data);
                }
            })

        }else {
            $('.search-result').html("");
        }

      
    });



});