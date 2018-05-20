<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use backend\assets\AppAsset;
$this->title = '首页';
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');
AppAsset::addJs($this,'js/question.js');
$this -> params['breadcrumbs'][] = "首页";
?>
<?= $this->render('//layouts/header',['username' => $username,"model" => $model]);?>
<!--four-grids here-->
<div class="four-grids">
    <div class="col-md-3 four-grid">
        <div class="four-agileits">
            <div class="icon">
                <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
            </div>
            <div class="four-text">
                <h3>用户人数</h3>
                <h4> <?= $count?>  </h4>

            </div>

        </div>
    </div>
    <div class="col-md-3 four-grid">
        <div class="four-agileinfo">
            <div class="icon">
                <i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
            </div>
            <div class="four-text">
                <h3>问题总数</h3>
                <h4><?=$questionCount?></h4>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="agile-tables">
    <div class="w3l-table-info">
        <h2>问题列表</h2>
        <table id="table-max-height" class="max-height">
            <thead>
            <tr>
                <th><input type="checkbox" name="ids"></th>
                <th>编号</th>
                <th>问题</th>
                <th>答案</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="question">
            <?php foreach ($questionInfo as $v):?>
                <tr>
                    <td><input type="checkbox" name="id" value="<?= $v['question_id']?>"></td>
                    <td><?= $v['question_id']?></td>
                    <td><div style="width:100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?= $v['questionName']?></div></td>
                    <td><div style="width:100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;height: 30px;"><?= $v['questionAnswer']?></div></td>
                    <td><i class="fa fa-edit"></i><a href="<?=Yii::$app -> urlManager -> createUrl(['site/info','id' => $v['question_id']])?>">查看</a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>
    <div class="inner-block">

    </div>
</div>
<div class="inner-block"></div>
<?= $this->render('//layouts/footer');?>
</div>
</div>
