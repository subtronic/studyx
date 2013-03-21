<?php
$this->breadcrumbs=array(
	'Дисципилны'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Спиосок дисциплин','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать дисципилну','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Изменить дисциплину','url'=>array('update','id'=>$model->id),'icon'=>'pencil'),
	array('label'=>'Удалить дисципилну','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить данную дисциплину?'),'icon'=>'trash'),
);
?>

<h3>Просмотр <?php echo $model->name; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
