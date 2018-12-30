<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bar.css',
        'css/bootstrap.css',
        'css/fontawesome-all.css',
        'css/pignose.calender.css',
        'css/style.css',
        'css/style4.css',
        'css/widgets.css',
        'css/site.css',
    ];
    public $js = [
        'js/jquery-2.2.3.min.js',
        'js/bootstrap.min.js',
        'js/amcharts.js',
        'js/moment.min.js',
        'js/pignose.calender.js',
        'js/chart1.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
