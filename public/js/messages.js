$(function () {
    $(document).on('click','#messagei',function () {

        $.ajax('/messagesU', {
            type: 'post',
            success: function (data) {
                $('#notification_result').show('slow');
                $('#notification_result').html(data);
            }
        });

    });


    $(document).on('click','.people-message',function (e) {

        $userid=$(this).data("userid");

        $.ajax('/messagesPage', {
            type: 'post',
            data:{
                userid:$userid
            },
            success: function (data) {
                //$('#notification_result').show('slow');
                $('#notification_result').html(data);


                if (autoscroll){
                    scrolldwon();
                }
                $('.main-msg-inner').on('scroll',function () {

                    if ($(this).scrollTop()<this.scrollHeight-$(this).height()) {
                        autoscroll=false;
                    }else {
                        autoscroll=true;
                    }
                });


            }
        });

        $timer=setInterval(getmessages,2000);
        //getmessages(e)
    });





    getmessages=function (e) {



        $.ajax('/submessagesPage', {
            type: 'post',
            data:{
                userid:$userid
            },
            success: function (data) {


                //$('#notification_result').show('slow');
                $('.main-msg-wrap').html(data);

                if (autoscroll){
                    scrolldwon();
                }
                $('.main-msg-inner').on('scroll',function () {

                    if ($(this).scrollTop()<this.scrollHeight-$(this).height()) {
                        autoscroll=false;
                    }else {
                        autoscroll=true;
                    }
                });




            }
        });
        autoscroll=true;
        scrolldwon=function(){
            $('.main-msg-inner').scrollTop($('.main-msg-inner')[0].scrollHeight);
        };
    };
    autoscroll=true;
    scrolldwon=function(){
        $('.main-msg-inner').scrollTop($('.main-msg-inner')[0].scrollHeight);
    };
    //getmessages();





    $(document).on('click','.fa-times',function () {


        clearInterval($timer);

    });

    $(document).on('click','.fa-angle-left',function () {

        clearInterval($timer);

        $.ajax('/messagesU', {
            type: 'post',
            success: function (data) {
                $('#notification_result').show('slow');
                $('#notification_result').html(data);
            }
        });


    });




    $(document).on('submit','#messageForm',function (e) {

        e.preventDefault();
        var form=new FormData ($(this)[0]);
        form.append('file', $('#file')[0].files[0]);

        // console.log($('#file')[0]);
        // console.log(form);

        $.ajax('/sendMsg', {
                type: 'post',
                data: form,
                success: function (data) {

                   // alert(data);
                    getmessages();
                    $('#text').val("");
                    $('#file').val(null);

                },
                cache:false,
                contentType:false,
                processData:false
            }
        );


        ///////////////////in vase inke har vaght ok zad scroll bechasbe be akhar
        autoscroll=true;
        scrolldwon=function(){
            $('.main-msg-inner').scrollTop($('.main-msg-inner')[0].scrollHeight);
        };
/////////////////////////////////

    });


    $('#text').keypress(function (e) {
        if (e.which == 13) {

            $('#messageForm').submit();
            e.preventDefault();
            var form=new FormData ($(this)[0]);
            form.append('file', $('#file')[0].files[0]);

            // console.log($('#file')[0]);
            // console.log(form);

            $.ajax('/sendMsg_U', {
                    type: 'post',
                    data: form,
                    success: function () {
                        getmessages();
                        $('#text').val("");
                        $('#file').val(null);

                    },
                    cache:false,
                    contentType:false,
                    processData:false
                }
            );


            ///////////////////in vase inke har vaght ok zad scroll bechasbe be akhar
            autoscroll=true;
            scrolldwon=function(){
                $('.main-msg-inner').scrollTop($('.main-msg-inner')[0].scrollHeight);
            };
/////////////////////////////////

        }
    });







});