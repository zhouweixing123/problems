<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/17
 * Time: 20:16
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = "添加";
?>
<?= $this->render('//layouts/header',['username' => $username,"model" => $model]);?>

<div class="grid-form">
    <div class="grid-form1">
        <h2 id="forms-example" class="">用户添加</h2>
        <?php $form = ActiveForm::begin(); ?>
        <!-- 用户名 -->
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <?= $form->field($usermodel, 'username')->label(false)->textInput(['class' => 'form-control', 'placeholder' => '请输入2-10位的用户名...', 'id' => 'focusedinput']) ?>
        </div>
        <!-- 邮箱 -->
        <div class="form-group">
            <label for="exampleInputEmail1">邮箱</label>
            <?= $form->field($usermodel, 'email')->label(false)->textInput(['class' => 'form-control', 'id' => 'exampleInputEmail1', 'placeholder' => '请输入邮箱...']) ?>
        </div>
        <!-- 密码 -->
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <?= $form->field($usermodel, 'password')->label(false)->passwordInput(array('class' => 'form-control', 'id' => 'exampleInputPassword1', 'placeholder' => '请输入6-8位密码....')) ?>
        </div>

        <!-- 记住我 -->
        <!--<div class="checkbox">
            <label>
                <input type="checkbox"> Check me out
            </label>
        </div>-->
        <?= Html::submitInput('添加用户', ['class' => 'btn btn-default', 'name' => 'signup-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?= $this->render('//layouts/footer'); ?>
</div>
</div>

