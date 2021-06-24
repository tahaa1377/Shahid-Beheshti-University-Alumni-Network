<?
use Illuminate\Support\Facades\DB;

function message_counter($id){

       $tt=DB::table('messages')->where('status',0)->where('messageTo',$_SESSION['user_id'])
           ->where('messageFrom',$id)->count('message_id');

       return $tt;
    }
?>

<div class="popup-message-wrap">
    <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
    <div class="wrap2">
        <div class="message-send">
            <div class="message-header">
                <div class="message-h-left">
                    <label for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
                </div>
                <div class="message-h-cen">
                    <h4>پیام جدید</h4>
                </div>
                <div class="message-h-right">
                    <label for="popup-message-tweet" ><i class="fa fa-times" aria-hidden="true"></i></label>
                </div>
            </div>
            <div class="message-input">
                <h5 style="direction: rtl">ارسال پیام به :</h5>
                <input type="text" placeholder="جست و جوی دانش آموختگان" class="search-user"/>
                <ul class="search-result down">

                </ul>
            </div>
            <div class="message-body" id="new_message_list">
                <h4>اخیر</h4>
                <div class="message-recent">
                    <?foreach ($messages as $message){?>
                    <div class="people-message" data-userid="<?=$message->user_id?>">
                        <div class="people-inner">
                            <div class="people-img">
                                <img src="img/<?=$message->profileImage?>"/>
                            </div>
                            <div class="name-right2">
                                <span><a href="#"><?=$message->name?></a></span><span>@<?=$message->username?></span>
                            </div>

                            <span></span>
                        </div>
                    </div>
                        <?}?>
                </div>
            </div>
            <!--message FOOTER-->
            <div class="message-footer">
                <div class="ms-fo-right">
                    <label>Next</label>
                </div>
            </div><!-- message FOOTER END-->
        </div><!-- MESSGAE send ENDS-->


        <input id="mass" type="checkbox" checked="unchecked" />
        <div class="back">
            <div class="back-header">
                <div class="back-left">
                    صندوق پیام
                </div>
                <div class="back-right" >
                    <label for="mass" style="font-weight: bold" class="new-message-btn">ارسال پیام جدید</label>
                    <label for="popup-message-tweet"><i class="fa fa-times" aria-hidden="true"></i></label>
                </div>

            </div>



            <div class="back-inner" style="width: 100%">
                <div class="back-body" >
                    <!--Direct Messages-->

                    <?foreach ($messages as $message){?>
                    <div class="people-message" data-userid="<?=$message->user_id?>">
                        <div class="people-inner">
                            <div class="people-img">
                                <img src="img/<?=$message->profileImage?>"/>
                            </div>
                            <div class="name-right2">
                                <span><a href="#"><?=$message->name?></a></span><span>@<?=$message->username?></span>
                            </div>
                            <br>
                           <? if(message_counter($message->user_id) != 0){ ?>
                            <div class="msg-box" style="position: absolute;right: 20px">
                                <span class="span-i" style="color: white;position: absolute;right:
                                 20px;font-size: 90%"><?=message_counter($message->user_id)?></span>
                            </div>
                            <?}?>



                        </div>
                    </div>
                    <?}?>
                    <!--Direct Messages-->
                </div>
            </div>
            <div class="back-footer">

            </div>
        </div>
    </div>
</div>
<!-- POPUP MESSAGES END HERE -->


<script>
    $(function () {
        //$('.message-recent').html("a");
        $(document).on('keyup','.search-user',function () {

            let search=$(this).val();

            if (search.length>0){

                $.ajax('/chatsearchUser', {
                    type: 'post',

                    data:{
                        search:search
                    },
                    success: function (data) {

                        $('.message-recent').html(data);
                    }
                })

            }else {
                $('.message-recent').html("");
            }

        });

    });
</script>