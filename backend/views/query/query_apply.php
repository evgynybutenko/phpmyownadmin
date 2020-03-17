<?php

use yii\helpers\Html;
?>

<div class="form">
    <h2 class="h22">Form for using SQL-scripts</h2>
    <div>
        <?=Html::beginForm(['query/execute-query'], 'post', ['class' => ''])?>
        <b><?= Html::tag('p', Html::encode('Enter SQL-script'), ['class' => 'label-new']) ?></b>
        <?=Html::input('text', 'sql_script', '', ['class' => 'form_input']) ?><br><br>
        <p><?=Html::checkbox('sql_script_save')?> &ensp;Click to save sql-script</p><br>
        <br><?=Html::submitButton('Apply script!')?>
        <?=Html::endForm()?>
    </div>
</div>