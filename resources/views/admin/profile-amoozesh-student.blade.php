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
                        <form action="/reportBYstudentCheck" method="post">
                            @csrf
                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">نام دانشجو</h6>
                                <div style="vertical-align: middle" class="custom-control col-8">
                                    <input type="text" class="form-control" name="reportBYstudent_name">
                                </div>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">نام خانوادگی دانشجو</h6>
                                <div style="vertical-align: middle" class="custom-control col-8">
                                    <input type="text" class="form-control" name="reportBYstudent_family">
                                </div>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">شماره دانشجویی</h6>
                                <div style="vertical-align: middle" class="custom-control col-8">
                                    <input type="text" class="form-control" name="reportBYstudent_stuNumber" id="student_number">
                                </div>
                            </div>



                            <div  class="form-group row offset-3 " style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-2">رشته</h6>
                                <div style="vertical-align: middle" class="custom-control col-10">

                                    <select id="select-state" style="direction: rtl;width: 100%" name="reshte">
                                        <option></option>
                                        <?foreach ($reshte as $resht) {?>
                                        <option><?=$resht->field?> (<?=$resht->subGroup?>)</option>
                                        <?}?>
                                    </select>

                                </div>
                            </div>



                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">دانشکده</h6>
                                <div style="vertical-align: middle" class="custom-control col-8">

                                    <select style="direction: rtl;width: 100%" name="reg_callage" class="un" >
                                        <option></option>
                                        <? foreach ($universitys as $university){ ?>
                                        <option value="<?=$university->university_name?>"
                                                {{ old('reg_callage') == $university->university_name ? 'selected' : '' }}>
                                            <?=$university->university_name?></option>
                                        <?}?>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row offset-3" style="direction: rtl;" >
                                <h6 style="vertical-align: middle;margin-top: 5px" class="col-4">سال فارغ التحصیلی</h6>
                                <div style="vertical-align: middle" class="custom-control col-8">

                                    <select name="reg_start_year" class="un" style="width: 100%">

                                        <option></option>
                                        <? foreach ($start_years as $start_year){ ?>
                                        <option value="<?=$start_year->year?>"
                                                {{ old('reg_start_year') == $start_year->year ? 'selected' : '' }}>
                                            <?=$start_year->year?></option>
                                        <?}?>
                                    </select>

                                </div>

                            </div>
                                <button class="f-btn follow-btn">جست و جو</button>
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

    <script>

        $(function () {


            $(document).on('keyup','#student_number',function (e) {

                let str = $(this).val();
                let lastchar = str.charAt(str.length - 1);
                if ( !(lastchar >= '0' && lastchar <= '9')){
                    $('#student_number').val('');
                    alert("لطفا از اعداد انگلیسی استفاده کنید")
                }

            });


        });
        //
        // function create_custom_dropdowns() {
        //     $('select').each(function (i, select) {
        //         if (!$(this).next().hasClass('dropdown-select')) {
        //             $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') +
        //                 '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
        //             var dropdown = $(this).next();
        //             var options = $(select).find('option');
        //             var selected = $(this).find('option:selected');
        //             dropdown.find('.current').html(selected.data('display-text') || selected.text());
        //             options.each(function (j, o) {
        //                 var display = $(o).data('display-text') || '';
        //                 dropdown.find('ul').append('<li class="option ' +
        //                     ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '"' +
        //                     ' data-display-text="' + display + '">' + $(o).text() + '</li>');
        //             });
        //         }
        //     });
        //
        //     $('.dropdown-select ul').before('<div class="dd-search">' +
        //         '<input id="txtSearchValue" autocomplete="off" onkeyup="filter()"' +
        //         ' class="dd-searchbox" type="text"></div>');
        // }
        //
        // // Event listeners
        //
        // // Open/close
        // $(document).on('click', '.dropdown-select', function (event) {
        //     if($(event.target).hasClass('dd-searchbox')){
        //         return;
        //     }
        //     $('.dropdown-select').not($(this)).removeClass('open');
        //     $(this).toggleClass('open');
        //     if ($(this).hasClass('open')) {
        //         $(this).find('.option').attr('tabindex', 0);
        //         $(this).find('.selected').focus();
        //     } else {
        //         $(this).find('.option').removeAttr('tabindex');
        //         $(this).focus();
        //     }
        // });
        //
        // // Close when clicking outside
        // $(document).on('click', function (event) {
        //     if ($(event.target).closest('.dropdown-select').length === 0) {
        //         $('.dropdown-select').removeClass('open');
        //         $('.dropdown-select .option').removeAttr('tabindex');
        //     }
        //     event.stopPropagation();
        // });
        //
        // function filter(){
        //     var valThis = $('#txtSearchValue').val();
        //     $('.dropdown-select ul > li').each(function(){
        //         var text = $(this).text();
        //         (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
        //     });
        // };
        // // Search
        //
        // // Option click
        // $(document).on('click', '.dropdown-select .option', function (event) {
        //     $(this).closest('.list').find('.selected').removeClass('selected');
        //     $(this).addClass('selected');
        //     var text = $(this).data('display-text') || $(this).text();
        //     $(this).closest('.dropdown-select').find('.current').text(text);
        //     $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
        // });
        //
        // // Keyboard events
        // $(document).on('keydown', '.dropdown-select', function (event) {
        //     var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
        //     // Space or Enter
        //     //if (event.keyCode == 32 || event.keyCode == 13) {
        //     if (event.keyCode == 13) {
        //         if ($(this).hasClass('open')) {
        //             focused_option.trigger('click');
        //         } else {
        //             $(this).trigger('click');
        //         }
        //         return false;
        //         // Down
        //     } else if (event.keyCode == 40) {
        //         if (!$(this).hasClass('open')) {
        //             $(this).trigger('click');
        //         } else {
        //             focused_option.next().focus();
        //         }
        //         return false;
        //         // Up
        //     } else if (event.keyCode == 38) {
        //         if (!$(this).hasClass('open')) {
        //             $(this).trigger('click');
        //         } else {
        //             var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
        //             focused_option.prev().focus();
        //         }
        //         return false;
        //         // Esc
        //     } else if (event.keyCode == 27) {
        //         if ($(this).hasClass('open')) {
        //             $(this).trigger('click');
        //         }
        //         return false;
        //     }
        // });
        //
        // $(document).ready(function () {
        //     create_custom_dropdowns();
        // });



    </script>
