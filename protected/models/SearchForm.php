<?php

/**
 * SearchForm class.
 * SearchForm is the data structure for keeping
 * search form data. It is used by the 'search' action of 'WortschatzController'.
 */
class SearchForm extends CFormModel
{
	public $searchq;
	public $kategorie;
	public $wortart;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// search query required
			array('searchq', 'validateSearch'),
                        array('kategorie', 'validateSearch'),
                        array('wortart', 'validateSearch'),
		);
	}
	
	/**
	 * Validates the query.
	 * This is the 'validateSearch' validator as declared in rules().
	 */
	public function validateSearch($attribute,$params)
	{
			if ($this->searchq == '')
			{
			    $this->addError('searchq','Bitte Suchbegriff eingeben.');
			}
	}


	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'searchq'=>'Suche',
		);
	}
}