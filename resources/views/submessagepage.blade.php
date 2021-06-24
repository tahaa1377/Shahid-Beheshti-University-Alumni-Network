<?
  function contains($str,$search)
    {
        if (strpos($str, $search) !== false) {
           return true;
        }
        return false;
    }
?>

    <div class="main-msg-inner">

        <!-- Chat messages-->
    @foreach($messages as $message)
        <!-- Main message BODY RIGHT START -->
            <?if($message->messageFrom  == $_SESSION['user_id']){?>
            <div class="main-msg-body-right">
                <div class="main-msg">
                    <div class="msg-img">
                        <a href="#"><img src="img/<?=$message->profileImage?>"/></a>
                    </div>
                    <div class="msg">
                        <?if(!contains($message->message,'png')){?>
                        <?=$message->message?>
                   <? }else{?>
                        <img src="chatimg/<?=$message->message?>" style="width: 250px;height: 150px">
                        <? } ?>

                        <div class="msg-time">
                            <?=date('H:i',strtotime($message->messageOn))?>
                        </div>
                    </div>
                    <div class="msg-btn">
                        {{--<a><i class="fa fa-ban" aria-hidden="true"></i></a>--}}
                        {{--<a class="deleteMsg"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                    </div>
                </div>
            </div>
            <!--Main message BODY RIGHT END-->
        <?}else{?>
        <!--Main message BODY LEFT START-->
            <div class="main-msg-body-left">
                <div class="main-msg-l">
                    <div class="msg-img-l">
                        <a href="#"><img src="img/<?=$message->profileImage?>"/></a>
                    </div>
                    <div class="msg-l">
                        <?if(!contains($message->message,'png')){?>
                        <?=$message->message?>
                   <? }else{?>
                        <img src="chatimg/<?=$message->message?>" style="width: 250px;height: 150px">
                        <? } ?>
                        <div class="msg-time-l">
                            <?=date('H:i',strtotime($message->messageOn))?>
                        </div>
                    </div>
                    <div class="msg-btn-l">
                        {{--<a><i class="fa fa-ban" aria-hidden="true"></i></a>--}}
                        {{--<a class="deleteMsg"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                    </div>
                </div>
            </div>
            <!--Main message BODY LEFT END-->
        <?}?>
    @endforeach
    <!-- Chat  -->

    </div>
