<?php
$this->breadcrumbs=array(
	'Группы'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Списко групп','url'=>array('index'),'icon'=>'list'),
);
?>

<h1>Создание группы</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>