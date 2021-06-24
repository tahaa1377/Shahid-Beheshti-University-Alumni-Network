<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function homePage()
    {

        $notification_count=DB::select("SELECT count(*) as no_count FROM `notification` WHERE user_id =
 ? AND `seen` = 0",array($_SESSION['user_id']));

        $message_count=DB::select("SELECT count(*) as me_count FROM `messages` WHERE messageTo = ?
 AND `status` = 0",array($_SESSION['user_id']));


        $tweets=DB::select("
         SELECT tweets.* , user_info.profileImage, users.username,users.name
         FROM `tweets` LEFT OUTER JOIN `users` ON tweets.tweetBy=users.user_id 
         LEFT OUTER JOIN `user_info` ON tweets.tweetBy=user_info.user_id 
         where users.user_id=?
         OR tweets.tweetBy IN (SELECT follow.reciver FROM follow WHERE follow.sender=?)
         or `users`.`access` = 'admin' 
         ORDER BY `tweets`.`posedOn` DESC",
         array($_SESSION['user_id'],$_SESSION['user_id']));

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();

        $recomend=DB::select("select DISTINCT `users`.`name`, `users`.`username`, `user_info`.`profileImage` 
from `users` left join `user_info` on `users`.`user_id` = `user_info`.`user_id` left join `follow` on 
`users`.`user_id` = `follow`.`sender` where (`users`.`subEducationGroup` = ? and `users`.`user_id` != ?) 
and `users`.`user_id` not in (select `reciver` from follow where sender=?) "
            ,array($userz->subEducationGroup,$_SESSION['user_id'],$_SESSION['user_id']));

        $profile=DB::table('profile')->where('user_id',$_SESSION['user_id'])->first();

        $tweetCount=DB::select("SELECT COUNT(*) AS tweetcount FROM `tweets` WHERE `tweetBy` = ?",array($_SESSION['user_id']));

        return view('home',compact('notification_count','userz','user_info',
            'recomend','profile','tweetCount','tweets','message_count'));
    }


    public function searchUser()
    {
        $value=$_POST['search'];
        $value="%$value%";
        $results=DB::select('SELECT * FROM `users` left outer join `user_info` on
        users.user_id=user_info.user_id WHERE `subEducationGroup`=? and `username` LIKE ? and users.user_id <> ?',
            array($_SESSION['subEducationGroup'],$value,$_SESSION['user_id']));

        return view('searchuser',compact('results'));

    }

    public function chatsearchUser()
    {
        $value=$_POST['search'];
        $value="%$value%";
        $messages=DB::select('SELECT * FROM `users` left outer join `user_info` on
        users.user_id=user_info.user_id WHERE `subEducationGroup`=? and `username` LIKE ? and users.user_id <> ?',
            array($_SESSION['subEducationGroup'],$value,$_SESSION['user_id']));

        return view('chat_serch_user',compact('messages'));
    }


    public function tweetPost(Request $request)
    {
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
           return redirect('/home');
        }

        return redirect('/home');

    }

    public function delete_tweet_id()
    {

        $post=DB::table('tweets')->where('tweet_id',$_POST['tweet_id'])->first();

        if ($post->tweetImage != null){
            unlink('tweetImg/' . $post->tweetImage);
        }

        DB::table('tweets')->where('tweet_id',$_POST['tweet_id'])->delete();

    }


    public function notificationU()
    {

        DB::table('notification')->where('user_id',$_SESSION['user_id'])->update([
             'seen'=>1
            ]);

        $records=DB::table('notification')->where('user_id',$_SESSION['user_id'])
            ->orderByDesc('notification_on')->get();

        return view('notificationForm',compact('records'));


    }


    public function messagesU()
    {


        $messages=DB::select("SELECT * FROM users LEFT OUTER JOIN user_info ON 
users.user_id=user_info.user_id WHERE users.user_id IN (SELECT messageFrom FROM messages WHERE messageTo=?
 ORDER BY messages.messageOn)",array($_SESSION['user_id']));

        return view('messageform',compact('messages'));

    }


    public function messagesPage()
    {

        $user_id=$_POST['userid'];

        $user_info=DB::select("SELECT users.name , users.family , user_info.profileImage , users.user_id FROM `users` 
LEFT OUTER JOIN user_info ON users.user_id=user_info.user_id WHERE users.user_id=?
",array($user_id));

        $messages=DB::select("SELECT messages.message_id , messages.messageFrom , messages.message ,  messages.messageOn ,
 user_info.profileImage FROM `messages` LEFT OUTER JOIN user_info ON messageFrom=user_info.user_id WHERE
  (messageFrom = ? AND messageTo= ?) OR (messageFrom = ? AND messageTo= ?) ORDER BY messages.messageOn",
            array($_SESSION['user_id'],$user_id,$user_id,$_SESSION['user_id']));

        return view('messagesPage',compact('messages','user_info'));


    }


    public function submessagesPage()
    {

        $user_id=$_POST['userid'];

        DB::table('messages')->where([
            ['messageFrom',$user_id],
            ['messageTo',$_SESSION['user_id']]
        ])->update([
           'status' => 1
        ]);

        $messages=DB::select("SELECT messages.message_id , messages.messageFrom , messages.message , 
 messages.messageOn , user_info.profileImage FROM `messages` LEFT OUTER JOIN user_info ON 
 messageFrom=user_info.user_id WHERE(messageFrom = ? AND messageTo= ?) OR (messageFrom = ? AND messageTo= ?)
  ORDER BY messages.messageOn",
            array($_SESSION['user_id'],$user_id,$user_id,$_SESSION['user_id']));

        return view('submessagepage',compact('messages'));


    }

    public function update_msg_count()
    {
        $message_count=DB::select("SELECT count(*) as me_count FROM `messages` WHERE messageTo = ?
 AND `status` = 0",array($_SESSION['user_id']));

        echo json_encode(['count' => $message_count[0]->me_count]);

    }

    public function sendMsg(Request $request)
    {

        if ($_POST['text']==null and $_FILES['file']['size'] == 0){
            print_r("null");
        }else{

            if ($_POST['text'] != null and $_FILES['file']['size'] == 0){

                DB::insert("INSERT INTO `messages`(`message`, `messageFrom`, `messageTo`)
 VALUES (?,?,?)",array($_POST['text'],$_SESSION['user_id'],$_POST['msgTo']));

            }else if ($_POST['text'] == null and $_FILES['file']['size'] != 0){

                $imagefile= time() . '.' .explode("/",$_FILES['file']['type'])[1];

                DB::insert("INSERT INTO `messages`(`message`, `messageFrom`, `messageTo`)
 VALUES (?,?,?)",array($imagefile,$_SESSION['user_id'],$_POST['msgTo']));

                $request->file->move(public_path('chatimg'), $imagefile);

            }else{

                DB::insert("INSERT INTO `messages`(`message`, `messageFrom`, `messageTo`)
 VALUES (?,?,?)",array($_POST['text'],$_SESSION['user_id'],$_POST['msgTo']));

                $imagefile= time() . '.' .explode("/",$_FILES['file']['type'])[1];

                DB::insert("INSERT INTO `messages`(`message`, `messageFrom`, `messageTo`)
 VALUES (?,?,?)",array($imagefile,$_SESSION['user_id'],$_POST['msgTo']));

                $request->file->move(public_path('chatimg'), $imagefile);
            }


        }


    }

    public function editInfo()
    {

        $userz=DB::table('users')->where('user_id',$_SESSION['user_id'])->first();
        $user_info=DB::table('user_info')->where('user_id',$_SESSION['user_id'])->first();


        return view("password", compact('userz','user_info'));

    }

    public function editInfoCheck()
    {

        request()->validate([
            'phone_number' => 'required|min:11|max:11',
            'emailing' => 'required|email'
            ]);


        $email=$_POST['emailing'];
        $phone_number=$_POST['phone_number'];

        $res=DB::table('users')->where('email' , $email)->first();
        if ($res == null){
            DB::table('users')->where('user_id' , $_SESSION['user_id'])->update([
                'email' => $email
            ]);
        }

        $res=DB::table('users')->where('phone_number' , $phone_number)->first();
        if ($res == null){
            DB::table('users')->where('user_id' , $_SESSION['user_id'])->update([
                'phone_number' => $phone_number
            ]);
        }

        return redirect('/editInfo');
    }

}
