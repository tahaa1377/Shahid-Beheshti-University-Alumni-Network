<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{


    public function loginCheck(Request $request)
    {


        request()->validate([
            'login_email' => 'required|email',
            'login_password' => 'required|min:5',
        ],[
            'login_email.required' =>'ایمیل نباید خالی باشد',//ارور اختصاصی
            'login_email.email' =>'لطفا یک ایمیل صحیح وارد کنید',//ارور اختصاصی
            'login_password.required' =>'رمز عبور نباید خالی باشد',//ارور اختصاصی
            'login_password.min' =>'رمز عبور نباید کمتر از پنج حرف باشد',//ارور اختصاصی

        ]);


        $email= $request->login_email;
        $password=$request->login_password;


        $bool=DB::select("SELECT * FROM `users` WHERE `email`=?",array($email));

        if ($bool == null){
            $taha['login_error']="ایمیل شما در سیستم وجود ندارد";
            return redirect('/login')->with($taha);
        }else {

            if ($bool[0]->password != md5($password)) {
                $taha['login_error'] = "رمز عبور شما اشتباه است";
                return redirect('/login')->with($taha);
            } else {
                $_SESSION['user_id'] = $bool[0]->user_id;
                $_SESSION['access'] = $bool[0]->access;
                $_SESSION['subEducationGroup'] = $bool[0]->subEducationGroup;


                if ($_SESSION['access'] == 'admin') {
                    return redirect('admin');
                }else{

                    $username=DB::table('users')->where('user_id',$_SESSION['user_id'])
                        ->select('username')->first();

                    if ($username->username == null){
                        return redirect('/username');
                    }else{
                        return redirect('/home');

                    }

                }


            }
        }

    }

    public function register()
    {


        $educationGroups=DB::table('fieldlist')->select('educationGroup')->distinct()->get();

        $start_years=DB::table("years")->get();
        $end_years=DB::table("years")->get();

        $universitys=DB::table('university')->get();

        return view('register',compact('educationGroups','start_years','end_years','universitys'));

    }




    public function registerCheck()
    {

        request()->validate([
            'reg_na' => 'required|min:2',
            'reg_family' => 'required|min:3',
            'reg_end_year' => 'required|not_in:سال فارغ التحصیلی',
            'reg_start_year' => 'required|not_in:سال ورود',
            'reg_student_number' => 'required',
            'reg_univercity' => 'required|not_in:رشته',
            'reg_Academic_orientation' => 'required|not_in:زیرگروه تحصیلی',
            'reg_Field' => 'required|not_in:گروه تحصیلی',
            'reg_callage' => 'required|not_in:دانشکده',
            'reg_student_phone_number' => 'required|min:11|max:11',
            'reg_email' => 'required|email',
            'reg_password' => 'required|min:3',
            'reg_password_again' => 'required|min:3|same:reg_password',
        ],[
            'reg_na.required' =>'نام خود را وارد کنید',//ارور اختصاصی
            'reg_na.min' =>'نام نباید کمتر از دو حرف باشد',//ارور اختصاصی
            'reg_family.required' =>'نام خانوادگی خود را وارد کنید',//ارور اختصاصی
            'reg_family.min' =>'نام خانوادگی نباید کمتر از سه حرف باشد',//ارور اختصاصی
            'reg_end_year.not_in' =>'یک سال را انتخاب کنید',//ارور اختصاصی
            'reg_start_year.not_in' =>'یک سال را انتخاب کنید',//ارور اختصاصی
            'reg_student_number.required' =>'شماره دانشجویی خود را وارد کنید',//ارور اختصاصی
            'reg_univercity.required' =>'یک رشته را انتخاب کنید',//ارور اختصاصی
            'reg_callage.required' =>'یک رشته را انتخاب کنید',//ارور اختصاصی
            'reg_univercity.not_in' =>'یک رشته را انتخاب کنید',//ارور اختصاصی
            'reg_callage.not_in' =>'یک دانشکده را انتخاب کنید',//ارور اختصاصی
            'reg_Field.required' =>'یک گروه تحصیلی را انتخاب کنید',//ارور اختصاصی
            'reg_Field.not_in' =>'یک گروه تحصیلی را انتخاب کنید',//ارور اختصاصی
            'reg_Academic_orientation.required' =>'یک زیرگروه تحصیلی را انتخاب کنید',//ارور اختصاصی
            'reg_Academic_orientation.not_in' =>'یک زیرگروه تحصیلی را انتخاب کنید',//ارور اختصاصی
            'reg_student_phone_number.required' =>'شماره تلفن خود را وارد کنید',      //ارور اختصاصی
            'reg_student_phone_number.min' =>'لطفا شماره تلفن درستی وارد کنید',      //ارور اختصاصی
            'reg_email.required' =>'ایمیل خود را وارد کنید',      //ارور اختصاصی
            'reg_email.email' =>'لطفا یک ایمیل صحیح وارد کنید',//ارور اختصاصی
            'reg_password.required' =>'رمز عبور نباید خالی باشد',//ارور اختصاصی
            'reg_password.min' =>'رمز عبور نباید کمتر از سه حرف باشد',        //ارور اختصاصی
            'reg_password_again.min' =>'رمز عبور نباید کمتر از سه حرف باشد',        //ارور اختصاصی
            'reg_password_again.required' =>'رمز عبور نباید خالی باشد',        //ارور اختصاصی
            'reg_password_again.same' =>'دو رمز عبور با هم مشابه نیستند',        //ارور اختصاصی

        ]);


        $name=$_POST['reg_na'];
        $reg_family=$_POST['reg_family'];
        $reg_end_year=$_POST['reg_end_year'];
        $reg_start_year=$_POST['reg_start_year'];
        $reg_student_number=$_POST['reg_student_number'];
        $reg_univercity=$_POST['reg_univercity'];
        $reg_Academic_orientation=$_POST['reg_Academic_orientation'];
        $reg_Field=$_POST['reg_Field'];
        $reg_callage=$_POST['reg_callage'];
        $reg_student_phone_number=$_POST['reg_student_phone_number'];
        $reg_email=$_POST['reg_email'];
        $reg_password=$_POST['reg_password'];


        $email_result=DB::table('users')->where('email',$reg_email)->first();

        if ($email_result == null){

            DB::insert('INSERT INTO `users`(`name`, `family`, `student_number`, `arrival_date`, `end_date`, `educationGroup`, `subEducationGroup`, `field`, `college`, `phone_number`, `email`, `password`)
 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)',array($name,$reg_family,$reg_student_number,$reg_start_year,$reg_end_year,$reg_Field,$reg_Academic_orientation,$reg_univercity,$reg_callage,$reg_student_phone_number,$reg_email,md5($reg_password)));

            $email=DB::table('users')->where('email',$reg_email)->first();
            $_SESSION['user_id']=$email->user_id;
            $_SESSION['access']='user';
            $_SESSION['subEducationGroup'] = $email->subEducationGroup;

            DB::insert('INSERT INTO `user_info`(`user_id`, `profileImage`, `profileCover`)
               VALUES (?,?,?)',array($email->user_id,'defultProfile.jpg','defaultCoverImage.png'));

            DB::insert("INSERT INTO `messages`(`message`, `messageFrom`, `messageTo`) VALUES (?,?,?)",
                array("سلام . برای ارتباط با دانشگاه از این طریق میتوانید اقدام کنید",6,$email->user_id));

            return redirect('/username');

        }else{

            $taha['error']="ایمیل شما در سیستم موجود است";
            return redirect('/register')->with($taha);
        }


    }


    public function username()
    {

        if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])){

            $username_record=DB::table('users')->where('user_id',$_SESSION['user_id'])
                ->select('username')->first();

            if ($username_record->username == null){
                return view('/username');
            }else{
                return redirect('/home');
            }

        }else{
            return redirect('/register');
        }




    }

    public function usernamecheck()
    {

        request()->validate([
            'username' => 'required',

        ],[

        ]);

        //check before user this username

        $username_record=DB::table('users')->where('username',$_POST['username'])->first();


        if ($username_record != null){
            $taha['error']="این نام کاربری قبلا توسط شخص دیگری استفاده شده. از نام کاربری دیگری استفاده کنید.";
            return redirect('/username')->with($taha);
        }else{

            DB::table('users')->where('user_id', $_SESSION['user_id'])->update([
               'username' => $_POST['username']
            ]);

            return redirect('/home');


        }



    }





    public function logout()
    {

        session_destroy();
        return redirect('/login');

    }


    public function fetchSubGroup()
    {
        $subGroups=DB::table('fieldlist')->where('educationGroup',$_POST['educationGroup'])
            ->select('subGroup')->distinct()->get();

        echo json_encode(array(
            'subGroup'=>$subGroups
        ));


    }

    public function fetchField()
    {
        $fields=DB::table('fieldlist')->where('subGroup',$_POST['subEducationGroup'])
            ->select('field')->distinct()->get();

        echo json_encode(array(
            'field'=>$fields
        ));

    }


    public function myAccount()
    {

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();


//
//        $revivers=DB::table('follow')->where('sender',$_SESSION['user_id'])
//            ->pluck('reciver')->toArray();
//
//
//        $revivers[]=0;
////        $followrs=DB::table('users')
////            ->leftJoin('user_info','users.user_id','=','user_info.user_id')
////            ->leftJoin('follow','users.user_id','=','follow.sender')
////            ->where([
////                ['users.subEducationGroup',$userz->subEducationGroup],
////                ['users.user_id','!=',$_SESSION['user_id']],
////            ])
////            ->whereIn('users.user_id',[$revivers])
////            ->select(['users.name','users.username','user_info.profileImage'])
////            ->get();

        $followrs=DB::select("select `users`.`name`, `users`.`username`, `user_info`.`profileImage` 
from `users` left join `user_info` on `users`.`user_id` = `user_info`.`user_id` left join `follow` on 
`users`.`user_id` = `follow`.`sender` where (`users`.`subEducationGroup` = ? and `users`.`user_id` != ?) 
and `users`.`user_id` in (select `reciver` from follow where sender=?)",array($userz->subEducationGroup,$_SESSION['user_id'],$_SESSION['user_id']));

        return view('myaccount',compact('user_info','userz','followrs'));

    }


    public function accountEdit()
    {
        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();
        return view('accountedit',compact('user_info','userz'));

    }

    public function editForm()
    {

       DB::table('users')->where('user_id',$_SESSION['user_id'])->update([
           'name' =>$_POST['screenName']
       ]);

        DB::table('user_info')->where('user_id',$_SESSION['user_id'])->update([
            'bio' =>$_POST['bio']
        ]);

        return redirect('/myAccount');
    }

    public function editProfileCover(Request $request)
    {
        request()->validate([
            'profileCover' => 'image|mimes:jpeg,png,jpg',
        ]);

        $imageName = time() . '.' . $request->profileCover->getClientOriginalExtension();

        $profcover=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->select('profileCover')->first();

        if ($profcover->profileCover != 'defaultCoverImage.png') {
            unlink('img/' . $profcover->profileCover);
        }

        DB::table('user_info')->where('user_id',$_SESSION['user_id'])->update([
            'profileCover' => $imageName
        ]);


        $request->profileCover->move(public_path('img'), $imageName);

        return redirect()->back();
    }

    public function editProfileImage(Request $request)
    {

        request()->validate([
            'profileImage' => 'image|mimes:jpeg,png,jpg',
        ]);

        $imageName = time() . '.' . $request->profileImage->getClientOriginalExtension();

        $profcover=DB::table('user_info')->where('user_id',$_SESSION['user_id'])
            ->select('profileImage')->first();

        if ($profcover->profileImage != 'defultProfile.jpg'){
            unlink('img/'.$profcover->profileImage);
        }


        DB::table('user_info')->where('user_id',$_SESSION['user_id'])->update([
            'profileImage' => $imageName
        ]);


        $request->profileImage->move(public_path('img'), $imageName);

        return redirect()->back();


    }



}
