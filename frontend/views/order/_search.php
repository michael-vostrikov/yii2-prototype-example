<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'successCssClass' => false,
    ]); ?>

    <div class="row">

        <div class="col-sm-3">
            <?= $form->field($model, 'id') ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'username') ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'created_at_from') ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'created_at_to') ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'message') ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'currency_id')->dropdownList(
                ArrayHelper::map(Currency::find()->all(), 'id', 'name'),
                ['prompt' => Yii::t('app', '[ select ]')]
            ) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'amount_from') ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'amount_to') ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
