<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use \backend\assets\AppAsset;
use \yii\widgets\Pjax;
use yii\widgets\LinkPager;
$this->title = '问题';
$this -> params['breadcrumbs'][] = "问题列表";
AppAsset::register($this);
AppAsset::addCss($this,'css/table-style.css');
AppAsset::addCss($this,'css/basictable.css');
AppAsset::addJs($this,'js/jquery.basictable.min.js');
AppAsset::addJs($this,'js/table.js');
AppAsset::addJs($this,'js/question.js');
?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="panel-body mtn">
    <div class="bs-component mb20">
        <a href="<?= Yii::$app -> urlManager -> createUrl('question/add')?>" class="btn btn-dark">问题添加</a>
    </div>
</div>
<div class="agile-grids">
    <!-- tables -->
    <input type="hidden" id="url" data-url="<?=Yii::$app -> urlManager -> createUrl(['question/index'])?>">
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
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="question">
                <?php foreach ($questionInfo as $v):?>
                    <tr>
                        <td><input type="checkbox" name="id" value="<?= $v['question_id']?>"></td>
                        <td><?= $v['question_id']?></td>
                        <td><div style="width:100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?= $v['questionName']?></div></td>
                        <td><div style="width:100px;height:30px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?= $v['questionAnswer']?></div></td>
                        <td>

                            <?php if ($v['status'] == 0):?>
                                <i class="fa fa-check-square-o mouse color_red status" data-id="<?=$v['question_id']?>" data-url="<?= Yii::$app -> urlManager -> createUrl('question/status')?>">未审核</i>
                            <?php else:?>
                                <i class="fa fa-check-square-o mouse">已审核</i>
                            <?php endif;?>
                        </td>
                        <td><i class="fa fa-edit"></i><a href="<?=Yii::$app -> urlManager -> createUrl(['question/update','id' => $v['question_id']])?>">修改</a>/<i class="fa fa-trash-o"></i><span class="del mouse" data-id="<?=$v['question_id']?>" data-url="<?=Yii::$app -> urlManager -> createUrl(['question/del'])?>" data-success="<?=Yii::$app -> urlManager -> createUrl(['question/index'])?>">删除</span></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <?= LinkPager::widget(['pagination' => $pages]); ?>
        </div>
        <div class="inner-block">

        </div>
    </div>
    <?= $this->render('//layouts/footer');?>
</div>
</div>
