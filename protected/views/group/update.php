<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Group','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать Group','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Просмотр Group','url'=>array('view','id'=>$model->id),'icon'=>'eye-open'),
);
?>

<h3>Изменение Group <?php echo $model->id; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>