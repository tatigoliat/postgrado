<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Listado de Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header">
	<a href='<?= Url::toRoute('site/crear-usuario') ?>'>Registrar Usuarios</a>
</div>
<div class="content">
    <h1><?= Html::encode($this->title) ?></h1>
	<table class='table table-bordered'>
		<tr>
			<th>Cedula</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Departamento</th>
			<th>Estatus</th>
			<th></th>
			<th></th>			
		</tr>
		
		<?php foreach($model as $usuario): ?>
			<tr>
				<td><?= $usuario->cedula ?></td>
				<td><?= $usuario->nombre ?></td>
				<td><?= $usuario->email ?></td>
				<td><?= $usuario->departamento ?></td>
				<td><?= $usuario->estatus ?></td>
				<td><a href='#'>Editar</a></td>
				<td><a href='#'>Eliminar</a></td>			
			</tr>
		<?php endforeach ?>
	</table>


</div>
