<?php

use yii\helpers\Html; ?>

<h2 class="h22">Create new table</h2>
<br>
<div class="form">
    <?=Html::beginForm('/record/create-next', 'post', ['class' => ''])?>
    <?= Html::tag('p', Html::encode('Enter table name'), ['class' => 'label-new']) ?>
    <?=Html::input('text', 'tableName', '', ['class' => 'form_input']) ?><br><br>
    <?= Html::tag('p', Html::encode('Enter the number of columns'), ['class' => 'label-new']) ?>
    <?=Html::input('text', 'col', '', ['class' => 'form_input']) ?>
    <?=Html::submitButton('Next!')?>
    <?=Html::endForm()?>
</div>
