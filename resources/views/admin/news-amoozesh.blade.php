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
                        <h3>ایجاد اخبار جدید</h3>
                        <hr>

                        <form action="/createNewJobFORM" method="post">
                            @csrf
                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-3">عنوان خبر</h6>
                                <div style="vertical-align: middle" class="custom-control col-9">
                                    <textarea type="text" class="form-control" name="job_title"></textarea>
                                </div>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-3">توضیحات خبر</h6>
                                <div style="vertical-align: middle" class="custom-control col-9">
                                    <textarea type="text" class="form-control" name="job_description"></textarea>
                                </div>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-3">مرتبط با دانشکده</h6>
                                <div style="vertical-align: middle" class="custom-control col-9">

                                    <select style="direction: rtl;width: 100%" name="job_callage" class="un" >
                                        <option value="all_collages">همه ی دانشکده ها</option>
                                        <? foreach ($universitys as $university){ ?>
                                        <option value="<?=$university->university_name?>"
                                                {{ old('job_callage') == $university->university_name ? 'selected' : '' }}>
                                            <?=$university->university_name?></option>
                                        <?}?>
                                    </select>

                                </div>
                            </div>



                            <button class="f-btn follow-btn">تایید</button>
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

@endsection

@section('css')

    <style>

        body form{

            font-size: 120%;
        }

    </style>

@endsection
