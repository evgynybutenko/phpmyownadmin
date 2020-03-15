<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


$categories = Yii::$app->view->params['categories'];
$categoryItems = Yii::$app->view->params['categoryItems'];
$itemUrl = Yii::$app->view->params['itemUrl'];

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody()

?>
<h1>PHP Myownadmin</h1>
<div class="wrap">

    <div class="accordion">
        <?php
        foreach ($categories as $category) {
            echo "
    <div class=\"trigger\">
        <input type=\"checkbox\" id=\"checkbox-{$category->id}\" name=\"checkbox-{$category->id}\" />
        <label for=\"checkbox-{$category->id}\" class=\"checkbox\">
            {$category->category_name} <i></i>
        </label>
        <div class=\"content\">
            <ul>";
            foreach ($categoryItems as $categoryItem) {
                if($categoryItem->id_category == $category->id) // Поиск соответствия по id категории и item
                {
                    $j = 0;
                    foreach ($itemUrl as $item)
                    {
                        $j++;
                        if($item->item_name == $categoryItem->item_name)
                        {
                            echo "
                            <a href='{$item->url}' id=\"ul_a\"><li>{$categoryItem->item_name}</li></a>
                        ";
                            break;
                        }
                        if($j == count($itemUrl))  // Если не находит соответствия по url то выполняется данный иф
                        {
                            echo "
                            <a id=\"ul_a\"><li>{$categoryItem->item_name}</li></a>
                        ";
                            break;
                        }
                    }
                }
            }
            echo "  </ul>
        </div>
    </div>";
        }
        ?>
    </div>


    <div class="container">
        <div id="alert_setFlash">
            <?= Alert::widget() ?>
        </div>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
