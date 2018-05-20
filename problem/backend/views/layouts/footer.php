<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/18
 * Time: 0:45
 */
use yii\helpers\Html;
?>

<!--
    底部
-->
<div class="copyrights">
    <p>&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    <br/>
    <p><?= Html::encode(Yii::$app -> bug) ?></p>
</div>
