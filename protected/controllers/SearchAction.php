<?php
if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod')) {
    Yii::app()->theme='mobile';
}

class SearchAction extends CAction
{
    const PAGE_SIZE = WortschatzController::PAGE_SIZE;

    public function run()
    {
	$search=new SearchForm;
	$controller = $this->getController();
	$controller->layout='form';
        $controller->pageDescriptionMetaTag = false; //use the default Meta-Tag

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
                        
                        // Ergebnis 1: alle Treffer die genau dem Suchbegriff entsprechen:
                        $exactSearchResults = wortschatz::model()->exactSearch($query);
                        $pages_exact = $exactSearchResults['pages'];
                        $countAll_exact = $exactSearchResults['countAll'];
                        $count_exact = $exactSearchResults['count'];
                        $sort_exact = $exactSearchResults['sort'];
                        $models_exact = $exactSearchResults['models'];

                        // Ergebnis 2: alle Treffer die den Suchbegriff als Wort enthalten (enthalten auch die genauen Treffer):
                        $wordSearchResults = wortschatz::model()->wordSearch($query);
                        $pages_word = $wordSearchResults['pages'];
                        $countAll_word = $wordSearchResults['countAll'];
                        $count_word = $wordSearchResults['count'];
                        $sort_word = $wordSearchResults['sort'];
                        $models_word = $wordSearchResults['models'];

                        // Ergebnis 3: Wort-Treffer ohne genaue Treffer (Ergebnis 2 minus Ergebnis 1):
                        $cleanedResults = wortschatz::model()->removeExactResults($models_word,$models_exact);
                        $models_cleaned = $cleanedResults['models'];

                        // Ergebnis 4: alle LIKE-Treffer (Wortteilsuche):
                        $standardSearchResults = wortschatz::model()->standardSearch($query);
                        $pages_standard = $standardSearchResults['pages'];
                        $countAll_standard = $standardSearchResults['countAll'];
                        $count_standard = $standardSearchResults['count'];
                        $sort_standard = $standardSearchResults['sort'];
                        $models_standard = $standardSearchResults['models'];

                        // Ergebnis 5: LIKE-Treffer ohne Worttreffer und exakte Treffer (Ergebnis 4 minus Ergebnis 2):
                        if ($models_word == NULL) {
                            $models_word = $models_exact;
                        }
                        $cleanedLikeResults = wortschatz::model()->removeExactResults($models_standard,$models_word);
                        $models_likeCleaned = $cleanedLikeResults['models'];
			
			if (($count_exact != 0) OR ($count_word != 0)) {
				$controller->render('search',array(
				'search'=>$search,
                                'query'=>$query,
				'models'=>$models_cleaned,
				'pages'=>$pages_standard,
				'countAll'=>$countAll_standard,
				'count'=>$count_standard,
				'sort'=>$sort_standard,
                                'models_exact'=>$models_exact,
				'pages_exact'=>$pages_exact,
				'countAll_exact'=>$countAll_exact,
				'count_exact'=>$count_exact,
				'sort_exact'=>$sort_exact,
                                'models_like'=>$models_likeCleaned,
                                    
                                ));
			} else if (($count_exact == 0) AND ($count_word == 0) AND ($count_standard != 0)) {
                                $controller->render('search',array(
                                'errortext'=>'Der exakte Suchbegriff wurde nicht gefunden. Unscharfe Ergebnisse:<br /><br />',
				'search'=>$search,
                                'query'=>$query,
				'models'=>$models_standard,
				'pages'=>$pages_standard,
				'countAll'=>$countAll_standard,
				'count'=>$count_standard,
				'sort'=>$sort_standard,
                                'models_exact'=>$models_exact,
				'pages_exact'=>$pages_exact,
				'countAll_exact'=>$countAll_exact,
				'count_exact'=>$count_exact,
				'sort_exact'=>$sort_exact,
                                'models_like'=>$models_likeCleaned,
                                ));
                            
                        } else {
                            $controller->render('search',array('search'=>$search,'errortext'=>'Keine Daten gefunden',));
                            }

		} else {
                    $controller->render('search',array('search'=>$search));
                    }

	} else {
            $controller->render('search',array('search'=>$search)); 
            }

    }
}