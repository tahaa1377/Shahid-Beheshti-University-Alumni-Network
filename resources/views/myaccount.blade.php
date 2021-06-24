@extends('main')

@section('section')
<div class="wrapper">
    <!-- header wrapper -->
    <div class="header-wrapper">
        <div class="nav-container">
            <div class="nav">
                <div class="nav-left">
                    <ul>
                        @if($_SESSION['access'] == 'user')
                            <li><a href="/home"><i class="fa fa-home" aria-hidden="true"></i>خانه</a></li>
                        @else
                            <li><a href="/admin"><i class="fa fa-home" aria-hidden="true"></i>خانه</a></li>
                        @endif
                        <li><a href="/myProfile"><i class="fa fa-sticky-note" aria-hidden="true"></i>پروفایل</a></li>
                    </ul>
                </div><!-- nav left ends-->
                <div class="nav-right">
                    <ul>
                        <li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i>
                            <div class="search-result">
                            </div>
                        </li>

                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="/img/<?=$user_info->profileImage?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
                                        <li><a href="/editInfo">تنظیمات</a></li>
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
    <!--Profile cover-->
    <div class="profile-cover-wrap">
        <div class="profile-cover-inner">
            <div class="profile-cover-img">
                <!-- PROFILE-COVER -->
                <img src="/img/<?=$user_info->profileCover?>"/>
            </div>
        </div>
        <div class="profile-nav">
            <div class="profile-navigation">
                <ul>
                    <li>
                        <div style="font-size: 120%;margin-bottom: 10px" class="n-head">
                            توییت ها
                        </div>
                        <div class="n-bottom">
                            0
                        </div>
                    </li>
                    <li>
                        <a >
                            <div style="font-size: 120%;margin-bottom: 10px" class="n-head">
                                دنبال شونده
                            </div>
                            <div class="n-bottom">
                                <span class="count-following"><?=$user_info->follower?></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a >
                            <div style="font-size: 120%;margin-bottom: 10px" class="n-head">
                                دنبال کننده
                            </div>
                            <div class="n-bottom">
                                <span class="count-followers"><?=$user_info->following?></span>
                            </div>
                        </a>
                    </li>

                </ul>
                <div class="edit-button">
		<span>
<button onclick="location.href='accountEdit'" class="f-btn"  data-follow="follow_id" data-user="user_id">ویرایش حساب کاربری</button>		</span>
                </div>
            </div>
        </div>
    </div><!--Profile Cover End-->

    <!---Inner wrapper-->
    <div class="in-wrapper">
        <div class="in-full-wrap">
            <div class="in-left">
                <div class="in-left-wrap">
                    <!--PROFILE INFO WRAPPER END-->
                    <div class="profile-info-wrap">
                        <div class="profile-info-inner">
                            <!-- PROFILE-IMAGE -->
                            <div class="profile-img">
                                <img src="/img/<?=$user_info->profileImage?>"/>
                            </div>

                            <div class="profile-name-wrap">
                                <div class="profile-name">
                                    <a href="/myAccount"><?=$userz->name?></a>
                                </div>
                                <div class="profile-tname">
                                    @<span class="username"><?=$userz->username?></span>
                                </div>
                            </div>

                            <div class="profile-bio-wrap">
                                <div class="profile-bio-inner">
                                    <?=$user_info->bio?>
                                </div>
                            </div>

                            <div class="profile-extra-info">
                                <div class="profile-extra-inner">

                                </div>
                            </div>

                            <div class="profile-extra-footer">
                                <div class="profile-extra-footer-head">
                                    <div class="profile-extra-info">
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-extra-footer-body">
                                    <ul>
                                        <!-- <li><img src="#"/></li> -->
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!--PROFILE INFO INNER END-->

                    </div>
                    <!--PROFILE INFO WRAPPER END-->

                </div>
                <!-- in left wrap-->

            </div>
            <!-- in left end-->

            <div class="in-center">
                <div class="in-center-wrap">
                    <!--Tweet SHOW WRAPER-->
                    <!--Tweet SHOW WRAPER END-->
                    <div class="follow-wrap">
                        <div class="follow-inner">
                            <div class="follow-title"><h3>دنبال کنندگان</h3></div>
                            <hr>
                            <? foreach ($followrs as $followr){ ?>
                            <div class="follow-body">
                                <div class="follow-img">
                                    <img src="/img/<?=$followr->profileImage?>"/>
                                </div>
                                <div class="follow-content">
                                    <div class="fo-co-head">
                                        <a href="/profileUser/<?=$followr->username?>"><?=$followr->name?></a><div>@<?=$followr->username?></div>
                                    </div>
                                    <!-- FOLLOW BUTTON -->
                                </div>
                            </div>
                            <? }?>
                        </div>
                    </div>



                </div><!-- in left wrap-->
                <div class="popupTweet"></div>
            </div>
            <!-- in center end -->

            <div class="in-right">
                <div class="in-right-wrap">

                    <!--==WHO TO FOLLOW==-->
                    <!--who to follow-->
                    <!--==WHO TO FOLLOW==-->


                    <!--==TRENDS==-->
                    <!--Trends-->
                    <!--==TRENDS==-->

                </div><!-- in right wrap-->
            </div>
            <!-- in right end -->

        </div>
        <!--in full wrap end-->
    </div>
    <!-- in wrappper ends-->
</div>
<!-- ends wrapper -->

@endsection

@section("js")

    <script src="/js/search.min.js"></script>

@endsection