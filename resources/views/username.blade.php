@extends('main')

@section('section')


    <div class="wrapper">
    <!-- nav wrapper -->
    <div class="nav-wrapper">

        <div class="nav-container">
            <div class="nav-second">
                <ul>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                </ul>
            </div><!-- nav second ends-->
        </div><!-- nav container ends -->

    </div><!-- nav wrapper end -->

    <!---Inner wrapper-->
    <div class="inner-wrapper">
        <!-- main container -->
        <div class="main-container">
            <!-- step wrapper-->

            <div class="step-wrapper">
                <div class="step-container" >
                    <form method="post" action="/usernamecheck">
                        @csrf
                        <h2>انتخاب نام کاربری</h2>
                        <div>
                            <input type="text" name="username" placeholder="Username" />
                        </div>
                        <div>
                            @if (Session::has('error'))
                            <ul>
                                <li style="color: red;direction: rtl">{{ Session::get('error') }}</li>
                            </ul>
                            @endif
                        </div>
                        <div>
                            <input type="submit" name="next" value="Next"/>
                        </div>
                    </form>
                </div>
            </div>


        </div><!-- main container end -->

    </div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->

@endsection
