@extends('main')

@section('section')

b
    <div class="wrapper">
        <!-- header wrapper -->
        <div class="header-wrapper">

            <div class="nav-container">
                <!-- Nav -->
                <div class="nav">

                    <div class="nav-left">
                        <ul>
                            <li><a href="/home"><i class="fa fa-home" aria-hidden="true"></i>خانه</a></li>

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
                            <li>
                                <a href="/editInfo">
                                    <div>
                                        تنظیمات
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
                            <h2>پروفایل</h2>
                        </div>
                        <form method="POST" action="/profileCheck">
                            <br>
                            @csrf
                            <div class="form-group row offset-3" style="direction: rtl">
                                <h6 style="text-align: right"  class="col-3">وضعیت مهاجرت  </h6>
                                <? if ($profile->migration_status == 'migrate_in'){ ?>
                                <div  class="custom-control custom-radio col-4">
                                    <input type="radio" id="migrate_in" name="migrate" value="migrate_in" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="migrate_in">داخل</label>
                                </div>

                                <div  class="custom-control custom-radio col-4 ">
                                    <input type="radio" id="migrate_out" name="migrate" value="migrate_out" class="custom-control-input">
                                    <label class="custom-control-label" for="migrate_out">خارج</label>
                                </div>
                                <?}else{?>
                                <div  class="custom-control custom-radio col-4">
                                    <input type="radio" id="migrate_in" name="migrate" value="migrate_in" class="custom-control-input" >
                                    <label class="custom-control-label" for="migrate_in">داخل</label>
                                </div>

                                <div  class="custom-control custom-radio col-4 ">
                                    <input type="radio" id="migrate_out" name="migrate" value="migrate_out" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="migrate_out">خارج</label>
                                </div>
                                <?}?>
                            </div>


                            <div class="form-group row offset-3" style="direction: rtl">
                                <h6  class="col-3">وضعیت شغلی</h6>

                                <? if ($profile->job_status == 'unemployed'){ ?>
                                <div  class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_no" name="job" value="unemployed" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="job_no">بیکار</label>
                                </div>

                                <div  class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_study" name="job" value="Studying" class="custom-control-input">
                                    <label class="custom-control-label" for="job_study">درحال تحصیل</label>
                                </div>

                                <div class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_job" name="job" value="employed" class="custom-control-input">
                                    <label class="custom-control-label" for="job_job">شاغل</label>
                                </div>

                                <?}else if ($profile->job_status == 'Studying'){?>
                                <div  class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_no" name="job" value="unemployed" class="custom-control-input">
                                    <label class="custom-control-label" for="job_no">بیکار</label>
                                </div>

                                <div  class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_study" name="job" value="Studying" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="job_study">درحال تحصیل</label>
                                </div>

                                <div class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_job" name="job" value="employed" class="custom-control-input">
                                    <label class="custom-control-label" for="job_job">شاغل</label>
                                </div>
                                <?}else{?>
                                <div  class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_no" name="job" value="unemployed" class="custom-control-input">
                                    <label class="custom-control-label" for="job_no">بیکار</label>
                                </div>

                                <div  class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_study" name="job" value="Studying" class="custom-control-input" >
                                    <label class="custom-control-label" for="job_study">درحال تحصیل</label>
                                </div>

                                <div class="custom-control custom-radio col-3">
                                    <input type="radio" id="job_job" name="job" value="employed" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="job_job">شاغل</label>
                                </div>
                                <?}?>

                            </div>

                            <? if ($profile->job_status != 'employed'){ ?>

                        {{--////////////////--}}
                            <div class="form-group row offset-3" style="direction: rtl">
                                <h6   class="col-3"> نوع حرفه</h6>
                                <div class="custom-control custom-radio col-4">
                                    <input type="radio" id="karmand" name="karmand_karafarin" value="karmand" class="custom-control-input" disabled="">
                                    <label class="custom-control-label" for="karmand">کارمند</label>
                                </div>

                                <div class="custom-control custom-radio col-4 ">
                                    <input type="radio" id="karafarin" name="karmand_karafarin" value="karafarin" class="custom-control-input" disabled="">
                                    <label class="custom-control-label" for="karafarin">کارآفرین</label>
                                </div>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl">
                                <h6  class="col-8">آیا شغل شما با رشته ی تحصیلی تان مرتبط است؟</h6>

                                <div class="custom-control custom-radio col-2 ">
                                    <input type="radio" id="yes" name="job_select" value="job_rel_yes" class="custom-control-input" disabled="">
                                    <label class="custom-control-label" for="yes">بله</label>
                                </div>

                                <div class="custom-control custom-radio col-2 ">
                                    <input type="radio" id="no" name="job_select" value="job_rel_no" class="custom-control-input" disabled="">
                                    <label class="custom-control-label" for="no">خیر</label>
                                </div>

                            </div>

                            <div class="form-group row offset-3" style="direction: rtl;" id="non_rel_job">

                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">ضمینه ی شغلی</h6>

                                <div style="vertical-align: middle" class="custom-control col-8">
                                    <input type="text" class="form-control" id="inputDefault" name="job_feild">
                                </div>

                            </div>

                            <?}else{?>


                            <div class="form-group row offset-3" style="direction: rtl">
                                <h6   class="col-3"> نوع حرفه</h6>
                                <? if ($profile->job_type != 'karmand'){ ?>
                                <div class="custom-control custom-radio col-4">
                                    <input type="radio" id="karmand" name="karmand_karafarin" value="karmand" class="custom-control-input" >
                                    <label class="custom-control-label" for="karmand">کارمند</label>
                                </div>

                                <div class="custom-control custom-radio col-4 ">
                                    <input type="radio" id="karafarin" name="karmand_karafarin" value="karafarin" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="karafarin">کارآفرین</label>
                                </div>

                            <?}else{?>
                            <div class="custom-control custom-radio col-4">
                                <input type="radio" id="karmand" name="karmand_karafarin" value="karmand" class="custom-control-input" checked>
                                <label class="custom-control-label" for="karmand">کارمند</label>
                            </div>

                            <div class="custom-control custom-radio col-4 ">
                                <input type="radio" id="karafarin" name="karmand_karafarin" value="karafarin" class="custom-control-input"  >
                                <label class="custom-control-label" for="karafarin">کارآفرین</label>
                            </div>

                            <?}?>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl">
                                <h6  class="col-8">آیا شغل شما با رشته ی تحصیلی تان مرتبط است؟</h6>
                                <? if ($profile->job_Education_rel == '1'){ ?>
                                <div class="custom-control custom-radio col-2 ">
                                    <input type="radio" id="yes" name="job_select" value="job_rel_yes" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="yes">بله</label>
                                </div>

                                <div class="custom-control custom-radio col-2 ">
                                    <input type="radio" id="no" name="job_select" value="job_rel_no" class="custom-control-input" >
                                    <label class="custom-control-label" for="no">خیر</label>
                                </div>
                                <?}else{?>
                                <div class="custom-control custom-radio col-2 ">
                                    <input type="radio" id="yes" name="job_select" value="job_rel_yes" class="custom-control-input" >
                                    <label class="custom-control-label" for="yes">بله</label>
                                </div>

                                <div class="custom-control custom-radio col-2 ">
                                    <input type="radio" id="no" name="job_select" value="job_rel_no" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="no">خیر</label>
                                </div>
                                <?}?>
                            </div>

                            <? if ($profile->job_Education_rel == '1'){ ?>
                            <div class="form-group row offset-3" style="direction: rtl;" id="non_rel_job">

                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">ضمینه ی شغلی</h6>


                                <div style="vertical-align: middle" class="custom-control col-8">
                                    <input type="text" class="form-control" id="inputDefault" name="job_feild">
                                </div>

                            </div>
                                      <?}else{?>
                            <div class="form-group row offset-3" style="direction: rtl;" id="non_rel_job1">

                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">ضمینه ی شغلی</h6>


                                <div style="vertical-align: middle" class="custom-control col-8">
                                    <input type="text" class="form-control" id="inputDefault" name="job_feild"
                                           value="<?=$profile->job_name_no_rel?>">
                                </div>

                            </div>
                                      <?}?>

                            <?}?>
                            {{--/////////////--}}

                            <button class="f-btn accept-btn" style="padding: 7px 15px;border: 0.5px solid #5f5f5f;outline: none">تایید</button>
                            <br>
                            @if (Session::has('error'))
                                <div class="alert alert-danger fonting" style="direction: rtl">{{ Session::get('error') }}</div>
                            @endif
                        </form>
                        <br>
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
        </div>
        <!--RIGHTER ENDS-->
    </div>
    <!--CONTAINER_WRAP ENDS-->
    </div>
    <!-- ends wrapper -->



@endsection

@section('js')

    <script src="/js/profile_complete.min.js?jk"></script>

@endsection

@section('css')

    <style>

        body form{

            font-size: 120%;
        }

    </style>

@endsection