@endsection

@section('css')

    <style>

        body form{

            font-size: 120%;
        }

        /*html,body{*/
            /*height:100%;*/
        /*}*/
        /*body{*/
            /*padding:0;*/
            /*margin:0;*/
            /*color: #2c3e51;*/
            /*background: #f5f5f5;*/
            /*font-family: 'Ubuntu', sans-serif;*/
        /*}*/
        /*.container{*/
            /*height:100%;*/
            /*display:flex;*/
            /*align-items:center;*/
            /*justify-content:center;*/
        /*}*/
        /*.main{*/
            /*margin:1rem;*/
            /*max-width:350px;*/
            /*width:50%;*/
            /*height:250px;*/
        /*}*/
        /*@media(max-width:34em){*/
            /*.main{*/
                /*min-width:150px;*/
                /*width:auto;*/
            /*}*/
        /*}*/
        /*select {*/
            /*display: none !important;*/
        /*}*/

        /*.dropdown-select {*/
            /*background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0) 100%);*/
            /*background-repeat: repeat-x;*/
            /*filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40FFFFFF', endColorstr='#00FFFFFF', GradientType=0);*/
            /*background-color: #fff;*/
            /*border-radius: 6px;*/
            /*border: solid 1px #eee;*/
            /*box-shadow: 0px 2px 5px 0px rgba(155, 155, 155, 0.5);*/
            /*box-sizing: border-box;*/
            /*cursor: pointer;*/
            /*display: block;*/
            /*float: left;*/
            /*font-size: 14px;*/
            /*font-weight: normal;*/
            /*height: 42px;*/
            /*line-height: 40px;*/
            /*outline: none;*/
            /*padding-left: 18px;*/
            /*padding-right: 30px;*/
            /*position: relative;*/
            /*text-align: left !important;*/
            /*transition: all 0.2s ease-in-out;*/
            /*-webkit-user-select: none;*/
            /*-moz-user-select: none;*/
            /*-ms-user-select: none;*/
            /*user-select: none;*/
            /*white-space: nowrap;*/
            /*width: auto;*/

        /*}*/

        /*.dropdown-select:focus {*/
            /*background-color: #fff;*/
        /*}*/

        /*.dropdown-select:hover {*/
            /*background-color: #fff;*/
        /*}*/

        /*.dropdown-select:active,*/
        /*.dropdown-select.open {*/
            /*background-color: #fff !important;*/
            /*border-color: #bbb;*/
            /*box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;*/
        /*}*/

        /*.dropdown-select:after {*/
            /*height: 0;*/
            /*width: 0;*/
            /*border-left: 4px solid transparent;*/
            /*border-right: 4px solid transparent;*/
            /*border-top: 4px solid #777;*/
            /*transition: all 0.125s ease-in-out;*/
            /*content: '';*/
            /*display: block;*/
            /*margin-top: -2px;*/
            /*pointer-events: none;*/
            /*position: absolute;*/
            /*right: 10px;*/
            /*top: 50%;*/
        /*}*/

        /*.dropdown-select.open:after {*/
            /*-webkit-transform: rotate(-180deg);*/
            /*transform: rotate(-180deg);*/
        /*}*/

        /*.dropdown-select.open .list {*/
            /*-webkit-transform: scale(1);*/
            /*transform: scale(1);*/
            /*opacity: 1;*/
            /*pointer-events: auto;*/
        /*}*/

        /*.dropdown-select.open .option {*/
            /*cursor: pointer;*/
        /*}*/

        /*.dropdown-select.wide {*/
            /*width: 100%;*/
        /*}*/

        /*.dropdown-select.wide .list {*/
            /*left: 0 !important;*/
            /*right: 0 !important;*/
        /*}*/

        /*.dropdown-select .list {*/
            /*box-sizing: border-box;*/
            /*transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;*/
            /*-webkit-transform: scale(0.75);*/
            /*transform: scale(0.75);*/
            /*-webkit-transform-origin: 50% 0;*/
            /*transform-origin: 50% 0;*/
            /*box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);*/
            /*background-color: #fff;*/
            /*border-radius: 6px;*/
            /*margin-top: 4px;*/
            /*padding: 3px 0;*/
            /*opacity: 0;*/
            /*overflow: hidden;*/
            /*pointer-events: none;*/
            /*position: absolute;*/
            /*top: 100%;*/
            /*left: 0;*/
            /*z-index: 999;*/
            /*max-height: 250px;*/
            /*overflow: auto;*/
            /*border: 1px solid #ddd;*/
        /*}*/

        /*.dropdown-select .list:hover .option:not(:hover) {*/
            /*background-color: transparent !important;*/
        /*}*/
        /*.dropdown-select .dd-search{*/
            /*overflow:hidden;*/
            /*display:flex;*/
            /*align-items:center;*/
            /*justify-content:center;*/
            /*margin:0.5rem;*/
        /*}*/

        /*.dropdown-select .dd-searchbox{*/
            /*width:90%;*/
            /*padding:0.5rem;*/
            /*border:1px solid #999;*/
            /*border-color:#999;*/
            /*border-radius:4px;*/
            /*outline:none;*/
        /*}*/
        /*.dropdown-select .dd-searchbox:focus{*/
            /*border-color:#12CBC4;*/
        /*}*/

        /*.dropdown-select .list ul {*/
            /*padding: 0;*/
        /*}*/

        /*.dropdown-select .option {*/
            /*cursor: default;*/
            /*font-weight: 400;*/
            /*line-height: 40px;*/
            /*outline: none;*/
            /*padding-left: 18px;*/
            /*padding-right: 29px;*/
            /*text-align: left;*/
            /*transition: all 0.2s;*/
            /*list-style: none;*/
        /*}*/

        /*.dropdown-select .option:hover,*/
        /*.dropdown-select .option:focus {*/
            /*background-color: #f6f6f6 !important;*/
        /*}*/

        /*.dropdown-select .option.selected {*/
            /*font-weight: 600;*/
            /*color: #12cbc4;*/
        /*}*/

        /*.dropdown-select .option.selected:focus {*/
            /*background: #f6f6f6;*/
        /*}*/

        /*.dropdown-select a {*/
            /*color: #aaa;*/
            /*text-decoration: none;*/
            /*transition: all 0.2s ease-in-out;*/
        /*}*/

        /*.dropdown-select a:hover {*/
            /*color: #666;*/
        /*}*/


    </style>

@endsection
