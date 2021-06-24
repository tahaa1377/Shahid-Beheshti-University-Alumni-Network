
    <?foreach ($messages as $message){?>
    <div class="people-message" data-userid="<?=$message->user_id?>">
        <div class="people-inner">
            <div class="people-img">
                <img src="img/<?=$message->profileImage?>"/>
            </div>
            <div class="name-right2">
                <span><a href="#"><?=$message->name?></a></span><span>@<?=$message->username?></span>
            </div>

            <span></span>
        </div>
    </div>
    <?}?>

