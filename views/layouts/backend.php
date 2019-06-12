<?php

use yii\helpers\Html;
use app\models\User;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$baseUrl = Yii::$app->request->baseUrl . "/themes/backend/insta/";
$baseUrl1 = Yii::$app->request->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
 <html class="no-focus" lang="en"> 
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title>Admin Dashboard</title>
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/smartadmin-skins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/smartadmin-rtl.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/demo.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl?>css/your_style.css">

        <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        <link rel="stylesheet" href="<?= $baseUrl?>css/jquery.tag-editor.css">

        <?php $this->head() ?>
        <style>
            label.glyphicon.glyphicon-calendar.no-margin.padding-top-15 {
                display: none;
            }
        </style>
</head>
    <body class="">
    <?php $this->beginBody() ?>

    <!-- Left Sidebar Start -->
    <?php include('left-sidebar.php');?>
    <!-- Left Sidebar End -->

    <!-- Top Header Start -->
    <?php include('top-header.php');?>
    <!-- Top Header End -->

    <!-- Main Content Start -->
    <?= $content; ?>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <div class="page-footer">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <span class="txt-color-white">Insta <span class="hidden-xs"> - Web Application</span> © 2019</span>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= $baseUrl?>js/plugin/pace/pace.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        if (!window.jQuery) {
            document.write('<script src="<?= $baseUrl?>js/libs/jquery-2.1.1.min.js"><\/script>');
        }
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        if (!window.jQuery.ui) {
            document.write('<script src="<?= $baseUrl?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');
        }
    </script>
    <script src="<?= $baseUrl?>js/app.config.js"></script>
    <script src="<?= $baseUrl?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
    <script src="<?= $baseUrl?>js/bootstrap/bootstrap.min.js"></script>
    <script src="<?= $baseUrl?>js/notification/SmartNotification.min.js"></script>
    <script src="<?= $baseUrl?>js/smartwidgets/jarvis.widget.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/jquery-validate/jquery.validate.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/select2/select2.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/fastclick/fastclick.min.js"></script>
    <script src="<?= $baseUrl?>js/demo.min.js"></script>
    <script src="<?= $baseUrl?>js/app.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?= $baseUrl?>js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
    <script src="<?= $baseUrl?>js/jquery.caret.min.js"></script>
    <script src="<?= $baseUrl?>js/jquery.tag-editor.js"></script>


    <script type="text/javascript">
    var logout = "<?= $baseUrl1?>/site/signout";
    var baseurl_deletecategory = "<?= $baseUrl1?>/admin/delete-subcategory";
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    </script>

    <script src="<?= $baseUrl?>js/custom.js"></script>
    </body>
</html>
