<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registrar Recurso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
	<h3><?= $msj ?></h3>
	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['method' => 'post',
											'id' => 'crear-recurso-form',
											'enableClientValidation' => true, ]); ?>

				<?= $form->field($model, 'titulo')->input('text') ?>

				<?= $form->field($model, 'autor')->input('text') ?>

				<?= $form->field($model, 'tipo_recurso')->input('text') ?>

				<?= $form->field($model, 'total_existente')->input('text') ?>


				<div class="form-group">
					<?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'crear-recurso-button']) ?>
				</div>

			<?php $form->end(); ?>

		</div>
	</div>

</div>
