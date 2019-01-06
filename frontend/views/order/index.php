<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;

$filterPanelExpanded = $searchModel->hasFilters();
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel-group" id="filter" role="tablist">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="filter-header">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#filter" href="#filter-body" aria-expanded="<?= ($filterPanelExpanded ? 'true' : 'false') ?>" aria-controls="filterBody">
                    <?= Yii::t('app', 'Filter') ?>
                    </a>
                </h4>
            </div>
            <div id="filter-body" class="panel-collapse collapse <?= ($filterPanelExpanded ? 'in' : 'out') ?>" role="tabpanel" aria-labelledby="filter-header">
                <div class="panel-body">
                    <?= $this->render('_search', ['model' => $searchModel]) ?>
                </div>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'user.username',
            'currency.name',
            'amount:decimal',
            'message',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
