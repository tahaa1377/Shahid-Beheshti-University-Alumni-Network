@extends('main')

@section('section')


    <body >
    <div class="wrapper">
        <!-- header wrapper -->
        <div class="header-wrapper">

            <div class="nav-container">
                <!-- Nav -->
                <div class="nav">

                    <div class="nav-left">
                        <ul>
                            <li id="notifi"><a><i class="fa fa-bell" aria-hidden="true"></i><span style="float: left">اخبار</span>
                                        <?if ($notification_count[0]->no_count > 0) {?>
                                            <span id="counternotification" class="span-i"><?=$notification_count[0]->no_count?></span>
                                        <?}?></a>
                            </li>
                            <li id="messagei">
                                &nbsp;<a><i class="fa fa-envelope" aria-hidden="true"></i><span style="float: left">پیام ها</span>
                                <?if ($message_count[0]->me_count > 0) {?>
                                <span id="countermessages" class="span-i"><?=$message_count[0]->me_count?></span>
                                <?}?>
                                </a>
                            </li>

                            <li>&nbsp;<a href="/myProfile"><i class="fa fa-sticky-note" aria-hidden="true"></i>
                                    <span style="float: left">پروفایل من</span></a></li>

                        </ul>
                    </div><!-- nav left ends-->

                    <div class="nav-right">
                        <ul>
                            <li>

                                <input type="text" placeholder="Search" class="search"/>
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <div class="search-result">

                                </div>
                            </li>

                            <li style="margin-top: -10px" class="hover"><label class="drop-label" for="drop-wrap1"><img src="/img/<?=$user_info->profileImage?>"/></label>
                                <input type="checkbox" id="drop-wrap1">
                                <div class="drop-wrap">
                                    <div class="drop-inner">
                                        <ul>
                                            <li><a href="/myAccount"><?=$userz->username?></a></li>
                                            <li><a href="/accountEdit">تنظیمات</a></li>
                                            <li><a href="/logout">خروج</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- nav right ends-->

                </div><!-- nav ends -->

            </div><!-- nav container ends -->

        </div><!-- header wrapper end -->

        <div id="notification_result">

        </div>
        <!---Inner wrapper-->
        <div class="inner-wrapper">
            <div class="in-wrapper">
                <div class="in-full-wrap">
                    <div class="in-left">
                        <div class="in-left-wrap">
                            <div class="info-box">
                                <div class="info-inner">
                                    <div class="info-in-head">
                                        <!-- PROFILE-COVER-IMAGE -->
                                        <img src="/img/<?=$user_info->profileCover?>"/>
                                    </div><!-- info in head end -->
                                    <div class="info-in-body">
                                        <div class="in-b-box">
                                            <div class="in-b-img">
                                                <!-- PROFILE-IMAGE -->
                                                <img src="/img/<?=$user_info->profileImage?> "/>
                                            </div>
                                        </div><!--  in b box end-->
                                        <div class="info-body-name">
                                            <div class="in-b-name">
                                                <div><a href="/myAccount"><?=$userz->name?></a></div>
                                                <span><small><a href="/myAccount">@<?=$userz->username?></a></small></span>
                                            </div><!-- in b name end-->
                                        </div><!-- info body name end-->
                                    </div><!-- info in body end-->
                                    <div class="info-in-footer">
                                        <div class="number-wrapper">
                                            <div class="num-box">
                                                <div class="num-head">
                                                    توییت ها
                                                </div>
                                                <div class="num-body">
                                                    <?=
                                                    $tweetCount[0]->tweetcount?>
                                                </div>
                                            </div>
                                            <div class="num-box">
                                                <div class="num-head">
                                                    دنبال کننده
                                                </div>
                                                <div class="num-body">
                                                    <span class="count-following"><?=$user_info->following?> </span>
                                                </div>
                                            </div>
                                            <div class="num-box">
                                                <div class="num-head">
                                                    دنبال شونده
                                                </div>
                                                <div class="num-body">
                                                    <span class="count-followers"><?=$user_info->follower?></span>
                                                </div>
                                            </div>
                                        </div><!-- mumber wrapper-->
                                    </div><!-- info in footer -->
                                </div><!-- info inner end -->
                            </div><!-- info box end-->

                            <!--==TRENDS==-->
                            <!---TRENDS HERE-->
                            <!--==TRENDS==-->

                        </div><!-- in left wrap-->
                    </div><!-- in left end-->
                    <div class="in-center">
                        <div class="in-center-wrap">
                            <!--TWEET WRAPPER-->
                            <div class="tweet-wrap">
                                <div class="tweet-inner">
                            <? if ($profile != null){ ?>
                                    <div class="tweet-h-left">
                                        <div class="tweet-h-img">
                                            <!-- PROFILE-IMAGE -->
                                            <img src="/img/<?=$user_info->profileImage?>"/>
                                        </div>
                                    </div>

                                        <form method="post" action="/tweetPost" enctype="multipart/form-data">
                                            @csrf
                                            <div class="tweet-body">
                                            <textarea class="status" style="direction: rtl;outline: none" name="status" rows="4" cols="50"></textarea>
                                            </div>
                                          <div class="tweet-footer">
                                        <div class="t-fo-left">
                                            <ul>
                                                <input type="file" name="file" id="file"/>
                                                <li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
                                                    <span class="tweet-error" style="color: red">
                                                      {{$errors->first('file')}}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="t-fo-right">
                                            <input type="submit" value="توییت"/>
                                        </div>
                                          </div>
                                        </form>

                            <?}else{?>

                                <div class="tweet-footer">
                                    <br>
                                    <br>
                                    <br>
                                    <h6 style="direction: rtl">برای فرستادن توییت باید پروفایل خود را تکمیل کنید.
                                        <a href="/myProfile">پروفایل من</a>
                                    </h6>
                                </div>
                            <?}?>
                            </div>
                            </div>
                            <!--TWEET WRAP END-->

                            <hr>

                            <!--Tweet SHOW WRAPPER-->
                            <div class="tweets">

                                @foreach($tweets as $tweet)
                                <div class="all-tweet">
                                    <div class="t-show-wrap">
                                        <div class="t-show-inner">
                                            <!-- this div is for retweet icon
                                            <div class="t-show-banner">
                                                <div class="t-show-banner-inner">
                                                    <span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>Screen-Name Retweeted</span>
                                                </div>
                                            </div>
                                            -->
                                            <div class="t-show-popup">
                                                <div class="t-show-head">
                                                    <div class="t-show-img">
                                                        <img src="/img/<?=$tweet->profileImage?>"/>
                                                    </div>
                                                    <div class="t-s-head-content">
                                                        <div class="t-h-c-name">
                                                            <span><a href="/profileUser/<?=$tweet->username?>"><?=$tweet->name?></a></span>
                                                            <span>@<?=$tweet->username?></span>


                                                            <span><?=date('H:i',strtotime($tweet->posedOn))?></span>
                                                        </div>
                                                        <div class="t-h-c-dis">
                                                            <?=$tweet->status?>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($tweet->tweetImage != null)
                                                <!--tweet show head end-->
                                                <div class="t-show-body">
                                                    <div class="t-s-b-inner">
                                                        <div class="t-s-b-inner-in">
                                                            <img style="width: 90%" src="/tweetImg/<?=$tweet->tweetImage?>" class="imagePopup"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--tweet show body end-->
                                                 @endif
                                            </div>
                                            <div class="t-show-footer">
                                                <div class="t-s-f-right">
                                                    <ul class="row_responsive">
                                                        <li class="colx-2"><a href="#"></a></li>
                                                        <li class="colx-2"><a href="#"></a></li>
                                                        <li class="colx-2"><a href="#"></a></li>
                                                        <? if ($_SESSION['user_id'] == $tweet->tweetBy){ ?>
                                                        <li class="colx-2 mytweet" style="font-size: 120%" data-id="<?=$tweet->tweet_id?>">
                                                            <i  class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </li>
                                                        <?}?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                            <!--TWEETS SHOW WRAPPER-->

                            <div class="loading-div">

                            </div>
                            <div class="popupTweet"></div>
                            <!--Tweet END WRAPER-->

                        </div><!-- in left wrap-->
                    </div><!-- in center end -->

                    <div class="in-right">
                        <div class="in-right-wrap">

                            <div class="follow-wrap">
                                <div class="follow-inner"><div class="follow-title"><h3>پیشنهاد دنبال کردن</h3></div>
                                    <hr>
                                    @foreach($recomend as $recome)
                                    <div class="follow-body" style="margin: 10px">
                                        <div class="follow-img">
                                            <img src="/img/<?=$recome->profileImage?>"/>
                                        </div>
                                        <div class="follow-content">
                                            <div class="fo-co-head">
                                                <a href="/profileUser/<?=$recome->username?>"><?=$recome->name?></a> &nbsp;<span>@<?=$recome->username?></span>
                                            </div>
                                            <a href="/profileUser/<?=$recome->username?>">
                                                <button class="f-btn follow-btn"  ><i class='fa fa-user-plus'></i>دنبال کنید</button>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>


                        </div><!-- in left wrap-->

                    </div><!-- in right end -->

                </div><!--in full wrap end-->

            </div><!-- in wrappper ends-->
        </div><!-- inner wrapper ends-->
    </div><!-- ends wrapper -->
    </body>





@endsection

@section("js")

    <script src="/js/notification.min.js?it"></script>
    <script src="/js/search.min.js"></script>
    <script src="/js/tweetdelete.min.js"></script>
    <script src="/js/messages.min.js?jfoh"></script>

    <script>

       update_coutn=function () {

            $.ajax('/update_msg_count', {
                type: 'post',
                dataType: 'json',
                success: function (data) {

                    if (data.count === 0){
                        $('#messagei').html("   &nbsp;<a><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i><span style=\"float: left\">پیام ها</span>\n" +
                            "                                \n" +
                            "                               \n" +
                            "                                </a>");
                    } else {
                        $('#messagei').html("   &nbsp;<a><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i><span style=\"float: left\">پیام ها</span>\n" +
                            "                                \n" +
                            "                                <span id=\"countermessages\" class=\"span-i\">"+data.count+"</span>\n" +
                            "                               \n" +
                            "                                </a>");
                    }


                }
            });
        };

  setInterval(update_coutn,3000);




    </script>

@endsection
