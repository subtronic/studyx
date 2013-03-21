<?php

class SubjectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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

	public function actionImport()
	{
	   
    $model=new Subject;
    if(isset($_POST['Subject'])AND(CUploadedFile::getInstance($model,'xls')<>'')){   
        $model->attributes=$_POST['Subject'];
        $model->xls=CUploadedFile::getInstance($model,'xls');
        $model->action=$_POST['Subject']['action'];
        
        $path=Yii::app()->getModule('admin')->getBasePath().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'subject'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.''.$model->xls;
           
            if(Yii::app()->file->set($path)->exists){
                Yii::app()->file->set($path)->delete();
             }
                $model->xls->saveAs($path);
        $sheet_array = Yii::app()->yexcel->readActiveSheet($path);     
        $cnt++;  
        $j=1;
        while(true){
            if($sheet_array[$j]['A']<>''){
                        $j++;
                        if($model->action==0){
                            if(Subject::model()->count('name=:nm',array(':nm'=>$sheet_array[$j]['A']))>0) continue;
                            $model1= new Subject;
                            $model1->name=$sheet_array[$j]['A'];
                            if($model1->save())$cnt++;
                        } else {
                            if(Subject::model()->count('name=:nm',array(':nm'=>$sheet_array[$j]['A']))<>0) 
                            {
                                $dl=Subject::model()->findByAttributes(array('name'=>$sheet_array[$j]['A']));
                                $dl->delete();
                                $cnt++;
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

    $objPHPExcel->getProperties()->setCreator("Site");
    $objPHPExcel->getProperties()->setLastModifiedBy("Site");
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
    
    

    $mod=Subject::model()->findAll(true);
    
    $objPHPExcel->setActiveSheetIndex(0);
    $i=2;
    $objPHPExcel->getActiveSheet()->SetCellValue("A1", 'Название дисциплин');
    foreach($mod as $m)
    {
       $objPHPExcel->getActiveSheet()->SetCellValue("A$i", $m->name);
       $i++; 
    }

    $objPHPExcel->getActiveSheet()->setTitle('Экспорт дисциплин');
    
    		
    $path=realpath('.').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'SubjectsExport.xlsx';
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
		$model=new Subject;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subject']))
		{
			$model->attributes=$_POST['Subject'];
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

		if(isset($_POST['Subject']))
		{
			$model->attributes=$_POST['Subject'];
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
	 * Lists all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Subject');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Subject('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Subject']))
			$model->attributes=$_GET['Subject'];

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
		$model=Subject::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='subject-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
