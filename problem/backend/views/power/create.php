<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this -> title = "权限管理";
$this->params['breadcrumbs'][] = [
    'label' => '权限列表',
    'url' => \yii\helpers\Url::to(['power/index'])
];
$this -> params['breadcrumbs'][] = "添加权限";
?>

<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="main-wthree c_g_border">
    <div class="container">
        <div class="sin-w3-agile">
            <form action="" id="form-signup" method="post">
                <input type="hidden" name="_csrf-backend" value="<?= Yii::$app -> getRequest() -> getCsrfToken()?>">
                <div class="username">
                    <span class="username">权限名称:</span>
                    <input type="text" class="name" name="name" placeholder="请输入权限名称">
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
