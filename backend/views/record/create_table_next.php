<?php

/* @var $col string */
/* @var $tableName string */

$rowsLast = [];
$url = "/record/create-last?tableName=".$tableName;
use yii\helpers\Html; ?>

<h2 class="h22">Specify field names and types in <?=$tableName?> table</h2>
<div class="form">
<?=Html::beginForm($url, 'post', ['class' => ''])?>
<?php
for($i = 1; $i <= $col; $i++)
{
    $rows = [];

    echo "
    <p>Enter columns name</p>
    <input type='text' name='names[]' class='form_input'>
    &nbsp;&nbsp;Type:&nbsp;&nbsp;
    <select name='type[]'>
       <option value='INT'>INT</option>
       <option value='VARCHAR'>VARCHAR</option>
       <option value='TEXT'>TEXT</option>
       <option value='BOOLEAN'>BOOLEAN</option>
    </select>
    &nbsp;&nbsp;Index:&nbsp;&nbsp;
    <select name='index[]'>
       <option value='null'>NONE</option>
       <option value='PRIMARY'>PRIMARY</option>
    </select>
    ";
}
?>
<br><br><?=Html::submitButton('Create!')?>
<?=Html::endForm()?>
</div>