<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use \backend\assets\AppAsset;
$this->title = '点名系统';
$this -> params['breadcrumbs'][] = "分享点名";
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');
AppAsset::addJs($this,'js/naming.js');

?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="agile-grids">
    <!-- tables -->

    <div class="agile-tables">
        <div class="w3l-table-info">
            <button class="btn-primary btn" id="user_name" data-url="<?= Yii::$app -> urlManager -> createUrl('naming/index')?>">选取分享人员</button>
            <table id="table">
                <thead>
                <tr>
                    <th>分享人员</th>
                </tr>
                </thead>
                <tbody id="table_name">

                </tbody>
            </table>
        </div>
        <div class="inner-block">

        </div>
    </div>
    <?= $this->render('//layouts/footer');?>
</div>
</div>
