<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Спиоск Group','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать Group','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Изменить Group','url'=>array('update','id'=>$model->id),'icon'=>'pencil'),
	array('label'=>'Удалить Group','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить выбранный элеменет?'),'icon'=>'trash'),
);
?>

<h3>Просмотр Group #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
