<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '登录页面';
?>
<h2><?= Html::encode($this->title) ?></h2>
<?php $form = ActiveForm::begin(['id' => 'form-signup']);?>
<div class="username">
    <span class="username">用户名:</span>
    <?= $form -> field($model,'username') -> label("") -> textInput(['class' => 'name','placeholder'=>'请输入用户名...'],array('name'=>'username'))?>
    <div class="clearfix"></div>
</div>
<div class="password-agileits">
    <span class="username">密码:</span>
    <?= $form -> field($model,'password') -> label('') -> passwordInput(array('class'=>'password','placeholder'=>'请输入密码....'))?>
    <div class="clearfix"></div>
</div>
<div class="rem-for-agile">
    <input type="checkbox" name="remember" class="remember">记住密码<br>
</div>
<div class="form-dignup">
    <div class="login-w3">
        <?= Html::submitInput('登录',['class' => 'btn btn-primary','name' => 'signup-button'])?>
    </div>
</div>
<div class="clearfix"></div>
<?php ActiveForm::end();?>
