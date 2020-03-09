<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

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
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="accordion">
        <div class="trigger">
            <input type="checkbox" id="checkbox-1" name="checkbox-1" />
            <label for="checkbox-1" class="checkbox">
                TABLES <i></i>
            </label>
            <div class="content">
                <h3>Gary Busey 2020!</h3>
                <p>The magic Indian is a mysterious spiritual force, and we're going to Cathedral Rock, and that's the vortex of the heart.You ever roasted doughnuts?These kind of things only happen for the first time once.Did you feel that? Look at me - I'm not out of breath anymore!
            </div>
        </div>

        <div class="trigger">
            <input type="checkbox" id="checkbox-2" name="checkbox-2" />
            <label for="checkbox-2" class="checkbox">
                SQL-script <i></i>
            </label>
            <div class="content">
                <h3>Gary Busey 2020!</h3>
                <p>The magic Indian is a mysterious spiritual force, and we're going to Cathedral Rock, and that's the vortex of the heart.You ever roasted doughnuts?These kind of things only happen for the first time once.Did you feel that? Look at me - I'm not out of breath anymore!
            </div>
        </div>

        <div class="trigger">
            <input type="checkbox" id="checkbox-3" name="checkbox-3" />
            <label for="checkbox-3" class="checkbox">
                New category <i></i>
            </label>
            <div class="content">
                <h3>Gary Busey 2020!</h3>
                <p>The magic Indian is a mysterious spiritual force, and we're going to Cathedral Rock, and that's the vortex of the heart.You ever roasted doughnuts?These kind of things only happen for the first time once.Did you feel that? Look at me - I'm not out of breath anymore!
            </div>
        </div>
    </div>



    <div class="container">
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
