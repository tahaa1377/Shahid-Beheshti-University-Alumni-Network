
@extends('main')
@section('section')
<div class="wrapper">
    <!-- header wrapper -->
    <div class="header-wrapper">

        <div class="nav-container">
            <!-- Nav -->
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
                </div>
                <!-- nav left ends-->
                <div class="nav-right">
                    <ul>
                        <li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i>
                            <div class="search-result">

                            </div></li>
                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="/img/<?=$user_info->profileImage?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
                                        <li><a href="/myAccount"><?=$userz->username?></a></li>
                                        <li><a href="/editInfo">تنظیمات</a></li>
                                        <li><a href="/logout">خروج</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- nav right ends-->
            </div>
            <!-- nav ends -->
        </div>
        <!-- nav container ends -->
    </div>
    <!-- header wrapper end -->

    <!--Profile cover-->
    <div class="profile-cover-wrap">
        <div class="profile-cover-inner">
            <div class="profile-cover-img">
                <!-- PROFILE-COVER -->
                <img src="/img/<?=$user_info->profileCover?>"/>

                <div class="img-upload-button-wrap">
                    <div class="img-upload-button1">
                        <label for="cover-upload-btn">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </label>
                        <span class="span-text1">
					تغییر عکس حساب کاربری
				</span>
                        <input id="cover-upload-btn" type="checkbox"/>
                        <div class="img-upload-menu1">
                            <span class="img-upload-arrow"></span>
                            <form method="post" action="/editProfileCover" enctype="multipart/form-data">
                                @csrf
                                <ul>
                                    <li>
                                        <label for="file-up">
                                            آپلود عکس
                                        </label>
                                        <input accept=".jpg,.png" type="file" name="profileCover" onchange="this.form.submit()" id="file-up" />
                                    </li>
                                    <li>
                                        <label for="cover-upload-btn">
                                            لغو
                                        </label>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
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

                </ul>                <div class="edit-button">
			<span>
				<button class="f-btn" type="button" value="Cancel">لغو</button>
			</span>
                    <span>
				<input type="submit" id="save" value="اعمال تغییرات">
			</span>

                </div>
            </div>
        </div>
    </div><!--Profile Cover End-->

    <div class="in-wrapper">
        <div class="in-full-wrap">
            <div class="in-left">
                <div class="in-left-wrap">
                    <!--PROFILE INFO WRAPPER END-->
                    <div class="profile-info-wrap">
                        <div class="profile-info-inner">
                            <div class="profile-img">
                                <!-- PROFILE-IMAGE -->
                                <img src="/img/<?=$user_info->profileImage?>"/>
                                <div class="img-upload-button-wrap1">
                                    <div class="img-upload-button">
                                        <label for="img-upload-btn">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </label>
                                        <span class="span-text"></span>
                                        <input id="img-upload-btn" type="checkbox"/>
                                        <div class="img-upload-menu">
                                            <span class="img-upload-arrow"></span>
                                            <form method="post" action="editProfileImage" enctype="multipart/form-data">
                                                @csrf
                                                <ul>
                                                    <li>
                                                        <label for="profileImage">
                                                            آپلود عکس
                                                        </label>
                                                        <input accept=".jpg,.png"  id="profileImage" type="file" onchange="this.form.submit()" name="profileImage"/>

                                                    </li>
                                                    <li>
                                                        <label for="img-upload-btn">
                                                            Cancel
                                                        </label>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- img upload end-->
                                </div>
                            </div>

                            <form id="editForm" action="/editForm" method="post" enctype="multipart/Form-data">
                                @csrf
                                <div class="profile-name-wrap">
                                    <!-- <ul>
                                          <li class="error-li">
                                              <div class="span-pe-error"></div>
                                         </li>
                                     </ul>  -->
                                    <div class="profile-name">
                                        <span style="font-size: 90%">نام :</span>
                                        <input type="text" name="screenName" value="<?=$userz->name?>"/>
                                    </div>
                                    <br>
                                    <div class="profile-name">
                                      <span style="font-size: 90%">  ایدی </span>
                                        <input type="text" disabled="" value="@<?=$userz->username?>"/>

                                    </div>
                                </div>
                                <div class="profile-bio-wrap">
                                    <div class="profile-bio-inner">
                                        <span style="font-size: 90%;float: left;">  رزومه :</span>
                                        <textarea class="status" name="bio"><?=$user_info->bio?></textarea>
                                        <div class="hash-box">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-extra-info">
                                    <div class="profile-extra-inner">

                                    </div>
                                </div>
                            </form>
                            <script>
                                $('#save').click(function () {
                                    $('#editForm').submit();
                                });
                            </script>
                            </ul>
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
                                <!-- <li><img src="#"></li> -->
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
            <!-- HERE WILL BE TWEETS -->
        </div>
        <!-- in left wrap-->
        <div class="popupTweet"></div>

    </div>
    <!-- in center end -->

    <div class="in-right">
        <div class="in-right-wrap">
            <!--==WHO TO FOLLOW==-->
            <!-- HERE -->
            <!--==WHO TO FOLLOW==-->

            <!--==TRENDS==-->
            <!-- HERE -->
            <!--==TRENDS==-->
        </div>
        <!-- in left wrap-->
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