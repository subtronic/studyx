<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Импорт пользователей',
);

$this->menu=array(

    array('label'=>'Список пользователей','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать пользователя','url'=>array('create'),'icon'=>'plus'),
    array('label'=>'Экспорт пользователей', 'url'=>array('export'),'icon'=>'download-alt'),


);
//echo '<pre>'.print_r($model).'</pre>';

Yii::app()->clientScript->registerScript('acction', "
$('#User_action').change(function(){
    //alert($('#User_action option:selected').val());
    if ($('#User_action option:selected').val()==0){
        $('#shw').show();
        } 
        if($('#User_action option:selected').val()==1) {
         $('#shw').hide();   
        }
});
;

");

?>

<p>Этот вид будет использоваться для экспорта групп студентов в систему из файла Excell</p>
<ul>
	<li>Файл Вида: <code><?php echo __FILE__; ?></code></li>
	<li>Файл лэйаута: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>
<?php
//echo Yii::app()->getModule('admin')->getBasePath().'/views/group/files'."<br>\n";
/**
 * 	$file_path=dirname(__FILE__) . '/files/1.xlsx';
 *     $sheet_array = Yii::app()->yexcel->readActiveSheet($file_path);
 *       
 *     echo "<table>";
 *      
 *     foreach( $sheet_array as $row ) {
 *         echo "<tr>";
 *         foreach( $row as $column )
 *             echo "<td>$column</td>";
 *         echo "</tr>";
 *     }
 *      
 *     echo "</table>";
 *      
 *     //or
 *      
 *     //echo first cell of excel file
 *     echo $sheet_array[1]['B'];
 */
//echo User::model()->count('realName=:lg',array(':lg'=>'Савчук Дмитрий Иванович'));
?>
<br />
<?php
     if(isset($_POST['User'])){
    	if ($model->succes==0){
    	   ?>
           <div class="alert alert-error">Операцию не удалось выполнить.</div>
          <?php
            } else {
            ?>
            <div class='alert alert-success'>Было
            <?php
            $model->succes--;
            if($model->action==0){echo ' импортировано';}else{echo ' удалено';};
            echo " $model->succes пользователей</div>";
           }
     }
?>
<br />
<?php 

    echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); 
    
    echo CHtml::activeFileField($model, 'xls');
    echo '<br>';
    //echo CHtml::activeCheckBox($model,'sm');
    
    echo CHtml::activelabelEx($model,'Выберите действие');
    echo CHtml::activedropDownList($model,'action',array('0'=>'Обновить','1'=>'Удалить',));
    echo CHtml::error($model,'action');
    echo '<div id="shw">';
    echo CHtml::activelabelEx($model,'Выберите группу по умолчанию');
    echo CHtml::activeDropDownList($model,'defaultGroup_id',Group::all(),array('empty' => ''));
    echo CHtml::error($model,'defaulGroup');
    echo '<br><p>';
    
    //echo CHtml::activeLabel($model,'Создавать новые группы?');
    echo CHtml::activeCheckBox($model,'createNewGroup',array('style'=>'margin:0;')).' <span>Создавать новые группы</span>';
    echo CHtml::error($model,'createNewGroup');
    echo '</p>';
    
    echo CHtml::activelabelEx($model,'Выберите роль по умолчанию');
    echo CHtml::activeDropDownList($model,'defaultRole',array('admin'=>'Администратор','teacher'=>'Преподаватель','user'=>'Студент'),array('empty' => ''));
    echo CHtml::error($model,'defaulRole');
    echo '</div>';

    

    
    echo '<br>';
    
    $this->widget('bootstrap.widgets.TbButton', array(
    			'buttonType'=>'submit',
    			'type'=>'primary',
    			'label'=>'Отправить',
    		));
    
    echo CHtml::endForm(); 
