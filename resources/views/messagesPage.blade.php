<?
function contains($str,$search)
{
    if (strpos($str, $search) !== false) {
        return true;
    }
    return false;
}
?>

<div class="popup-message-wrap">
    <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
    <div>
        <input id="mass" type="checkbox" checked="unchecked" />
        <div>

            <!-- MESSAGE CHAT START -->
            <div class="popup-message-body-wrap">
                <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
                <input id="message-body" type="checkbox" checked="unchecked"/>
                <div class="wrap3">
                    <div class="message-send2" style="width: 45%;margin: auto auto; height: 76%">
                        <div class="message-header2" style="height: 60px;padding: 2px">
                            <div class="message-h-left">
                                <label class="back-messages" for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
                            </div>
                            <div class="message-h-cen">
                                <div class="message-head-img">
                                    <img src="img/<?=$user_info[0]->profileImage?>"/><span><?=$user_info[0]->name?></span>
                                </div>
                            </div>
                            <div class="message-h-right">
                                <label class="close-msgPopup" for="message-body" ><i class="fa fa-times" aria-hidden="true"></i></label>
                            </div>
                            <div class="message-del">
                                {{--<div class="message-del-inner">--}}
                                    {{--<h4>Are you sure you want to delete this message? </h4>--}}
                                    {{--<div class="message-del-box">--}}
					{{--<span>--}}
						{{--<button class="cancel" value="Cancel">Cancel</button>--}}
					{{--</span>--}}
                                        {{--<span>--}}
						{{--<button class="delete" value="Delete">Delete</button>--}}
					{{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="main-msg-wrap">
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
                                            <img src="chatimg/<?=$message->message?>" style="width: 200px;height: 150px">
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
                                            <img src="chatimg/<?=$message->message?>" style="width: 200px;height: 150px">
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
                        </div>
                        <div class="main-msg-footer">
                            <div class="main-msg-footer-inner">
                                <form id="messageForm" method="post" enctype="multipart/form-data">
                                    <ul>
                                        <li><textarea id="text" style="height: auto;direction: rtl" name="text" placeholder=""></textarea></li>
                                        <li><input id="file" name="file"  type="file" value="upload"/><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label></li>
                                        <input type="hidden" name="msgTo" value="<?=$user_info[0]->user_id?>"/>
                                        <li><input id="send" type="submit" value="ارسال"/></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div> <!--MASSGAE send ENDS-->
                </div> <!--wrap 3 end-->
            </div><!--POP UP message WRAP END-->

            <!-- message Chat popup end -->





        </div>
    </div>
</div>
<!-- POPUP MESSAGES END HERE -->




