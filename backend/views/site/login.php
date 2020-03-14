<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
/* @var $categories array */
/* @var $categoryItems array */
/* @var $string array */

use src\Modules\Category\Domain\Entity\Category;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$category_1 = new Category();   //Добавил для реализации формы

?>


<div class="form-category">
    <div>
        <?=Html::beginForm(['site/add-category'], 'post', ['class' => ''])?>
        <b><?= Html::tag('p', Html::encode('This form to added new category'), ['class' => 'label-new']) ?></b>
        <?=Html::input('text', 'category_name', '', ['class' => 'form_input']) ?>
        <?=Html::submitButton('Add category!')?>
        <?=Html::endForm()?>
    </div><br><br>
    <div>
        <?=Html::beginForm(['site/del'], 'post', ['class' => ''])?>
        <b><?= Html::tag('p', Html::encode('This form to deleted category'), ['class' => 'label-new']) ?></b>
        <?= Html::tag('p', Html::encode('Enter name of category:'), ['class' => 'label-new']) ?>
        <?=Html::input('text', 'category_name', '', ['class' => 'form_input']) ?>
        <?=Html::submitButton('Delete category!')?>
        <?=Html::endForm()?>
    </div><br><br>
    <div>
        <?=Html::beginForm(['site/add-category-item'], 'post', ['class' => ''])?>
        <b><?= Html::tag('p', Html::encode('This form to added new item'), ['class' => 'label-new']) ?></b>
        <?= Html::tag('p', Html::encode('Enter items name:'), ['class' => 'label-new']) ?>
        <?=Html::input('text', 'item_name', '', ['class' => 'form_input']) ?>
        <?= Html::tag('p', Html::encode('Enter categories name:'), ['class' => 'label-new']) ?>
        <?=Html::input('text', 'category_name', '', ['class' => 'form_input']) ?>
        <?=Html::submitButton('Add item!')?>
        <?=Html::endForm()?>
    </div><br><br>
    <div>
        <?=Html::beginForm(['site/del-item'], 'post', ['class' => ''])?>
        <b><?= Html::tag('p', Html::encode('Delete item'), ['class' => 'label-new']) ?></b>
        <?= Html::tag('p', Html::encode('Enter name of item:'), ['class' => 'label-new']) ?>
        <?=Html::input('text', 'item_name', '', ['class' => 'form_input']) ?>
        <?=Html::submitButton('Delete item!')?>
        <?=Html::endForm()?>
    </div>
</div>




