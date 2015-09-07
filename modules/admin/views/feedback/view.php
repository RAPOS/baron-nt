<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bfeedback-view">
	<?php $form = ActiveForm::begin(); ?>
    <?/* = DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'name',
            'subject',
            'text:ntext',
			[
				'attribute' => 'date',
				'format' => ['date', 'php:d.m.Y']
			],
        ],
    ])  */?>
    <p>
        <?=Html::submitButton('Ответить', ['class' => 'btn btn-success'])?>
        <?= Html::a('Отмена', ['/admin/feedback'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	<?php ActiveForm::end(); ?>
</div>
