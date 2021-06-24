@extends('main')

@section('section')



    <body>
    <div class="main fonting">
        <p class="sign" align="center">سامانه دانش آموختگان دانشگاه شهید بهشتی</p>
        @if (Session::has('sign_error'))
            <div class="alert alert-danger fonting">{{ Session::get('sign_error') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger fonting" style="direction: rtl">{{ Session::get('error') }}</div>
        @endif
        <form class="form1" action="/registerCheck" method="post">
            @csrf
            <div class="row_responsive">

                <div class="colx-4">
                    <input class="un " type="text" align="center" name="reg_family" value="{{old('reg_family')}}" placeholder="نام خانوادگی">
                    <div class="alert-danger fonting">{{$errors->first('reg_family')}}</div>
                </div>
                <div class="colx-4">
                    <input class="un " type="text" align="center" name="reg_na" value="{{old('reg_na')}}" placeholder="نام">
                    <div class="alert-danger fonting">{{$errors->first('reg_na')}}</div>
                </div>


            </div>
            <br>


            <div class="row">
                <div class="col-4">

                    <select name="reg_end_year" class="un" >

                        <option>سال فارغ التحصیلی</option>
                        <? foreach ($end_years as $end_year){ ?>
                        <option value="<?=$end_year->year?>" @if (old('reg_end_year') == $end_year->year) selected="selected" @endif><?=$end_year->year?></option>
                        <?}?>


                    </select>
                    <div class="alert-danger fonting">{{$errors->first('reg_end_year')}}</div>

                    <br>
                </div>
                <div class="col-4">
                    <select name="reg_start_year" class="un" >

                        <option>سال ورود</option>
                        <? foreach ($start_years as $start_year){ ?>
                        <option value="<?=$start_year->year?>"
                                {{ old('reg_start_year') == $start_year->year ? 'selected' : '' }}>
                        <?=$start_year->year?></option>
                     <?}?>
                    </select>
                    <div class="alert-danger fonting">{{$errors->first('reg_start_year')}}</div>

                    <br>
                </div>
                <div class="col-4">
                    <input class="un " type="number" align="center" name="reg_student_number" value="{{old('reg_student_number')}}" placeholder="شماره دانشجویی">
                    <div class="alert-danger fonting">{{$errors->first('reg_student_number')}}</div>
                    <br>
                </div>

            </div>

            <div class="row_responsive" >


                <div class="colx-4">
                    <select style="direction: rtl" id="reg_Academic_orientation" name="reg_Academic_orientation" class="un" >


                        <option>زیرگروه تحصیلی</option>


                    </select>
                    <div class="alert-danger fonting">{{$errors->first('reg_Academic_orientation')}}</div>

                    <br>
                </div>
                <div class="colx-4">

                    <select style="direction: rtl" id="reg_Field" name="reg_Field" class="un">


                        <option>گروه تحصیلی</option>
                        <? foreach ($educationGroups as $educationGroup){ ?>
                        <option value="<?=$educationGroup->educationGroup?>"
{{--                                {{ old('reg_Field') == $educationGroup->educationGroup ? 'selected' : '' }}>--}}
                           ><?=$educationGroup->educationGroup?></option>
                        <?}?>


                    </select>
                    <div class="alert-danger fonting">{{$errors->first('reg_Field')}}</div>

                    <br>
                </div>



            </div>

            <div class="row_responsive">
                <div class="colx-4">
                    <select style="direction: rtl" id="reg_callage" name="reg_callage" class="un" >


                        <option>دانشکده</option>
                        <? foreach ($universitys as $university){ ?>
                        <option value="<?=$university->university_name?>"
                                {{ old('reg_callage') == $university->university_name ? 'selected' : '' }}>
                            <?=$university->university_name?></option>
                        <?}?>

                    </select>
                    <div class="alert-danger fonting">{{$errors->first('reg_callage')}}</div>

                    <br>
                </div>
                <div class="colx-4">
                    <select style="direction: rtl" id="reg_univercity" name="reg_univercity" class="un">

                        <option style="float: right">رشته</option>


                    </select>
                    <div class="alert-danger fonting">{{$errors->first('reg_univercity')}}</div>

                    <br>
                </div>
            </div>



            <div class="row_responsive">

                <div class="colx-4">
                    <input class="un " type="email" align="center" name="reg_email" value="{{old('reg_email')}}" placeholder="ایمیل">
                    <div class="alert-danger fonting">{{$errors->first('reg_email')}}</div>
                    <br>
                </div>
                <div class="colx-4">
                    <input class="un " type="number" align="center" name="reg_student_phone_number" value="{{old('reg_student_phone_number')}}" placeholder="شماره موبایل">
                    <div class="alert-danger fonting">{{$errors->first('reg_student_phone_number')}}</div>
                    <br>
                </div>
            </div>

            <div class="row_responsive">

                <div class="colx-4">

                    <input class="pass" type="password" align="center" name="reg_password_again" {{old('reg_password_again')}} placeholder="تکرار گذرواژه"><br>
                    <div class="alert-danger fonting">{{$errors->first('reg_password_again')}}</div>
                    <br>
                </div>
                <div class="colx-4">
                    <input class="pass" type="password" align="center" name="reg_password" value="{{old('reg_password')}}" placeholder="گذرواژه"><br>
                    <div class="alert-danger fonting">{{$errors->first('reg_password')}}</div>
                    <br>
                </div>
            </div>
            <input type="submit" class="submit" style="color: white;outline: none;" value="ثبت نام"><br><br>
        </form>
        <p class="forgot" ><a href="/login">ورود کاربر</a></p>


    </div>

    </body>

@endsection

@section('js')
    <script src="/js/defineFeild.min.js?9"></script>


@endsection

@section("css")

    <style>

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        body {

            background-image: url("/img/1.jpg");
            background-color: #cccccc;

            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .main {
            background-color: #FFFFFF;
            padding-bottom: 10px;
            width: 75%;
            margin: 2em auto;
            border-radius: 1.5em;
            box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
        }

        .sign {
            padding-top: 40px;
            color: #8C55AA;
            font-weight: bold;
            font-size: 20px;
        }

        .un {
            width: 95%;
            text-align: center;
            color: rgb(0, 0, 0);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            /*margin-bottom: 50px;*/

            text-align: center;
            /*margin-bottom: 27px;*/
        }



        form.form1 {
            padding-top: 20px;
        }

        .pass {
            width: 90%;
            color: rgb(38, 50, 56);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            /*margin-bottom: 50px;*/

            text-align: center;
            /*margin-bottom: 27px;*/
        }


        .un:focus, .pass:focus {
            border: 2px solid rgba(0, 0, 0, 0.18) !important;

        }

        .submit {
            cursor: pointer;
            border-radius: 5em;
            color: #ffffff;
            background: linear-gradient(to right, #c329d7, #E040FB);
            border: 0;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 10px;
            padding-top: 10px;

            font-size: 14px;
            box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
        }

        .forgot {
            text-shadow: 0px 0px 3px rgba(24, 24, 24, 0.12);
            color: #E1BEE7;

        }

        a {
            text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
            color: #5f5364;
            text-decoration: none
        }

        @media (max-width: 600px) {
            .main {
                border-radius: 0px;
            }
        }
    </style>


@endsection
