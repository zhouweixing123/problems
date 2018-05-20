<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use \backend\assets\AppAsset;
$this->title = '权限列表';
$this->params['breadcrumbs'][] = [
    'label' => '角色列表',
    'url' => \yii\helpers\Url::to(['role/index'])
];
$this -> params['breadcrumbs'][] = "添加问题管理员权限";
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');

?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="grid-form">
    <div class="grid-form1">
        <h3>添加权限到角色</h3>
        <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                <form class="form-horizontal" action="" method="post">
                    <input type="hidden" name="_csrf-backend" value="<?= Yii::$app -> getRequest() -> getCsrfToken()?>">
                    <div class="form-group">
                        <label for="checkbox" class="col-sm-2 control-label">请选择权限</label>
                        <div class="col-sm-8">
                            <?php foreach ($permissions as $v):?>
                                <div class="checkbox-inline"><label><input type="checkbox" <?= in_array($v -> name,$rolePermissions)?'checked':''?> name="permissions[]" value="<?= $v -> name?>"> <?= Html::encode($v -> description)?></label></div>
                            <?php endforeach;?>
                        </div>
                    </div>
            </div>
        </div>
        <div class="bs-example" data-example-id="form-validation-states-with-icons">
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" class="btn-primary btn">添加</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="inner-block">

    </div>

    <?= $this->render('//layouts/footer');?>
</div>
</div>
