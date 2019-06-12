<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


class FrontAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
                // Vendor CSS
        '../../themes/vendor/bootstrap/css/bootstrap.min.css',
        '../../themes/vendor/font-awesome/css/font-awesome.min.css',
        '../../themes/vendor/animate/animate.min.css',
        '../../themes/vendor/simple-line-icons/css/simple-line-icons.min.css',
        '../../themes/vendor/owl.carousel/assets/owl.carousel.min.css',
        '../../themes/laps/vendor/owl.carousel/assets/owl.theme.default.min.css',
        '../../themes/laps/vendor/magnific-popup/magnific-popup.min.css',

            // Theme CSS
        '../../themes/css/theme.css',
        '../../themes/css/theme-elements.css',
        '../../themes/css/theme-blog.css',
        '../../themes/css/theme-shop.css',

          // Current Page CSS
        '../../themes/vendor/rs-plugin/css/settings.css',
        '../../themes/vendor/rs-plugin/css/layers.css',
        '../../themes/vendor/rs-plugin/css/navigation.css',
        '../../themes/vendor/circle-flip-slideshow/css/component.css',

            // Skin CSS
        '../../themes/css/skins/default.css',

           //Theme Custom CSS
        '../../themes/css/custom.css',

        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light',
    ];
    public $js = [

        '../../themes/vendor/modernizr/modernizr.min.js',
        '../../themes/vendor/jquery/jquery.min.js',
        '../../themes/vendor/jquery.appear/jquery.appear.min.js',
        '../../themes/vendor/jquery.easing/jquery.easing.min.js',
        '../../themes/vendor/jquery-cookie/jquery-cookie.min.js',
        '../../themes/vendor/bootstrap/js/bootstrap.min.js',
        '../../themes/vendor/common/common.min.js',
        '../../themes/vendor/jquery.validation/jquery.validation.min.js',
        '../../themes/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js',
        '../../themes/vendor/jquery.gmap/jquery.gmap.min.js',
        '../../themes/vendor/jquery.lazyload/jquery.lazyload.min.js',
        '../../themes/vendor/isotope/jquery.isotope.min.js',
        '../../themes/vendor/owl.carousel/owl.carousel.min.js',
        '../../themes/vendor/magnific-popup/jquery.magnific-popup.min.js',
        '../../themes/vendor/vide/vide.min.js',
        '../../themes/js/theme.js',
        '../../themes/vendor/rs-plugin/js/jquery.themepunch.tools.min.js',
        '../../themes/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js',
        '../../themes/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js',
        '../../themes/js/views/view.home.js',
        '../../themes/js/custom.js',
        '../../themes/js/theme.init.js',
        '../../themes/js/examples/examples.demos.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}