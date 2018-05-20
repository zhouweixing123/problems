<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/18
 * Time: 16:25
 */
?>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?= $this->title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="<?= Yii::$app -> homeUrl?>css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="<?= Yii::$app -> homeUrl?>css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="<?= Yii::$app -> homeUrl?>css/morris.css" type="text/css"/>
    <!-- Graph CSS -->
    <link href="<?= Yii::$app -> homeUrl?>css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= Yii::$app -> homeUrl?>css/jquery-ui.css">
    <!-- jQuery -->
    <script src="<?= Yii::$app -> homeUrl?>js/jquery-2.1.4.min.js"></script>
    <!-- //jQuery -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="<?= Yii::$app -> homeUrl?>css/icon-font.min.css" type='text/css' />
    <!-- //lined-icons -->
</head>
<body>
<div class="main-wthree">
    <div class="container">
        <div class="sin-w3-agile">
            <?= $content?>
            <div class="back">
            </div>
            <div class="footer">
                <p>&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                <p>&copy; <?= Html::encode(Yii::$app->bug) ?></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
