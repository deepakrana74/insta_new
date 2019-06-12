<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$baseUrl = Yii::$app->request->baseUrl . "/web";
$baseUrl1 = Yii::$app->request->baseUrl;
AppAsset::register($this);
?>
<!-- Error Content -->
<div id="content">

    <!-- row -->
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center error-box">
                        <h1 class="error-text tada animated"><i class="fa fa-times-circle text-danger error-icon-shadow"></i> Error 500</h1>
                        <h2 class="font-xl"><strong>Oooops, Something went wrong!</strong></h2>
                        <br />
                        <p class="lead semi-bold">
                            <strong>You have experienced a technical error. We apologize.</strong><br><br>
                            <small>
                                We are working hard to correct this issue. Please wait a few moments and try your search again.
                            </small>
                        </p>
                        <ul class="error-search text-left font-md">
                            <li style="text-align: center;"><a href="<?= $baseUrl1 ?>/site/signout"><small>Go back</small></a></li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- end row -->

</div>

        <!-- END Error Content -->
