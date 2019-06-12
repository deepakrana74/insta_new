<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;

    //print_r($main_category_name); die;
?>  

<div id="content" class="content">

    <!-- success flash appear here -->
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <b><?= Yii::$app->session->getFlash('success'); ?></b>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    <?php endif; ?>

    <!-- initialize the active form here -->
    <?php $form = ActiveForm::begin([ 
        'id'=> 'active-form',
            'options' => [
                'class'=> 'form-horizontal',
                'enctype'=> 'multipart/form-data',
            ],

            'action' => ['update-sub-category','keyword_id'=>Yii::$app->request->getQueryParam('keyword_id')],

        ]);
    ?>

        <!-- sub category active field -->
        <?= $form->field($sub_category_model, 'sub_category_name')->textInput(['value'=> $sub_category_name]); ?>

        <!-- main category active field -->
        <?= $form->field($parent_category_model, 'main_category_name',['enableClientValidation'=>false])->dropDownList(
            ArrayHelper::map($parent_category_model->find()->all(), 'id', 'main_category_name'),
            ['prompt'=>'Select....']
            )->label('Change Main Category');
        ?>                      

        <!-- subcategory group active field -->
        <?= $form->field($sub_category_model, 'sub_category_group')->textInput(['value'=>
            $sub_category_group])->label('Change Sub Category Group'); ?>

        <!-- active submit form button -->
        <div class="form-group">
            <div class=" col-lg-11">
                <?= Html::submitButton('Update', ['class'=>'btn btn-success'])?>
            </div>
        </div>
    <?php ActiveForm::end(); ?> 
</div>