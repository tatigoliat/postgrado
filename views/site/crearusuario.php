<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Registrar Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header">
	<a href='<?= Url::toRoute('site/ver-usuario') ?>'>Listado de Usuarios</a>
</div>
<div class="content">
    <h1><?= Html::encode($this->title) ?></h1>
	<h3><?= $msj ?></h3>
	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['method' => 'post',
											'id' => 'crear-usuario-form',
											'enableClientValidation' => true, ]); ?>

				<?= $form->field($model, 'cedula')->input('text') ?>

				<?= $form->field($model, 'nombre')->input('text') ?>

				<?= $form->field($model, 'email')->input('text') ?>

				<?= $form->field($model, 'departamento')->input('text') ?>


				<div class="form-group">
					<?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'crear-usuario-button']) ?>
				</div>

			<?php ActiveForm::end(); ?>

		</div>
	</div>

</div>
