<?php
$this->breadcrumbs=array(
	'Дисциплины'=>array('index'),
	'Экспорт дисциплин',
);

$this->menu=array(

    array('label'=>'Список дисциплин','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать дисциплину','url'=>array('create'),'icon'=>'plus'),
    array('label'=>'Импорт дисциплин', 'url'=>array('import'),'icon'=>'upload'),


);
//echo '<pre>'.print_r($model).'</pre>';
?>

<div class="hero-unit">
  <h1>Экспорт дисциплин</h1>
  <p>Все группы системы экспортированы и загружены на сервер
   его можно забрать по адресу <code><?php echo $path; ?></code> или воспользоваться кнопкой ниже
  </p>
  <p>
    <a href="<?php echo DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'SubjectsExport.xlsx';; ?>" class="btn btn-primary btn-large">
      Скачать
    </a>
  </p>
</div>

