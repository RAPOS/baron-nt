<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = 'Программы';
?>
<div class="btypes-of-massage-index"   style="width: 700px;">
    <p>
        <?= Html::a('Добавить программу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'tBodyAttr' => 'id="sortable"',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_massage',
            'name',
            'translate',
            'duration',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
