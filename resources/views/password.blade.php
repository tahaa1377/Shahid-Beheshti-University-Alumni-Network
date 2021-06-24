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
                        </ul>
                    </div>
                    <!-- nav left ends-->
                    <div class="nav-right">
                        <ul>

                            <li style="margin-top: -10px" class="hover"><label class="drop-label" for="drop-wrap1"><img src="/img/<?=$user_info->profileImage?>"/></label>
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
                    </div>
                    <!-- nav right ends-->

                </div>
                <!-- nav ends -->

            </div><!-- nav container ends -->
        </div><!-- header wrapper end -->

        <div class="container-wrap">

            <div class="lefter">
                <div class="inner-lefter">

                    <div class="acc-info-wrap">
                        <div class="acc-info-bg">
                            <!-- PROFILE-COVER -->
                            <img src="/img/<?=$user_info->profileCover?>"/>
                        </div>
                        <div class="acc-info-img">
                            <!-- PROFILE-IMAGE -->
                            <img src="/img/<?=$user_info->profileImage?>"/>
                        </div>
                        <div class="acc-info-name">
                            <h3><?=$userz->name?></h3>
                            <span><a href="/myAccount">@<?=$userz->username?></a></span>
                        </div>
                    </div>
                    <!--Acc info wrap end-->

                    <div class="option-box">
                        <ul>
                            <li>
                                <a href="/myAccount" class="bold">
                                    <div>
                                        حساب کاربری
                                        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div><!--LEFTER ENDS-->

            <div class="righter">
                <div class="inner-righter">
                    <div class="acc">
                        <div class="acc-heading">
                            <h2>تنظیمات حساب کاربری</h2>
                        </div>
                        <div class="acc-content" style="direction: rtl">
                            <form method="POST" action="editInfoCheck">
                                @csrf
                                <div class="acc-wrap">
                                    <div class="acc-left">
                                        ایمیل
                                    </div>
                                    <div class="acc-right" style="direction: ltr">
                                        <input type="text" name="emailing" value="<?=$userz->email?>"/>
                                        <span>
									<!-- Username Error -->
								</span>
                                    </div>
                                </div>

                                <div class="acc-wrap">
                                    <div class="acc-left">
                                        شماره موبایل
                                    </div>
                                    <div class="acc-right" style="direction: ltr">
                                        <input type="text" name="phone_number" value="<?=$userz->phone_number?>"/>
                                        <span>
									<!-- Email Error -->
								</span>
                                    </div>
                                </div>



                                <div class="acc-wrap">
                                    <div class="acc-left">

                                    </div>
                                    <div class="acc-right">
                                        <input type="Submit" name="submit" value="ذخیره تغییرات"/>
                                    </div>
                                    <div class="settings-error">
                                        <!-- Fields Error -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="content-setting">
                        <div class="content-heading">

                        </div>
                        <div class="content-content">
                            <div class="content-left">

                            </div>
                            <div class="content-right">

                            </div>
                        </div>
                    </div>
                </div>
            </div><!--RIGHTER ENDS-->

        </div>
        <!--CONTAINER_WRAP ENDS-->

    </div><!-- ends wrapper -->


@endsection