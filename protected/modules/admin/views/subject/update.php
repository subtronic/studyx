<?php
$this->breadcrumbs=array(
	'Дисциплины'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список дисциплин','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать дисциплину','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Просмотр дисциплины','url'=>array('view','id'=>$model->id),'icon'=>'eye-open'),
);
?>

<h3>Изменение  <?php echo $model->name; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>