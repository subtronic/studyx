<?php
$this->breadcrumbs=array(
	'Курсы'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список курсов','url'=>array('index'),'icon'=>'list'),
);
?>

<h3>Создание курса</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>