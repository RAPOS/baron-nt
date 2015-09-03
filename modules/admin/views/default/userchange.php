<?php
use kartik\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Изменить данные входа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userchange" style="width: 700px;">
	<?if($success){
		echo Alert::widget([
			'type' => Alert::TYPE_SUCCESS,
			//'title' => 'Отзыв отравлен!',
			'icon' => 'glyphicon glyphicon-remove-sign',
			'body' => 'Изменения успешно сохранены!',
			'showSeparator' => true,
			'delay' => 5000,
			'options' => [
				'style' => 'position: fixed;top: 50px;right: 0;width: 400px;',
			],
		]);
	}?>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->input('text', ['value' => ''])->label('Введите новый логин:')?>
        <?= $form->field($model, 'password')->passwordInput(['value' => ''])->label('Введите новый пароль:')?>
    
        <div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
			<?= Html::a('Отменить', ['/admin'], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>