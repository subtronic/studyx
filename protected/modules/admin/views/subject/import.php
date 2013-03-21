<?php
$this->breadcrumbs=array(
	'Дисциплины'=>array('index'),
	'Импорт дисциплин',
);

$this->menu=array(

    array('label'=>'Список дисциплин','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать дисциплину','url'=>array('create'),'icon'=>'plus'),
    array('label'=>'Экспорт дисциплин', 'url'=>array('export'),'icon'=>'download-alt'),


);
//echo '<pre>'.print_r($model).'</pre>';
?>
<h1>Заголовок</h1>
<p>Интротекст</p>
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
?>
<br />
<?php
     if(isset($_POST['Subject'])){
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
            echo " $model->succes дисциплин(а/ы)</div>";
           }
     }
?>
<br />
<?php 

    echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); 
    
    echo CHtml::activeFileField($model, 'xls');
    echo '<br>';
    echo CHtml::activelabelEx($model,'Выберите действие');
    echo CHtml::activedropDownList($model,'action',array('0'=>'Обновить','1'=>'Удалить',));
    echo CHtml::error($model,'action');
    
    echo '<br>';
    
    $this->widget('bootstrap.widgets.TbButton', array(
    			'buttonType'=>'submit',
    			'type'=>'primary',
    			'label'=>'Отправить',
    		));
    
    echo CHtml::endForm(); 
