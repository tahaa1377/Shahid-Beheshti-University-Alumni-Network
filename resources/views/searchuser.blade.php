<div class="nav-right-down-wrap">
    <ul>
<? foreach ($results as $result){ ?>
        <li>
            <div class="nav-right-down-inner" style="padding: 6px 0;">
                <div class="nav-right-down-left">
                    <a href="/profileUser/<?=$result->username?>"><img src="/img/<?=$result->profileImage?>"></a>
                </div>
                <div class="nav-right-down-right">
                    <div class="nav-right-down-right-headline">
                        <a href="/profileUser/<?=$result->username?>"><?=$result->name?>
                        <span>@<?=$result->username?></span></a>
                    </div>
                    <div class="nav-right-down-right-body">

                    </div>
                </div>
            </div>
        </li>
<?}?>
    </ul>
</div>
