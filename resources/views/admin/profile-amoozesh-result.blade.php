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
                    </div><!-- nav left ends-->

                    <div class="nav-right">
                        <ul>


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


                </div>
            </div><!--LEFTER ENDS-->

            <div class="righter">
                <div class="inner-righter">
                    <div class="acc">
                        <br>
                        <h3>گزارش های آموزش</h3>
                        <hr>
                        <div class="row">


                            <div class="col-6">
                                <a href="/reportBYstudent">
                                    <button class="f-btn follow-btn">گزارش بر اساس دانشجو</button>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/groupByReport">
                                    <button class="f-btn follow-btn">گزارش های کلی</button>
                                </a>
                            </div>
                            <br>
                        </div>
                        <br>
                    </div>
                    @if(count($result) > 0)
                    <div class="form-group row offset-3" style="direction: rtl;" >
                        <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">نام دانشجو :</h6>
                        <div style="vertical-align: middle" class="custom-control col-8">
                            <h6><?=$result[0]->name?></h6>
                        </div>
                    </div>

                    <div class="form-group row offset-3" style="direction: rtl;" >
                        <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">نام خانوادگی دانشجو :</h6>
                        <div style="vertical-align: middle" class="custom-control col-8">
                            <h6><?=$result[0]->family?></h6>
                        </div>
                    </div>

                    <div class="form-group row offset-3" style="direction: rtl;" >
                        <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">وضعیت مهاجرت :</h6>
                        <div style="vertical-align: middle" class="custom-control col-8">
                            @if($result[0]->migration_status == 'migrate_in')
                            <h6>داخل کشور</h6>
                            @else
                                <h6>خارج از کشور</h6>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row offset-3" style="direction: rtl;" >
                        <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">وضعیت شغلی :</h6>
                        <div style="vertical-align: middle" class="custom-control col-8">
                            @if($result[0]->job_status == 'unemployed')
                                <h6>بیکار</h6>
                            @elseif($result[0]->job_status == 'Studying')
                                <h6>درحال تحصیل</h6>
                                @else
                                <h6>شاغل</h6>
                            @endif
                        </div>
                    </div>

                    @if($result[0]->job_status == 'employed')

                        <div class="form-group row offset-3" style="direction: rtl;" >
                            <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">نوع حرفه :</h6>
                            <div style="vertical-align: middle" class="custom-control col-8">
                                @if($result[0]->job_type == 'karmand')
                                    <h6>کارمند</h6>
                                @else
                                    <h6>کارآفرین</h6>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row offset-3" style="direction: rtl;" >
                            <h6 style="vertical-align: middle;margin-top: 5px" class="col-8">شغل دانشجو با رشته ی تحصیلی اش مرتبط است :</h6>
                            <div style="vertical-align: middle" class="custom-control col-4">
                                @if($result[0]->job_Education_rel == '1')
                                    <h6>بله</h6>
                                @else
                                    <h6>خیر</h6>
                                @endif
                            </div>
                        </div>

                        @if($result[0]->job_Education_rel == '0')

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">ضمینه ی شغلی :</h6>
                                <div style="vertical-align: middle" class="custom-control col-8">
                                        <h6><?=$result[0]->job_name_no_rel?></h6>
                                </div>
                            </div>
                        @endif

                        @endif

                    @else
                        <h6>دانشجو با این مشخصات یافت نشد</h6>
                    @endif

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
        </div>
        <!--RIGHTER ENDS-->
    </div>
    <!--CONTAINER_WRAP ENDS-->
    </div>
    <!-- ends wrapper -->



@endsection

@section('js')

@endsection

@section('css')

    <style>

        body form{

            font-size: 120%;
        }

    </style>

@endsection
