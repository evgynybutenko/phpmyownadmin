<?php

/* @var $columns array */
/* @var $name string */

$url = "/record/save?name=".$name;
$url_del = "/record/delete?name=".$name;
$attributes = array_keys($columns[0]->getAttributes());

use yii\helpers\Html; ?>

<h2 class="h22">Table: <?= $name?></h2>

<table border="2" class="table table-striped">
    <tr>
    <?php
        foreach ($attributes as $attribute) {
            echo "
                <th>{$attribute}</th>
            ";
        }
    ?>
    </tr>
    <?php
        foreach ($columns as $item)
        {
            echo "<tr>";
            foreach ($attributes as $attribute)
            {
                echo "<td>{$item->$attribute}</td>";
            }
            echo "</tr>";
        }
    ?>
</table>

<div class="form">
    <?=Html::beginForm($url, 'post', ['class' => ''])?>
    <b><?= Html::tag('p', Html::encode('Add new item to table'), ['class' => 'label-new']) ?></b>

    <?php
    foreach ($attributes as $attribute)
    {
        echo "
        <p>Enter {$attribute}</p>";
//        if ($attribute == 'id')
//        {
//            echo "(не обязательное поле)<br>";
//        }
        echo "<input type='text' name='{$attribute}' class='form_input'>
        ";
    }
    ?>
    <?=Html::submitButton('Add!')?>
    <?=Html::endForm()?>
    <br>
    <?=Html::beginForm($url_del, 'post', ['class' => ''])?>
    <b><?= Html::tag('p', Html::encode('Deleting item from table'), ['class' => 'label-new']) ?></b>
    <?= Html::tag('p', Html::encode('Enter items id'), ['class' => 'label-new']) ?>
    <?=Html::input('text', 'id', '', ['class' => 'form_input']) ?>
    <?=Html::submitButton('Delete!')?>
    <?=Html::endForm()?>
</div>
