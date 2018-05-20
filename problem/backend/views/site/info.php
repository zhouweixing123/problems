<?php
/**
 * Created by PhpStorm.
 * User: F6
 * Date: 2018/4/22
 * Time: 14:25
 */
$this->title = '问题详情';
$this->params['breadcrumbs'][] = [
    'label' => '首页',
    'url' => \yii\helpers\Url::to(['site/index'])
];
$this -> params['breadcrumbs'][] = "问题详情";
?>
<?= $this->render('//layouts/header',['username' => $username,'model' => $model]);?>
<div class="agile3-grids">
    <!-- grids -->
    <div class="grids">
        <div class="panel1 panel-widget top-grids">
            <div class="chute chute-center text-center">
                <div class="grid_3 grid_4 w3layouts">
                    <h3 class="hdg"><?=$data['questionName']?></h3>
                </div>
                <?= $data['questionAnswer']?>
            </div>
        </div>
    </div>
    <!-- //grids -->
</div>
<div class="inner-block">

</div>
</div>
<div class="inner-block"></div>
<?= $this->render('//layouts/footer');?>
</div>
</div>
