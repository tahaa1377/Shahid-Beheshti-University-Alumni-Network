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

                    </div>
                    <hr>

                    <?if(count($result) > 0){?>

                    <div style="width: 90%">
                        <h5 style="color: blue"><?=$subject?></h5><br>
                        <?$counter=-1;?>
                        <?foreach ($result as $item){?>

                        <? if ($item->field != null){
                        $counter++;
                        ?>
                        <h6><?=($item->field)?></h6>

                        <? if ($counter % 4 == 0){ ?>
                        <div class="container">
                            <div class="skills html" style="width: <?=intval($item->percent) .'%'?>;"><?=intval($item->percent) .'%'?></div>
                        </div>
                        <? }else if ($counter % 4 == 1){ ?>
                        <div class="container">
                            <div class="skills css" style="width: <?=intval($item->percent) .'%'?>;"><?=intval($item->percent) .'%'?></div>
                        </div>
                        <? }else if ($counter % 4 == 2){ ?>
                        <div class="container">
                            <div class="skills js" style="width: <?=intval($item->percent) .'%'?>;"><?=intval($item->percent) .'%'?></div>
                        </div>
                        <? }else if ($counter % 4 == 3){ ?>
                        <div class="container">
                            <div class="skills php" style="width: <?=intval($item->percent) .'%'?>;"><?=intval($item->percent) .'%'?></div>
                        </div>
                        <?}
                        }?>
                        <? }?>
                    </div>

                    <? }else{?>

                    <h6>گزارشی یافت نشد</h6>


                    <?}?>
                    <br>
                    <br>
                    <br>
                    <br>


                    <a href="/groupByReport">
                        <button class="f-btn follow-btn">بازگشت</button>
                    </a>
                    <br>
                    <br>
                    <br>
                    <br>
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

        .container {
            padding: inherit;
            float: left;
            width: 100%;
            background-color: #ddd;
        }

        .skills {
            float: left;
            text-align: right;
            font-size: 150%;
            padding-top: 10px;
            padding-bottom: 10px;
            color: white;
        }

        .html {background-color: #4CAF50;}
        .css {background-color: #2196F3;}
        .js {background-color: #f44336;}
        .php {background-color: #808080;}
    </style>



@endsection
