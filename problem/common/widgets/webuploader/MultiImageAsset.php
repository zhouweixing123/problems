<?php
namespace common\widgets\webuploader;

use yii\web\AssetBundle;

class MultiImageAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/webuploader/assets';

    public $css = [
        'dist/webuploader.css',
        'multi/multi.css'
    ];

    public $js = [
        'dist/webuploader.min.js',
		'multi/multi.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
