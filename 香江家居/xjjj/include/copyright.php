<div class="jb_copyright">
    <div class="coyright">
        <?=$company_row["company_copyright"]?>&nbsp;<?=$company_row["company_record"]?>
    </div>
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