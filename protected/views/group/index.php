<?php
$this->breadcrumbs=array(
	'Мои курсы',
);

$this->menu=array(
	array('label'=>'Список Group','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать Group','url'=>array('create'),'icon'=>'plus'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Список Ваших курсов</h3>
<?php 


?>
<div class="tabbable tabs-left"> 
  <ul class="nav nav-tabs">
  <?php
  
  for($i=0;$i<count($groups);$i++){
    echo '<li><a href="#tab'.$groups[$i].'" data-toggle="tab">'.Group::model()->find('id='.$groups[$i])->name.'</a></li>';
  }
  
  echo '</ul><div class="tab-content">';
  
    for($i=0;$i<count($groups);$i++){
        echo '<div class="tab-pane" id="tab'.$groups[$i].'">';        
        
          switch (Yii::app()->user->role) {
            case 'admin':
                    $mdl=Course::model()->findAll('group_id='.$groups[$i]);
                break;
            case 'teacher':  
                    $mdl=Course::model()->findAll('teacher=:th and group_id=:gr',array(':gr'=>$groups[$i],':th'=>Yii::app()->user->id));
                break;
            case 'user':
                    $mdl=Course::model()->findAll('group_id=:gr',array(':gr'=>$groups[0]));
                break;
          }
        
        foreach ($mdl as $courses){
            echo '<p>'.CHtml::link($courses->subjects->name,array("course/view?g=".$courses->group_id."?d=".$courses->subject)).'</p>';
        }
        echo '</div>';     
    }
    echo '</div></div>';