<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this -> title = "问题管理";
$this->params['breadcrumbs'][] = [
    'label' => '问题列表',
    'url' => \yii\helpers\Url::to(['question/index'])
];
$this -> params['breadcrumbs'][] = "添加问题";
?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="main-wthree c_g_border">
    <div class="container">
        <div class="sin-w3-agile">
            <form action="" id="form-signup" method="post">
                <input type="hidden" name="_csrf-backend" value="<?= Yii::$app -> getRequest() -> getCsrfToken()?>">
                <div class="username">
                    <span class="username">问题名称:</span>
                    <input type="text" class="name" name="name" placeholder="请输入问题名称">
                    <div class="clearfix"></div>
                </div>
                <div class="username" style="position: relative;left:-270px;">
                    <?=common\widgets\ueditor\Ueditor::widget(['options'=>['initialFrameWidth' => 1000,'initialFrameHeight' => 600]])?>
                    <div class="clearfix"></div>
                </div>
                <div class="form-dignup">
                    <input type="submit" class="login" value="添加">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->render('//layouts/footer');?>
</div>
</div>
