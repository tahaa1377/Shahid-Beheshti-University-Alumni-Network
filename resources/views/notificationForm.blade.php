
<div class="retweet-popup">
    <div class="wrap5">
        <div class="retweet-popup-body-wrap">
            <div class="retweet-popup-heading">
                <h3>اعلان ها</h3>
                <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
            </div>
            <div class="retweet-popup-inner-body">
                <div class="retweet-popup-inner-body-inner">
                    <div class="retweet-popup-comment-wrap">

                            <div >

                                <!--NOTIFICATION WRAPPER FULL WRAPPER-->
                                <div class="notification-full-wrapper" >


                                <? foreach ($records as $record){ ?>

                                <!-- Follow Notification -->
                                    <!--NOTIFICATION WRAPPER-->
                                    <div class="notification-wrapper">
                                        <div class="notification-inner">
                                            <div class="notification-header">


                                                <div class="notification-name" style="direction: rtl">
                                                    <div>
                                                        <span style="text-align: center;font-weight: bold">عنوان خبر :</span>
                                                        <span style="text-align: center"><?=$record->title?></span>
                                                    </div>

                                                    <br>
                                                    <div>
                                                        <span style="text-align: center;font-weight: bold">توضیحات خبر :</span>
                                                        <span style="text-align: center"><?=$record->description?></span>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <span style="text-align: center;font-weight: bold">زمان خبر :</span>
                                                        <span style="text-align: center"><?=$record->notification_on?></span>
                                                    </div>

                                                </div>
                                                <div class="notification-tweet">

                                                </div>

                                            </div>

                                        </div>
                                        <!--NOTIFICATION-INNER END-->
                                    </div>
                                    <!--NOTIFICATION WRAPPER END-->
                                    <!-- Follow Notification -->
                                <?}?>
                                </div>
                                <!--NOTIFICATION WRAPPER FULL WRAPPER END-->

                            </div>
                            <div class="retweet-popup-comment-body"></div>
                    </div>
                </div>
            </div>
            <div class="retweet-popup-footer">
                <div class="retweet-popup-footer-right">
                    <button style="margin: 10px" class="cancel-it f-btn">بستن</button>

                </div>
            </div>
        </div>
    </div>
</div>
