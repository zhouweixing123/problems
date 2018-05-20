<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use \backend\assets\AppAsset;
$this->title = '授权列表';
$this->params['breadcrumbs'][] = [
    'label' => '角色列表',
    'url' => \yii\helpers\Url::to(['role/index'])
];
$this -> params['breadcrumbs'][] = "授权列表";
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');

?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="agile-grids">
    <!-- tables -->

    <div class="agile-tables">
        <div class="w3l-table-info">
            <h2>授权列表</h2>
            <table id="table">
                <thead>
                    <tr>
                        <th>用户名</th>
                        <th>角色名</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $v):?>
                        <tr>
                            <td><?= $v['username']?></td>
                            <td><?= $v['item_name']?></td>
                            <td>
                                <a href="<?= Yii::$app -> urlManager -> createUrl(['child/del','name' => $v['item_name'],'id' => $v['id']])?>">删除</a>
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
