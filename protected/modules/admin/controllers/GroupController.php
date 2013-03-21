<?php

class GroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','delete','import','export'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays and get import data and form.
    */
	public function actionImport()
	{
	   
    $model=new Group;
    if(isset($_POST['Group'])AND(CUploadedFile::getInstance($model,'xls')<>'')){   
        $model->attributes=$_POST['Group'];
        $model->xls=CUploadedFile::getInstance($model,'xls');
        $model->action=$_POST['Group']['action'];
        
        $path=Yii::app()->getModule('admin')->getBasePath().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'group'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.''.$model->xls;
           
            if(Yii::app()->file->set($path)->exists){
                Yii::app()->file->set($path)->delete();
             }
                //echo $path;
                $model->xls->saveAs($path);
                // перенаправляем на страницу, где выводим сообщение об
                // успешной загрузке
            //}
        //$file_path=dirname(__FILE__) . '/files/1.xlsx';
        $sheet_array = Yii::app()->yexcel->readActiveSheet($path);     
        /*foreach( $sheet_array as $row ) {
            $j=1;
            foreach( $row as $column ){
                        $j++;
                        if($cnt==0)$cnt++;
                        if($model->action==0){
                            if(Group::model()->count('name=:nm',array(':nm'=>$column))>0) continue;
                            $model1= new Group;
                            $model1->name=$column;
                            $model1->save();
                            $cnt++;
                        } else {
                            if(Group::model()->count('name=:nm',array(':nm'=>$column))<>0) 
                            {
                                $dl=Group::model()->findByAttributes(array('name'=>$column));
                                $dl->delete();
                                $cnt++;
                            }
                        }
            }
       
        }*/
        $j=1;
        $cnt++;
        while(true){
            if($sheet_array[$j]['A']<>''){
                        $j++;
                        if($model->action==0){
                            if(Group::model()->count('name=:nm',array(':nm'=>$sheet_array[$j]['A']))>0) continue;
                            $model1= new Group;
                            $model1->name=$sheet_array[$j]['A'];
                            if($model1->save())$cnt++;
                        } else {
                            if(Group::model()->count('name=:nm',array(':nm'=>$sheet_array[$j]['A']))<>0) 
                            {
                                $dl=Group::model()->findByAttributes(array('name'=>$sheet_array[$j]['A']));
                                if($dl->delete())$cnt++;
                            }
                        }
            } else {break;}
        }
       
         
    }
		$model->succes=$cnt;
        $this->render('import',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays and get export data and form.
    */
	public function actionExport()
	{
	   
	 $objPHPExcel = Yii::app()->yexcel->activate();
    
    //$file_path=Yii::app()->getModule('admin')->getBasePath().'\views\group\files\Groupexport.xlsx';

    $objPHPExcel->getProperties()->setCreator("Site");
    $objPHPExcel->getProperties()->setLastModifiedBy("Site");
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
    
    

    $mod=Group::model()->findAll(true);
    
    $objPHPExcel->setActiveSheetIndex(0);
    $i=2;
    $objPHPExcel->getActiveSheet()->SetCellValue("A1", 'Название группы');
    foreach($mod as $m)
    {
       $objPHPExcel->getActiveSheet()->SetCellValue("A$i", $m->name);
       $i++; 
    }

    $objPHPExcel->getActiveSheet()->setTitle('Экспорт групп');
    
    		
    $path=realpath('.').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'UsersExport.xlsx';
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $objWriter->save($path);
    
		$this->render('export',array(
			'model'=>$model,'path'=>$path,
		));
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Group;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Group']))
		{
			$model->attributes=$_POST['Group'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Group']))
		{
			$model->attributes=$_POST['Group'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Group('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Group']))
			$model->attributes=$_GET['Group'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Group::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
