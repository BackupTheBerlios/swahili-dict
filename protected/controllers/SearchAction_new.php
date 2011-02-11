<?php

class SearchAction extends CAction
{
    const PAGE_SIZE = WortschatzController::PAGE_SIZE;
    
    public function run()
    {
	$search=new SearchForm;
	$controller = $this->getController();
	$controller->layout='form';

	if(isset($_GET['SearchForm']))
	{
		$search->attributes=$_GET['SearchForm'];
		if($search->validate())
		{
			if($search->searchq=='') {
                            $query = '%';
                        } else
                        {
                            $query = $search->searchq;
                        }
			$kategorie = $search->kategorie;
			$wortart = $search->wortart;
                        $klasse = '';

                        // Suchoptionen filtern:
                        $filteredResults = wortschatz::model()->filterSearchOptions($kategorie, $wortart, $klasse);
                        
                        // alle genauen Treffer:
                        $exactSearchResults = wortschatz::model()->exactSearch($filteredResults, $query);
                        $pages_exact = $exactSearchResults['pages'];
                        $countAll_exact = $exactSearchResults['countAll'];
                        $count_exact = $exactSearchResults['count'];
                        $sort_exact = $exactSearchResults['sort'];
                        $models_exact = $exactSearchResults['models'];

                        $linkedExactResults = wortschatz::model()->addLinks($models_exact);
                        $models_exact_linked = $linkedExactResults['models'];

                        // alle LIKE-Treffer:
                        $standardSearchResults = wortschatz::model()->standardSearch($filteredResults, $query);
                        $pages_standard = $standardSearchResults['pages'];
                        $countAll_standard = $standardSearchResults['countAll'];
                        $count_standard = $standardSearchResults['count'];
                        $sort_standard = $standardSearchResults['sort'];
                        $models_standard = $standardSearchResults['models'];

                        // LIKE-Treffer ohne genaue Treffer:
                        $cleanedResults = wortschatz::model()->removeExactResults($models_standard,$models_exact);
                        $linkedResults = wortschatz::model()->addLinks($cleanedResults['models']);
                        $models_linked = $linkedResults['models'];
			
			if (($count_exact != 0) OR ($count_standard != 0)) {
				$controller->render('search',array(
				'search'=>$search,
                                'query'=>$query,
				'models'=>$models_linked,
				'pages'=>$pages_standard,
				'countAll'=>$countAll_standard,
				'count'=>$count_standard,
				'sort'=>$sort_standard,
                                'models_exact'=>$models_exact_linked,
				'pages_exact'=>$pages_exact,
				'countAll_exact'=>$countAll_exact,
				'count_exact'=>$count_exact,
				'sort_exact'=>$sort_exact,
                                ));
			} else {
				$controller->render('search',array('search'=>$search,'errortext'=>'Keine Daten gefunden',));
			}
		}
			else
			{
				$controller->render('search',array('search'=>$search,));
			}
	}
		else
		{
			$controller->render('search',array('search'=>$search,));
		}

    }
}