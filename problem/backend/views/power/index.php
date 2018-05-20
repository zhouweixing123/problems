<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use \backend\assets\AppAsset;
$this->title = '权限列表';
$this -> params['breadcrumbs'][] = "权限列表";
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');

?>

<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="panel-body mtn">

    <div class="bs-component mb20">
        <a href="<?= Yii::$app -> urlManager -> createUrl('power/create')?>" class="btn btn-dark">添加权限</a>
    </div>
</div>
        <div class="agile-grids">
            <!-- tables -->

            <div class="agile-tables">
                <div class="w3l-table-info">
                    <h2>权限列表</h2>
                    <table id="table">
                        <thead>
                            <tr>
                                <th>权限名称</th>
                                <th>权限描述</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $v):?>
                            <tr>
                                <td><?= $v -> name?></td>
                                <td><?= $v -> description?></td>
                                <td>
                                    <a href="<?= Yii::$app -> urlManager -> createUrl(['power/del','name' => $v -> name])?>">删除</a>
                                    <a href="<?= Yii::$app -> urlManager -> createUrl(['power/update','name' => $v -> name])?>">修改</a>
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
