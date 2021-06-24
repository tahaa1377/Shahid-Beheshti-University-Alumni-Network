<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();

        $profile=DB::table('profile')->where('user_id',$_SESSION['user_id'])->first();

        if ($profile == null){
            return view("profile",compact('userz','user_info'));
        }else{
            return view("profile_compelete",compact('userz','user_info','profile'));
        }


    }

    public function profileCheck()
    {

        $profile=DB::table('profile')->where('user_id',$_SESSION['user_id'])->first();

        if ($profile == null){

            ///
            $taha['error']="لطفا فرم را کامل پر کنید .";
            if (!isset($_POST['migrate'])){

                return redirect()->back()->with($taha);
            }
            if (!isset($_POST['job'])){
                return redirect()->back()->with($taha);

            }

            if ( $_POST['job'] == 'employed'){
                if ( !isset($_POST['karmand_karafarin'])){
                    return redirect()->back()->with($taha);
                }
                if (!isset($_POST['job_select'])){
                    return redirect()->back()->with($taha);
                }
                if ($_POST['job_select'] == 'job_rel_no' and (!isset($_POST['job_feild']) or empty($_POST['job_feild']))){
                    return redirect()->back()->with($taha);
                }

                if ($_POST['job_select'] != 'job_rel_yes'){

//                DB::insert("insert into `profile` (`user_id`, `migration_status`, `job_status` , `job_type` ,`job_Education_rel` , `job_name_no_rel`)
//values (?,?,?,?,?,?)",array( $_SESSION['user_id'],$_POST['migrate'],$_POST['job'],$_POST['karmand_karafarin'],0,$_POST['job_feild']));
//
                    DB::table('profile')->insert([
                        'user_id' => $_SESSION['user_id'],
                        'migration_status' => $_POST['migrate'],
                        'job_status' => $_POST['job'],
                        'job_type' => $_POST['karmand_karafarin'],
                        'job_Education_rel' => 0,
                        'job_name_no_rel' => $_POST['job_feild']

                    ]);
                }else{

//                DB::insert("insert into `profile` (`user_id`, `migration_status`, `job_status` , `job_type` ,`job_Education_rel` , `job_name_no_rel`)
//values (?,?,?,?,?)",array( $_SESSION['user_id'],$_POST['migrate'],$_POST['job'],$_POST['karmand_karafarin'],1));

                    DB::table('profile')->insert([
                        'user_id' => $_SESSION['user_id'],
                        'migration_status' => $_POST['migrate'],
                        'job_status' => $_POST['job'],
                        'job_type' => $_POST['karmand_karafarin'],
                        'job_Education_rel' =>1,

                    ]);
                }


            }else{
//            DB::insert("insert into `profile` (`user_id`, `migration_status`, `job_status` )
//values (?,?,?)",array( $_SESSION['user_id'],$_POST['migrate'],$_POST['job']));

                DB::table('profile')->insert([
                    'user_id' => $_SESSION['user_id'],
                    'migration_status' => $_POST['migrate'],
                    'job_status' => $_POST['job'],

                ]);
            }
            ///

        }else{
            //
            $taha['error']="لطفا فرم را کامل پر کنید .";
            if (!isset($_POST['migrate'])){

                return redirect()->back()->with($taha);
            }
            if (!isset($_POST['job'])){
                return redirect()->back()->with($taha);

            }

            if ( $_POST['job'] == 'employed'){
                if ( !isset($_POST['karmand_karafarin'])){
                    return redirect()->back()->with($taha);
                }
                if (!isset($_POST['job_select'])){
                    return redirect()->back()->with($taha);
                }
                if ($_POST['job_select'] == 'job_rel_no' and (!isset($_POST['job_feild']) or empty($_POST['job_feild']))){
                    return redirect()->back()->with($taha);
                }

                if ($_POST['job_select'] != 'job_rel_yes'){

                    DB::table('profile')->where('user_id',$_SESSION['user_id'])->update([
                        'migration_status' => $_POST['migrate'],
                        'job_status' => $_POST['job'],
                        'job_type' => $_POST['karmand_karafarin'],
                        'job_Education_rel' => 0,
                        'job_name_no_rel' => $_POST['job_feild']
                    ]);

                }else{

                    DB::table('profile')->where('user_id',$_SESSION['user_id'])->update([
                        'migration_status' => $_POST['migrate'],
                        'job_status' => $_POST['job'],
                        'job_type' => $_POST['karmand_karafarin'],
                        'job_Education_rel' =>1,
                        'job_name_no_rel' => null,
                    ]);
                }


            }else{


                DB::table('profile')->where('user_id',$_SESSION['user_id'])->update([
                    'migration_status' => $_POST['migrate'],
                    'job_status' => $_POST['job'],
                    'job_type' => null,
                    'job_Education_rel' =>null,
                    'job_name_no_rel' => null,
                ]);
            }
            //


        }


        return redirect('/home');


    }


}
