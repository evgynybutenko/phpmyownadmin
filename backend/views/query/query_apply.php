<?php
/* @var $sysQueries array */

use yii\helpers\Html;


?>

<div class="form">
    <h2 class="h22">Form for using SQL-scripts</h2>
    <div>
        <?=Html::beginForm(['site/add-category'], 'post', ['class' => ''])?>
        <b><?= Html::tag('p', Html::encode('Enter SQL-script'), ['class' => 'label-new']) ?></b>
        <?=Html::input('text', 'sql_script', '', ['class' => 'form_input']) ?>
        <?=Html::submitButton('Apply script!')?>
        <?=Html::submitButton('Save script!')?>
        <?=Html::endForm()?>
    </div>
</div>
