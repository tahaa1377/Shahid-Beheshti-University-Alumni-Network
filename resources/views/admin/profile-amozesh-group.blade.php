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
                        <hr>


                        <form method="post" action="/reportBYgroupCheck">
                            @csrf

                        <h5 style="text-align: right;padding: 10px">گزارش ها</h5>
                        <div class="form-group" style="padding: 10px; direction:rtl;text-align:right !important;" >
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" value="دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط است" class="custom-control-input" checked="">
                                <label class="custom-control-label" for="customRadio1"><h6>دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط است</h6></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="customRadio" value="دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط نیست" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2"><h6>دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط نیست</h6></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" value="دانش آموختگانی که مهاجرت کرده اند" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio3"><h6>دانش آموختگانی که مهاجرت کرده اند</h6></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="customRadio" value="دانش آموختگانی که کارآفرین هستند" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio4"><h6>دانش آموختگانی که کارآفرین هستند</h6></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio5" name="customRadio" value="دانش آموختگانی که بیکار هستند" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio5"><h6>دانش آموختگانی که بیکار هستند</h6></label>
                            </div>
                        </div>


                        <h5 style="text-align: right;padding: 10px">فیلتر ها</h5>
                        {{--<h6 style="float: right;padding: 0 10px;">دسته بندی بر اساس </h6>--}}
                        {{--<select style="direction: rtl;width: 30%" name="cluster">--}}
                                {{--<option>دانشکده</option>--}}
                                {{--<option>رشته</option>--}}
                        {{--</select>--}}

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-2">دانشکده</h6>
                                <div style="vertical-align: middle" class="custom-control col-10">

                            <select style="direction: rtl;width: 95%" name="callage" class="un" >
                                <option value="collage_no_select">-</option>
                                {{--<option value="collage_all_select">همه ی دانشکده ها</option>--}}
                                <? foreach ($universitys as $university){ ?>
                                <option value="<?=$university->university_name?>"
                                        {{ old('reg_callage') == $university->university_name ? 'selected' : '' }}>
                                    <?=$university->university_name?></option>
                                <?}?>
                            </select>
                                </div>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-2">رشته</h6>
                                <div style="vertical-align: middle" class="custom-control col-10">
                            <select style="direction: rtl;width: 95%" name="reshte">
                                <option value="reshte_no_select">-</option>
                                {{--<option value="reshte_all_select">همه ی رشته ها</option>--}}
                            <?foreach ($reshte as $resht) {?>
                                <option><?=$resht->field?> (<?=$resht->subGroup?>)</option>
                                <?}?>
                            </select>
                                </div>

                            </div>

                            <br>
                            <br>
                        <h6 style="float: right;padding: 0 10px;">تاریخ فارغ التحصیلی</h6>


                        <select name="end_year">
                        <?foreach ($start_years2 as $start_year) {?>
                            <option><?=$start_year->year?></option>
                            <?}?>
                        </select>
                        <span>از</span>

                        <select name="start_year">
                            <?foreach ($start_years as $start_year) {?>
                            <option><?=$start_year->year?></option>
                            <?}?>
                        </select>
                        &nbsp;
                        &nbsp;
                        <span>تا</span>

                        <br>
                        <br>
                        <br>
                            <button class="f-btn follow-btn">مشاهده گزارش</button>
                        </form>
                    </div>
                    <br>

                    <br>

                </div>

            </div>
            <br>
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
    {{--<div id="piechart"></div>--}}

    {{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}

    {{--<script type="text/javascript">--}}

        {{--$(function () {--}}
            {{--let arra = [];--}}
            {{--arra[0]=new Array(2);--}}
            {{--arra[0][0]="Task";--}}
            {{--arra[0][1]='Hours per Day';--}}

            {{--$.ajax('/testing', {--}}
                {{--type: 'post',--}}
                {{--dataType: 'json',--}}
                {{--success: function (data) {--}}

                    {{--for (let i=0; i<data.collage.length;i++){--}}
                        {{--arra[i+1] = new Array(2);--}}
                        {{--arra[i+1][0]=data.collage[i].university_name;--}}
                        {{--arra[i+1][1]=i;--}}
                    {{--}--}}
                    {{--google.charts.load('current', {'packages':['corechart']});--}}
                    {{--google.charts.setOnLoadCallback(drawChart);--}}

                    {{--// Draw the chart and set the chart values--}}
                    {{--function drawChart() {--}}
                        {{--var data = google.visualization.arrayToDataTable(arra);--}}

                        {{--// Optional; add a title and set the width and height of the chart--}}
                        {{--var options = {'title':'My Average Day', 'width':550, 'height':400};--}}

                        {{--// Display the chart inside the <div> element with id="piechart"--}}
                        {{--var chart = new google.visualization.PieChart(document.getElementById('piechart'));--}}
                        {{--chart.draw(data, options);--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}

        {{--});--}}
    {{--</script>--}}

@endsection

@section('css')

    <style>

        body form{

            font-size: 120%;
        }



    </style>

@endsection
