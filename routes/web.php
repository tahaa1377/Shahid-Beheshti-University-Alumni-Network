<?php

use Illuminate\Support\Facades\Route;



Route::get('/login', function () {
    return view('login');
});

Route::get('/logout',"AccountController@logout");
Route::get('/register',"AccountController@register");

Route::post('/loginCheck',"AccountController@loginCheck");
Route::post('/registerCheck',"AccountController@registerCheck");

Route::get('/username',"AccountController@username");
Route::post('/usernamecheck',"AccountController@usernamecheck");

Route::get('/myAccount',"AccountController@myAccount");
Route::get('/accountEdit',"AccountController@accountEdit");

Route::post('/editForm',"AccountController@editForm");
Route::post('/editProfileCover',"AccountController@editProfileCover");
Route::post('/editProfileImage',"AccountController@editProfileImage");

Route::get('/profileUser/{username}',"FollowController@profileUser");
Route::post('/follow_it',"FollowController@follow_it");
Route::post('/unfollow_it',"FollowController@unfollow_it");



Route::post('/fetchSubGroup',"AccountController@fetchSubGroup");
Route::post('/fetchField',"AccountController@fetchField");

Route::get('/home',"HomeController@homePage");


Route::get('/myProfile',"ProfileController@myProfile");
Route::post('/profileCheck',"ProfileController@profileCheck");



Route::post('/searchUser',"HomeController@searchUser");
Route::post('/searchUserAdmin',"AdminController@searchUserAdmin");


Route::get('/admin',"AdminController@admin_page");
Route::get('/reportAmoozesh',"AdminController@Profile_Amoozesh");

Route::get('/reportBYstudent',"AdminController@reportBYstudent");
Route::post('/reportBYstudentCheck',"AdminController@reportBYstudentCheck");

Route::get('/groupByReport',"AdminController@groupByReport");

Route::post('/testing',"AdminController@testing");
Route::post('/reportBYgroupCheck',"AdminController@totalreports");


Route::post('/tweetPost',"HomeController@tweetPost");
Route::post('/delete_tweet_id',"HomeController@delete_tweet_id");

Route::post('/tweetPostadmin',"AdminController@tweetPostadmin");

Route::get('/createNewJob',"AdminController@createNewNews");
Route::POST('/createNewJobFORM',"AdminController@createNewJobFORM");


Route::POST('/notificationU',"HomeController@notificationU");

Route::POST('/messagesU',"HomeController@messagesU");

Route::POST('/messagesPage',"HomeController@messagesPage");

Route::POST('/sendMsg',"HomeController@sendMsg");

Route::POST('/submessagesPage',"HomeController@submessagesPage");

Route::POST('/chatsearchUser',"HomeController@chatsearchUser");

Route::POST('/update_msg_count',"HomeController@update_msg_count");

Route::get('/editInfo',"HomeController@editInfo");
Route::POST('/editInfoCheck',"HomeController@editInfoCheck");

