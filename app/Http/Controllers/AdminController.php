<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function admin_page()
    {

        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }


        $message_count=DB::select("SELECT count(*) as me_count FROM `messages` WHERE messageTo = ?
 AND `status` = 0",array($_SESSION['user_id']));

        $tweets=DB::select("
         SELECT tweets.* , user_info.profileImage, users.username,users.name
         FROM `tweets` LEFT OUTER JOIN `users` ON tweets.tweetBy=users.user_id 
         LEFT OUTER JOIN `user_info` ON tweets.tweetBy=user_info.user_id
         ORDER BY `tweets`.`posedOn` DESC
         ");

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();

        $recomend=DB::select("select DISTINCT `users`.`name`, `users`.`username`, `user_info`.`profileImage` 
from `users` left join `user_info` on `users`.`user_id` = `user_info`.`user_id` left join `follow` on 
`users`.`user_id` = `follow`.`sender` where (`users`.`subEducationGroup` = ? and `users`.`user_id` != ?) 
and `users`.`user_id` not in (select `reciver` from follow where sender=?)"
            ,array($userz->subEducationGroup,$_SESSION['user_id'],$_SESSION['user_id']));


        $tweetCount=DB::select("SELECT COUNT(*) AS tweetcount FROM `tweets` WHERE `tweetBy` = ?",array($_SESSION['user_id']));

        return view('admin.admin-page',compact('message_count','userz','user_info','recomend','tweetCount','tweets'));


    }

    public function Profile_Amoozesh()
    {
        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();
        return view('admin.profile-amoozesh',compact('userz','user_info'));


    }

    public function reportBYstudent()
    {
        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();
        $universitys=DB::table('university')->get();
        $start_years=DB::table('years')->get();
        $reshte=DB::select("SELECT DISTINCT field , subGroup FROM `fieldlist` GROUP BY field ORDER BY
 `fieldlist`.`subGroup` ASC");

        return view('admin.profile-amoozesh-student',compact('userz','user_info','universitys','start_years','reshte'));

    }

    public function reportBYstudentCheck()
    {

        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }



        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();


        $result=DB::select("select * from `users` left join `profile` on 
          `users`.`user_id` = `profile`.`user_id` where
          (`users`.`user_id` =
          (select user_id from users where `users`.`student_number` = ? and `users`.`college` = ? and `users`.`end_date` = ? and `users`.`field` = ?)
           and `users`.`student_number` = ? and `users`.`college` = ? and `users`.`end_date` = ? and `users`.`field` = ?) limit 1",
            array($_POST['reportBYstudent_stuNumber'],$_POST['reg_callage'],$_POST['reg_start_year'],explode("(",$_POST['reshte'])[0],
                $_POST['reportBYstudent_stuNumber'],$_POST['reg_callage'],$_POST['reg_start_year'] , explode("(",$_POST['reshte'])[0]));
//        print_r($result);
        return view('admin.profile-amoozesh-result',compact('result','userz','user_info'));

    }

    public function groupByReport()
    {
        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();

        $universitys=DB::table('university')->get();
        $start_years=DB::table('years')->get();
        $start_years2=DB::table('years')->orderByDesc('year')->get();
        $reshte=DB::select("SELECT DISTINCT field , subGroup FROM `fieldlist` GROUP BY field ORDER BY
 `fieldlist`.`subGroup` ASC");
        return view('admin.profile-amozesh-group',compact('reshte','universitys','userz','user_info','start_years','start_years2'));


    }


    public function totalreports()
    {

//        echo  explode("(",$_POST['reshte'])[1];
//         exit();

//        print_r($_POST);

        if ($_POST['callage'] == 'collage_no_select' and $_POST['reshte'] == 'reshte_no_select'){

            return redirect('/groupByReport');

        }else if ($_POST['callage'] != 'collage_no_select' and $_POST['reshte'] == 'reshte_no_select'){

            //collage

            if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط است'){

$result=DB::select("SELECT users.college, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_Education_rel = 1 and users.college=? and users.end_date
between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id
WHERE (profile.job_status = 'employed') and users.college=? and users.end_date
between ? and ?",array($_POST['callage'],$_POST['start_year'],$_POST['end_year'],
                       $_POST['callage'],$_POST['start_year'],$_POST['end_year']));

            } else

                if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط نیست'){

$result=DB::select("SELECT users.college, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_Education_rel = 0 and users.college=? and users.end_date
between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id
WHERE (profile.job_status = 'employed') and users.college=? and users.end_date
between ? and ?",array($_POST['callage'],$_POST['start_year'],$_POST['end_year'],
                    $_POST['callage'],$_POST['start_year'],$_POST['end_year']));


                }else

                    if ($_POST['customRadio'] == 'دانش آموختگانی که مهاجرت کرده اند'){

$result=DB::select("SELECT users.college, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.migration_status = 'migrate_out' and users.college=? and 
users.end_date between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id 
= users.user_id WHERE (profile.migration_status = 'migrate_out' or profile.migration_status = 'migrate_in') and users.college=? and users.end_date between ? and ?"
                ,array($_POST['callage'],$_POST['start_year'],$_POST['end_year'],
                       $_POST['callage'],$_POST['start_year'],$_POST['end_year']));


                    }else

                    if ($_POST['customRadio'] == 'دانش آموختگانی که کارآفرین هستند'){

$result=DB::select("SELECT users.college, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_type = 'karafarin' and users.college=? and 
users.end_date between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id 
= users.user_id WHERE (profile.job_status = 'employed') and users.college=? and users.end_date between ? and ?"
                ,array($_POST['callage'],$_POST['start_year'],$_POST['end_year'],
                       $_POST['callage'],$_POST['start_year'],$_POST['end_year']));


                    }else

                    if ($_POST['customRadio'] == 'دانش آموختگانی که بیکار هستند'){

$result=DB::select("SELECT users.college, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_status = 'unemployed' and users.college=? and 
users.end_date between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id 
= users.user_id WHERE (profile.job_status = 'employed' or profile.job_status = 'unemployed') and users.college=?
 and users.end_date between ? and ?",array($_POST['callage'],$_POST['start_year'],$_POST['end_year'],
                       $_POST['callage'],$_POST['start_year'],$_POST['end_year']));


                    }





        }else if ($_POST['callage'] == 'collage_no_select' and $_POST['reshte'] != 'reshte_no_select'){


            if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط است'){

$result=DB::select("SELECT users.field, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_Education_rel = 1 and users.field=? and users.end_date
between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id
WHERE (profile.job_status = 'employed') and users.field=? and users.end_date between ? and ?"
                    ,array(explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year'],
                        explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year']));

            } else

                if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط نیست'){

$result=DB::select("SELECT users.field, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_Education_rel = 0 and users.field=? and users.end_date
between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id
WHERE (profile.job_status = 'employed') and users.field=? and users.end_date between ? and ?"
                    ,array(explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year'],
        explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year']));


                }else

                    if ($_POST['customRadio'] == 'دانش آموختگانی که مهاجرت کرده اند'){

$result=DB::select("SELECT users.field, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.migration_status = 'migrate_out' and users.field=? and 
users.end_date between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id 
= users.user_id WHERE (profile.migration_status = 'migrate_out' or profile.migration_status = 'migrate_in')
 and users.field=? and users.end_date between ? and ?"
                            ,array(explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year'],
        explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year']));


                    }else

                        if ($_POST['customRadio'] == 'دانش آموختگانی که کارآفرین هستند'){

$result=DB::select("SELECT users.field, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_type = 'karafarin' and users.field=? and 
users.end_date between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id 
= users.user_id WHERE (profile.job_status = 'employed') and users.field=? and users.end_date between ? and ?"
  ,array(
      explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year'],
      explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year']));


                        }else

                            if ($_POST['customRadio'] == 'دانش آموختگانی که بیکار هستند'){

$result=DB::select("SELECT users.field, (SELECT count(*) AS total FROM users LEFT OUTER JOIN profile ON
profile.user_id = users.user_id WHERE profile.job_status = 'unemployed' and users.field=? and 
users.end_date between ? and ?)* 100 /count(*) AS percent FROM users LEFT OUTER JOIN profile ON profile.user_id 
= users.user_id WHERE (profile.job_status = 'employed' or profile.job_status = 'unemployed') and users.field=?
 and users.end_date between ? and ?"
,array(explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year'],
        explode("(",$_POST['reshte'])[0],$_POST['start_year'],$_POST['end_year']));


                            }




        }else if ($_POST['callage'] != 'collage_no_select' and $_POST['reshte'] != 'reshte_no_select'){
            return redirect('/groupByReport');
        }




        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();

        $subject=$_POST['customRadio'];

//        if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط است'
//            and $_POST['cluster'] == 'دانشکده'){
//
//            $result=DB::select("SELECT t1.college , t2.total * 100 / count(*) AS percent FROM users AS t1 LEFT JOIN
//( SELECT college, count(*) AS total FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id WHERE
// profile.job_Education_rel = 1 AND users.end_date between ? and ? GROUP BY college ) AS t2 ON t1.college =
// t2.college WHERE end_date between ? and ? GROUP BY t1.college ORDER BY `percent` DESC",
//                array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//            //$result=DB::select("SELECT t1.college , t2.total * 100 / count(*) AS percent FROM users AS t1 LEFT JOIN ( SELECT college, count(*) AS total FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id WHERE profile.job_Education_rel = 1 GROUP BY college ) AS t2 ON t1.college = t2.college GROUP BY t1.college ORDER BY `percent` DESC");
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط نیست'
//            and $_POST['cluster'] == 'دانشکده'){
//
//            $result=DB::select("SELECT t1.college , t2.total * 100 / count(*) AS percent FROM users AS t1 LEFT JOIN ( SELECT college, count(*) AS total FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id WHERE profile.job_Education_rel = 0 AND users.end_date between ? and ? GROUP BY college ) AS t2 ON t1.college = t2.college WHERE end_date between ? and ? GROUP BY t1.college ORDER BY `percent` DESC",array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که مهاجرت کرده اند'
//            and $_POST['cluster'] == 'دانشکده'){
//
//            $result=DB::select("SELECT t1.college , t2.total * 100 / count(*) AS percent FROM users AS t1 LEFT JOIN ( SELECT college, count(*) AS total FROM users LEFT OUTER JOIN profile ON profile.user_id = users.user_id WHERE profile.migration_status = 'migrate_out' AND users.end_date between ? and ? GROUP BY college ) AS t2 ON t1.college = t2.college WHERE end_date between ? and ? GROUP BY t1.college ORDER BY `percent` DESC",array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که کارآفرین هستند'
//            and $_POST['cluster'] == 'دانشکده'){
//
//            $result=DB::select("SELECT t1.college , t2.total * 100 / count(*) AS percent FROM users
// AS t1 LEFT JOIN ( SELECT college, count(*) AS total FROM users LEFT OUTER JOIN profile ON
// profile.user_id = users.user_id WHERE profile.job_type = 'karafarin' AND users.end_date
//  between ? and ? GROUP BY college ) AS t2 ON t1.college = t2.college WHERE end_date between ? and ?
//  GROUP BY t1.college ORDER BY `percent` DESC",array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که بیکار هستند'
//            and $_POST['cluster'] == 'دانشکده'){
//
//            $result=DB::select("SELECT t1.college , t2.total * 100 / count(*) AS percent FROM users
//AS t1 LEFT JOIN ( SELECT college, count(*) AS total FROM users LEFT OUTER JOIN profile ON
//profile.user_id = users.user_id WHERE profile.job_status = 'unemployed' AND users.end_date between ? and ? GROUP BY college ) AS t2 ON t1.college = t2.college WHERE end_date between ? and ? GROUP BY t1.college ORDER BY `percent` DESC",array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط است'
//            and $_POST['cluster'] == 'رشته'){
//
//            $result=DB::select("SELECT t1.`field` , t2.total * 100 / count(*) AS percent FROM users
// AS t1 LEFT JOIN ( SELECT `field`, count(*) AS total FROM users LEFT OUTER JOIN profile ON
// profile.user_id = users.user_id WHERE profile.job_Education_rel = 1 AND users.end_date between ? and ?
//  GROUP BY `field` ) AS t2 ON t1.`field` = t2.`field` WHERE end_date between ? and ? GROUP BY t1.`field`
//   ORDER BY `percent` DESC",
//                array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که رشته دانشگاهی و شغل شان مرتبط نیست'
//            and $_POST['cluster'] == 'رشته'){
//
//            $result=DB::select("SELECT t1.`field` , t2.total * 100 / count(*) AS percent FROM users
// AS t1 LEFT JOIN ( SELECT `field`, count(*) AS total FROM users LEFT OUTER JOIN profile ON
// profile.user_id = users.user_id WHERE profile.job_Education_rel = 0  AND users.end_date between ? and ?
//  GROUP BY `field` ) AS t2 ON t1.`field` = t2.`field` WHERE end_date between ? and ? GROUP BY t1.`field`
//   ORDER BY `percent` DESC",
//                array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که مهاجرت کرده اند'
//            and $_POST['cluster'] == 'رشته'){
//
//            $result=DB::select("SELECT t1.`field` , t2.total * 100 / count(*) AS percent FROM users
// AS t1 LEFT JOIN ( SELECT `field`, count(*) AS total FROM users LEFT OUTER JOIN profile ON
// profile.user_id = users.user_id WHERE profile.migration_status = 'migrate_out'  AND users.end_date between ? and ?
//  GROUP BY `field` ) AS t2 ON t1.`field` = t2.`field` WHERE end_date between ? and ? GROUP BY t1.`field`
//   ORDER BY `percent` DESC",
//                array($_POST['start_year'],$_POST['end_year'],$_POST['start_year'],$_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که کارآفرین هستند'
//            and $_POST['cluster'] == 'رشته') {
//
//            $result = DB::select("SELECT t1.`field` , t2.total * 100 / count(*) AS percent FROM users
// AS t1 LEFT JOIN ( SELECT `field`, count(*) AS total FROM users LEFT OUTER JOIN profile ON
// profile.user_id = users.user_id WHERE profile.job_type = 'karafarin' AND users.end_date between ? and ?
//  GROUP BY `field` ) AS t2 ON t1.`field` = t2.`field` WHERE end_date between ? and ? GROUP BY t1.`field`
//   ORDER BY `percent` DESC",
//                array($_POST['start_year'], $_POST['end_year'], $_POST['start_year'], $_POST['end_year']));
//
//        }else if ($_POST['customRadio'] == 'دانش آموختگانی که بیکار هستند'
//            and $_POST['cluster'] == 'رشته') {
//
//            $result = DB::select("SELECT t1.`field` , t2.total * 100 / count(*) AS percent FROM users
// AS t1 LEFT JOIN ( SELECT `field`, count(*) AS total FROM users LEFT OUTER JOIN profile ON
// profile.user_id = users.user_id WHERE profile.job_status = 'unemployed' AND users.end_date between ? and ?
//  GROUP BY `field` ) AS t2 ON t1.`field` = t2.`field` WHERE end_date between ? and ? GROUP BY t1.`field`
//   ORDER BY `percent` DESC",
//                array($_POST['start_year'], $_POST['end_year'], $_POST['start_year'], $_POST['end_year']));
//        }

        if ($_POST['callage'] == 'collage_no_select' and $_POST['reshte'] != 'reshte_no_select'){
            return view('admin.profile-amoozesh-group-result-reshte',compact('subject','userz','user_info','result'));
        }else{
            return view('admin.profile-amoozesh-group-result',compact('subject','userz','user_info','result'));

        }


    }


    public function testing()
    {
        $universitys=DB::table('university')->get();
        return json_encode(array(
            'collage'=>$universitys
        ));

    }

    public function tweetPostadmin(Request $request)
    {

        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }


        request()->validate([
            'file' => 'image|mimes:jpeg,png,jpg',
        ],[
            'file.image' =>'یک عکس آپلود کنید',//ارور اختصاصی

        ]);



        if ( !empty($_POST['status'])  and $_FILES['file']['size'] != 0 ){

            $imagefile= time() . '.' .explode("/",$_FILES['file']['type'])[1];
            DB::insert("INSERT INTO `tweets`(`tweetBy`, `status`, `tweetImage`) VALUES (?,?,?)",
                array($_SESSION['user_id'],$_POST['status'],$imagefile));

            $request->file->move(public_path('tweetImg'), $imagefile);


        }else if (!empty($_POST['status'])  and $_FILES['file']['size'] == 0){

            DB::insert("INSERT INTO `tweets`(`tweetBy`, `status`, `tweetImage`) VALUES (?,?,?)",
                array($_SESSION['user_id'],$_POST['status'],null));

        }else if (empty($_POST['status'])  and $_FILES['file']['size'] != 0){
            $imagefile= time() . '.' .explode("/",$_FILES['file']['type'])[1];

            DB::insert("INSERT INTO `tweets`(`tweetBy`, `status`, `tweetImage`) VALUES (?,?,?)",
                array($_SESSION['user_id'],null,$imagefile));

            $request->file->move(public_path('tweetImg'), $imagefile);

        }else{
            return redirect('/admin');
        }

        return redirect('/admin');

    }

    public function searchUserAdmin()
    {
        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }

        $value=$_POST['search'];
        $value="%$value%";
        $results=DB::select('SELECT * FROM `users` left outer join `user_info` on
        users.user_id=user_info.user_id WHERE `username` LIKE ? and users.user_id <> ? limit 10',
            array($value,$_SESSION['user_id']));

        return view('searchuser',compact('results'));

    }


    public function createNewNews()
    {
        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();
        $universitys=DB::table('university')->get();

        return view('admin.news-amoozesh',compact('userz','user_info','universitys'));

    }

    public function createNewJobFORM()
    {
        if($_SESSION['access'] != 'admin'){
            return redirect('/logout');
        }

        request()->validate([
            'job_title' => 'required',
            'job_description' => 'required',
            'job_callage' => 'required',
        ],[
        ]);


        if ($_POST['job_callage'] == 'all_collages'){
            $universitys=DB::table('university')->get();

            foreach ($universitys as $university){

                 $id_news = DB::table('news')->insertGetId([
                             'title' => $_POST['job_title'],
                             'description' => $_POST['job_description'],
                             'collage' => $university->university_name,
                 ]);


                DB::insert("INSERT INTO notification (`news_id`, `user_id`, `title`, `description`)
                            SELECT t1.news_id ,t2.user_id ,t1.title, t1.description
                            FROM news t1 LEFT outer JOIN users t2
                            ON t1.collage = t2.college
                            WHERE t1.collage = ? and t1.news_id=? and t2.user_id IS NOT NULL",array($university->university_name,$id_news));

            }

        }else{

            $id_news = DB::table('news')->insertGetId([
                'title' => $_POST['job_title'],
                'description' => $_POST['job_description'],
                'collage' => $_POST['job_callage'],
            ]);


            DB::insert("INSERT INTO notification (`news_id`, `user_id`, `title`, `description`)
                            SELECT t1.news_id ,t2.user_id ,t1.title, t1.description
                            FROM news t1 LEFT outer JOIN users t2
                            ON t1.collage = t2.college
                            WHERE t1.collage = ? and t1.news_id=? and t2.user_id IS NOT NULL",
                array($_POST['job_callage'],$id_news));

        }





        return redirect('/admin');

    }

}
