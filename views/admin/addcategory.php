<?php
/**
 * Created by PhpStrom.
 * User: Real Developer
 * Date: 01/05/2018
 * Time: 11:00 AM
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

$baseUrl = Yii::$app->request->baseUrl . "/themes/backend/insta/";
$baseUrl1 = Yii::$app->request->baseUrl;

?>
<style>
    .brbutton .invalid {
        position: absolute;
        bottom: -14px;
    }
</style>
<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>Home</li><li>Manage Category</li><li> Add Category & hash Tags</li>
        </ol>
    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- row -->
        <div class="row">

            <!-- col -->
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">

                    <!-- PAGE HEADER -->
                    <i class="fa-fw fa fa-cubes"></i>Manage Category<span>> Add Category & hash Tags</span>
                </h1>
            </div>
        </div>
        <?php if (Yii::$app->session->getFlash('err')) {
            ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?= Yii::$app->session->getFlash('err'); ?>
            </div>
        <?php } ?>
        <?php if (Yii::$app->session->getFlash('err1')) {
            ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?= Yii::$app->session->getFlash('err1'); ?>
            </div>
        <?php } ?>
        <?php if (Yii::$app->session->getFlash('success')) {
            ?>
            <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php } ?>

        <!-- end row -->
        <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false">
        <div class="widget-body no-padding">
            
            <form id="category-form" class="smart-form" method="post" enctype="multipart/form-data" novalidate="novalidate">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <fieldset>
                    <div class="row">
                        <section class="col col-6">
                            <label class="input"> <i class="icon-append fa fa-cubes"></i>
                                <input type="text" name="title" placeholder="Title">
                            </label>
                        </section>
                    </div>
                 
                    <section>
                        <label class="textarea"> <i class="icon-append fa fa-tags"></i>
                        <textarea id="tags" name="tags" required></textarea>
                        </label>
                    </section>
                </fieldset>
                <footer>
                    <button type="submit" class="btn btn-primary">
                        Submit Form
                    </button>
                </footer>
            </form>

        </div>

        </div>
        </div>

</div>
<!-- END MAIN PANEL -->