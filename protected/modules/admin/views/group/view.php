<?php
$this->breadcrumbs=array(
	'Группы'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Списко групп','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать группу','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Изменить группу','url'=>array('update','id'=>$model->id),'icon'=>'pencil'),
	array('label'=>'Удалить группы','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверенны, что хотите удалить эту группу?'),'icon'=>'trash'),
);
?>

<h3>Просмотр группы <?php echo $model->name; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
