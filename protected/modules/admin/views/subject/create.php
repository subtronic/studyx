<?php
$this->breadcrumbs=array(
	'Дисциплины'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список дисциплин','url'=>array('index'),'icon'=>'list'),
);
?>

<h3>Создание дисциплиныt</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>