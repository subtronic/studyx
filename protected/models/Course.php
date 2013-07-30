<?php

/**
 * This is the model class for table "courses".
 *
 * The followings are the available columns in table 'courses':
 * @property integer $id
 * @property integer $group_id
 * @property integer $subject
 * @property integer $teacher
 * @property integer $default_point
 * @property integer $allowAllView
 * @property integer $min_rating
 * @property integer $med_rating
 * @property integer $max_rating
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Course the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, subject, teacher, allowAllView', 'required'),
			array('group_id, subject, teacher, default_point,allowAllView,min_rating, med_rating, max_rating', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, subject, teacher, default_point, allowAllView,min_rating, med_rating, max_rating', 'safe', 'on'=>'search, createProgramPoint'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'users'=>array(self::BELONGS_TO,'User','teacher'),
            'subjects'=>array(self::BELONGS_TO,'Subject','subject'),
            'groups'=>array(self::BELONGS_TO,'Group','group_id'),
            'themes'=>array(self::HAS_MANY,'Theme','id'),
        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Группа',
			'subject' => 'Дисциплина',
			'teacher' => 'Преподаватель',
			'default_point' => 'Балл за посещение',
            'allowAllView'=>'Разрешить просмотр всем студентам группы',
			'min_rating' => 'Проходной балл',
			'med_rating' => 'Количество баллов на оценку хорошо',
			'max_rating' => 'Количество баллов на оценку отлично',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('subject',$this->subject);
		$criteria->compare('teacher',$this->teacher);
		$criteria->compare('default_point',$this->default_point);
        $criteria->compare('allowAllView',$this->allowAllView);
        $criteria->compare('min_rating',$this->min_rating);
		$criteria->compare('med_rating',$this->med_rating);
		$criteria->compare('max_rating',$this->max_rating);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}