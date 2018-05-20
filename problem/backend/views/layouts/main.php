<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="page-container">
    <?= $content?>
    <div class="sidebar-menu">
        <header class="logo1">
            <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>
        </header>
        <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
        <div class="menu">
            <ul id="menu">
                <li><a href="<?= Yii::$app -> urlManager -> createAbsoluteUrl('site/index')?>"><i class="fa fa-tachometer"></i> <span>首页</span><div class="clearfix"></div></a></li>


                <li id="menu-academico">
                    <a href="javascript:void(0);"><i class="fa fa-envelope nav_icon"></i><span>问题管理</span><span class="fa fa-angle-right" style="float: right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="menu-academico-sub" class="width_50">
                        <li id="menu-academico-avaliacoes" ><a href="<?= Yii::$app -> urlManager -> createAbsoluteUrl('question/index')?>" class="width_50"><span>问题列表</span></a></li>
                        <li id="menu-academico-avaliacoes"><a href="<?= Yii::$app -> urlManager -> createAbsoluteUrl('question/examine')?>">问题审核</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-exclamation-triangle " aria-hidden="true"></i><span>点名系统</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub" class="width_50">
                        <li id="menu-academico-avaliacoes" ><a href="<?= Yii::$app -> urlManager -> createAbsoluteUrl('naming/index')?>" class="width_50"><span>分享人员</span></a></li>
                        <li id="menu-academico-avaliacoes"><a href="<?= Yii::$app -> urlManager -> createAbsoluteUrl('naming/question')?>">提问点名</a></li>
                    </ul>
                </li>
                <li id="menu-academico">
                    <a href="javascript:void(0);"><i class="fa fa-bar-chart"></i><span>系统管理</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub" class="width_100">
                        <li id="menu-academico-avaliacoes" class="width_100">
                            <a href="javascript:void(0)" class="width_100"><span style="float: left;">Rbac</span>
                                <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                            <ul id="menu-academico-sub" class="width_50">
                                <li id="menu-academico-avaliacoes" ><a href="<?= Yii::$app -> urlManager -> createAbsoluteUrl('power/index')?>" class="width_50"><span>权限管理</span></a></li>
                                <li id="menu-academico-avaliacoes"><a href="<?= Yii::$app -> urlManager -> createAbsoluteUrl('role/index')?>">角色管理</a></li>
                            </ul>
                        </li>
                        <li id="menu-academico-avaliacoes"><a href="<?= Yii::$app -> homeUrl?>site/signup">用户添加</a></li>
                    </ul>
                </li>
                <li id="menu-academico">
                    <a href="charts.html"><i class="fa fa-list-ul"></i><span>操作日志</span><div class="clearfix"></div></a>
                </li>
                <!--<li id="menu-academico"><a href="charts.html"><i class="fa fa-bar-chart"></i><span>Charts</span><div class="clearfix"></div></a></li>
                <li id="menu-academico"><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span> Short Codes</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub">
                        <li id="menu-academico-avaliacoes"><a href="icons.html">Icons</a></li>
                        <li id="menu-academico-avaliacoes"><a href="typography.html">Typography</a></li>
                        <li id="menu-academico-avaliacoes"><a href="faq.html">Faq</a></li>
                    </ul>
                </li>
                <li id="menu-academico"><a href="errorpage.html"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><span>Error Page</span><div class="clearfix"></div></a></li>
                <li id="menu-academico"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i><span> UI Components</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub">
                        <li id="menu-academico-avaliacoes"><a href="button.html">Buttons</a></li>
                        <li id="menu-academico-avaliacoes"><a href="grid.html">Grids</a></li>
                    </ul>
                </li>
                <li><a href="tabels.html"><i class="fa fa-table"></i>  <span>Tables</span><div class="clearfix"></div></a></li>
                <li><a href="maps.html"><i class="fa fa-map-marker" aria-hidden="true"></i>  <span>Maps</span><div class="clearfix"></div></a></li>
                <li id="menu-academico"><a href="#"><i class="fa fa-file-text-o"></i>  <span>Pages</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub">
                        <li id="menu-academico-boletim"><a href="calendar.html">Calendar</a></li>
                        <li id="menu-academico-avaliacoes"><a href="signin.html">Sign In</a></li>
                        <li id="menu-academico-avaliacoes"><a href="signup.html">Sign Up</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-check-square-o nav_icon"></i><span>Forms</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul>
                        <li><a href="input.html"> Input</a></li>
                        <li><a href="validation.html">Validation</a></li>
                    </ul>
                </li>-->
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    var toggle = true;

    $(".sidebar-icon").click(function() {
        if (toggle)
        {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position":"absolute"});
        }
        else
        {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function() {
                $("#menu span").css({"position":"relative"});
            }, 400);
        }

        toggle = !toggle;
    });
</script>
