<?php
$this->breadcrumbs=array(
	'Группы'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменение группы',
);

$this->menu=array(
	array('label'=>'Списко групп','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать группу','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Просмотр группы','url'=>array('view','id'=>$model->id),'icon'=>'eye-open'),
);
?>

<h3>Изменение группы <?php echo $model->name; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>