<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Group','url'=>array('index'),'icon'=>'plus'),
);
?>

<h3>Создание Group</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>