<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use \backend\assets\AppAsset;
$this->title = '提问系统';
$this -> params['breadcrumbs'][] = "点名提问";
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');
AppAsset::addJs($this,'js/put.js');

?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="agile-grids">
    <!-- tables -->

    <div class="agile-tables">
        <div class="w3l-table-info">
            <button class="btn-primary btn" id="user_name" data-url="<?= Yii::$app -> urlManager -> createUrl('naming/question')?>" data-info="<?= Yii::$app -> urlManager -> createUrl(['site/info','id' => ''])?>">选取提问人员</button>
            <table id="table">
                <thead>
                <tr>
                    <th>提问人员</th>
                    <th>提问问题</th>
                    <th>查看答案</th>
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
