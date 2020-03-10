<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
/* @var $categories array */
/* @var $categoryItems array */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="accordion">
<?php
$mass = [];
foreach ($categories as $category) {

    echo "
    <div class=\"trigger\">
        <input type=\"checkbox\" id=\"checkbox-{$category->id}\" name=\"checkbox-{$category->id}\" />
        <label for=\"checkbox-{$category->id}\" class=\"checkbox\">
            {$category->category_name} <i></i>
        </label>
        <div class=\"content\">
            <ul>";
                for($i = 0; $i < count($categoryItems); $i++)
                {
                    if($categoryItems[$i]->id_category === $category->id)
                    {
                        echo "
                            <a id=\"ul_a\"><li>{$categoryItems[$i]->item_name}</li></a>
                        ";
                    }
                }
    echo "  </ul>
        </div>
    </div>";
}
?>
</div>
