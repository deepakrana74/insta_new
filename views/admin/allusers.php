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

$baseUrl = Yii::$app->request->baseUrl . "/themes/backend/e-ticket/";
$baseUrl1 = Yii::$app->request->baseUrl;
?>

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
            <li>Home</li><li>Dashboard</li><li>Manage Users</li>
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
                    <i class="fa-fw fa fa-home"></i>Dashboard<span>>Manage Users</span>
                </h1>
            </div>
        </div>
        <!-- end row -->

    <table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th data-hide="phone">Sr No.</th>
            <th data-class="expand">Username</th>
            <th data-hide="phone">Email ID</th>
            <th>Phone</th>
            <th data-hide="phone,tablet">Address</th>
<!--            <th data-hide="phone,tablet">Join Events</th>-->
            <th data-hide="phone,tablet">Activated</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1;foreach($Data['AllUsers'] as $AllUsers){ ?>
        <tr>
            <td><?= $i;?></td>
            <td><?= $AllUsers->name;?></td>
            <td><?= $AllUsers->email;?></td>
            <td><?= $AllUsers->mobile;?></td>
            <td><?= $AllUsers->address;?></td>
<!--            <td><a href="#">Click Here to View</a></td>-->
            <td>
                    <span class="onoffswitch">
                        <?php if($AllUsers->status==1) { ?>
                        <input name="user_status" class="onoffswitch-checkbox" id="user_<?= $AllUsers->id; ?>" type="checkbox" checked>
                        <?php } else { ?>
                            <input name="user_status" class="onoffswitch-checkbox" id="user_<?= $AllUsers->id; ?>" type="checkbox">
                        <?php } ?>
                        <label class="onoffswitch-label" for="user_<?= $AllUsers->id; ?>">
                            <span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="NO"></span>
                            <span class="onoffswitch-switch">
                            </span>
                        </label>
                    </span>
            </td>
        </tr>
        <?php  $i++; } ?>
        </tbody>
    </table>

        </div>

</div>
<!-- END MAIN PANEL -->