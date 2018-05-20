<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use \backend\assets\AppAsset;
$this->title = '角色列表';
$this -> params['breadcrumbs'][] = "角色列表";
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');

?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="panel-body mtn">

    <div class="bs-component mb20">
        <a href="<?= Yii::$app -> urlManager -> createUrl('role/create')?>" class="btn btn-dark">角色添加</a>
    </div>
</div>
<div class="agile-grids">
    <!-- tables -->

    <div class="agile-tables">
        <div class="w3l-table-info">
            <h2>角色列表</h2>
            <table id="table">
                <thead>
                <tr>
                    <th>角色名称</th>
                    <th>角色描述</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $v):?>
                    <tr>
                        <td><?= $v -> name?></td>
                        <td><?= $v -> description?></td>
                        <td>
                            <a href="<?= Yii::$app -> urlManager -> createUrl(['role/del','name' => $v -> name])?>">删除</a>
                            <a href="<?= Yii::$app -> urlManager -> createUrl(['role/update','name' => $v -> name])?>">修改</a>
                            <a href="<?= Yii::$app -> urlManager -> createUrl(['child/index','name' => $v -> name])?>">查看用户</a>
                            <a href="<?= Yii::$app -> urlManager -> createUrl(['role/add-user','name' => $v -> name])?>">添加用户</a>
                            <a href="<?= Yii::$app -> urlManager -> createUrl(['role/permission','name' => $v -> name])?>">添加权限</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="inner-block">

        </div>
    </div>
    <?= $this->render('//layouts/footer');?>
</div>
</div>
