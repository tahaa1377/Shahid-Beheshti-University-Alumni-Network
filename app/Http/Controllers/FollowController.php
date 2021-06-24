<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{


    public function profileUser($username)
    {

        $userz=DB::table('users')
            ->leftJoin('user_info','users.user_id','=','user_info.user_id')
            ->where('users.username',$username)->first();

        if ($userz->user_id == $_SESSION['user_id']){
            return redirect('/home');
        }

        $tweetCount=DB::select("SELECT COUNT(*) AS tweetcount FROM `tweets` WHERE `tweetBy` = (select user_id from users where username = ?)",array($username));

        $mee=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();

        return view('profileuser',compact('userz','mee','tweetCount'));

    }


    public function follow_it()
    {

        DB::table('follow')->insert(['sender' => $_SESSION['user_id'], 'reciver' => $_POST['follow']]);

        DB::update("UPDATE `user_info` SET `following`=`following` + 1 WHERE `user_id`=?",array($_SESSION['user_id'] ));

        DB::update("UPDATE `user_info` SET `follower`=`follower` + 1 WHERE `user_id`=?",array($_POST['follow']));



    }

    public function unfollow_it()
    {
        DB::table('follow')->where([
            'sender' => $_SESSION['user_id'],
            'reciver' => $_POST['unfollow']
            ])->delete();

        DB::update("UPDATE `user_info` SET `following`=`following` - 1 WHERE `user_id`=?",array($_SESSION['user_id'] ));

        DB::update("UPDATE `user_info` SET `follower`=`follower` - 1 WHERE `user_id`=?",array($_POST['unfollow']));

    }


}
