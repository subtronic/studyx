<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>''.CHtml::encode(Yii::app()->name),
)); ?>

<p>Приложение разработано для маленьких и средних ВУЗов, с целью облегчения ведения контроля успеваемости студентов.</p>

<?php $this->endWidget(); ?>


