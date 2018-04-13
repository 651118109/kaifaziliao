<div class="right-slide">
    <ul class="right-slide-in">
        <li class="border-ridus">
            <a href="http://p.qiao.baidu.com/cps/chat?siteId=11146976&userId=23090162">
                <img src="./images/right-3.png">
            </a>
        </li>
    </ul>
</div>
<?php
$script_body_rows=$db->query_lists("select * from script where script_level=2 ");
foreach($script_body_rows as $script_body_row)
{
    ?>
    <?=$script_body_row['script_content']?>
    <?php
}
?>