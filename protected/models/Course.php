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
			array('group_id, subject, teacher', 'required'),
			array('group_id, subject, teacher, default_point', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, subject, teacher, default_point', 'safe', 'on'=>'search'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}