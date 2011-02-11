<?php

class deklinationen extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'adjektive':
	 * @var string $wort
	 * @var string $class1
	 * @var string $class2
	 * @var string $class3
	 * @var string $class4
	 * @var string $class5
	 * @var string $class6
	 * @var string $class7
	 * @var string $class8
	 * @var string $class9
	 * @var string $class10
	 * @var string $class11
	 * @var string $class15
	 * @var string $class16
	 * @var string $class17
	 * @var string $class18
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return 'deklinationen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('wort,
                            class1,
                            class2,
                            class3,
                            class4,
                            class5,
                            class6,
                            class7,
                            class8,
                            class9,
                            class10,
                            class11,
                            class15,
                            class16,
                            class17,
                            class18',
                            'type'),
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
                    'wortschatz_rel'=>array(self::HAS_MANY, 'wortschatz', 'kiswahili'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'wort' => 'Wort',
			'class1' => 'Kl. 1',
			'class2' => 'Kl. 2',
			'class3' => 'Kl. 3',
			'class4' => 'Kl. 4',
			'class5' => 'Kl. 5',
			'class6' => 'Kl. 6',
			'class7' => 'Kl. 7',
			'class8' => 'Kl. 8',
			'class9' => 'Kl. 9',
			'class10' => 'Kl. 10',
			'class11' => 'Kl. 11',
			'class15' => 'Kl. 15',
			'class16' => 'Kl. 16',
			'class17' => 'Kl. 17',
			'class18' => 'Kl. 18',
		);
	}

        /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {

        $criteria=new CDbCriteria;
        $criteria->with=array( // vorhandene Relationen in die Query einbeziehen (JOIN) als 'eager loading'
                'wortschatz_rel',
        );
        $criteria->condition = "wortschatz_rel.wortart_id = 1";
//        $criteria->select = "wort";
        $criteria->order="wort";

        return new CActiveDataProvider('deklinationen', array(
                        'criteria'=>$criteria,
        ));
    }

    /**
     * Exact Search: Retrieves a list of all results which match the search query exactly (no LIKE search)
     * Retrieve lists of models based on the search/filter conditions and different calculations
     */
    public function exactSearch($query='%', $kategorie='', $wortart='') {
        $criteria=new CDbCriteria;

        $criteria->with=array( // vorhandene Relationen in die Query einbeziehen (JOIN) als 'eager loading'
                'wortart_rel',
                'kategorie_rel',
        );
        //$criteria->select='kiswahili';  // the columns being selected
        $criteria->order="TRIM(LEADING 'a ' FROM (TRIM(LEADING '-' FROM kiswahili))), wortart_id";

        $condition="(kiswahili='$query' OR deutsch='$query' OR noun_plural_swahili='$query' OR noun_plural_deutsch='$query' OR verb_stem='$query' OR verb_infinitive='$query')";
        if ($wortart != '') {
            $condition .=" AND (wortart_rel.bezeichnung = '$wortart')";
        }
        if ($kategorie != '') {
            $condition .=" AND (kategorie_rel.bezeichnung = '$kategorie')";
        }
        $criteria->condition = $condition;

        $countAll = $this->count();
        $count = $this->count($criteria);

        $pages=new CPagination($this->count($criteria));
        $pages->pageSize=WortschatzController::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('wortschatz');
        $sort->applyOrder($criteria);

        $models = $this->findAll($criteria);

        return array(
                'models' => $models,
                'countAll' => $countAll,
                'count' => $count,
                'pages' => $pages,
                'sort' => $sort,
        );

    }

}