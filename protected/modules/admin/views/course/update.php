<?php
$this->breadcrumbs=array(
	'Курсы'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список курсов','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать курс','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Просмотр курса','url'=>array('view','id'=>$model->id),'icon'=>'eye-open'),
);
?>

<h3>Изменение Курса <?php echo $model->id; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>