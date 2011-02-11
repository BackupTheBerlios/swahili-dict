<?php $this->pageTitle=Yii::app()->name . ' - Online Resourcen'; ?>

<h1>Online Resourcen</h1>

<h3>Kiswahili allgemein</h3>
<ul>
     <li><a href="http://kamusiproject.org/en" target="_blank">Kamusi Project</a> W&ouml;rterbuch, Lernhilfe etc. (in Englisch)</li>
     <li><a href="http://www.webkenya.com/eng/kiswahili/index.php" target="_blank">webkenya</a> W&ouml;rterbuch, Grammatik, Aussprache (in Englisch)</li>
     <li><a href="http://mwanasimba.online.fr/E_index.html" name="" target="_blank">Mwana Simba</a> Grammatik, W&ouml;rterbuch, Sprichw&ouml;rter, Verbformen-Builder, Tabellen etc. (in English oder Franz&ouml;sisch)</li>
	 <li><a href="http://www.swahili.de/" name="" target="_blank">swahili.de</a></li>
</ul>
<h3>Kiswahili W&ouml;rterb&uuml;cher</h3>
<ul>
     <li><a href="http://africanlanguages.com/swahili/" name="Online Swahili - English Dictionary (http://africanlanguages.com)" target="_self">Online Swahili - English Dictionary (http://africanlanguages.com)</a></li>
	 <li><a href="http://kamusiproject.org/en/dictionaries" name="" target="_blank">Kamusi Project Dictionary</a> (English-Swahili)</li>
	 <li><a href="http://www.dicts.info/2/german-swahili.php" name="Deutsch-Swahili-Deutsch (www.dicts.info)" target="_self">German-Swahili-German (www.dicts.info)</a></li>
     <li><a href="http://www.freedict.com/onldict/swa.html" name="English to Swahili Dictionary (www.freedict.com)" target="_self">English to Swahili Dictionary (www.freedict.com)</a></li>
     <li><a href="http://www.freelang.net/online/swahili.php" name="FREELANG Swahili-English and English-Swahili online dictionary" target="_self">FREELANG Swahili-English and English-Swahili online dictionary</a></li>
	 <li><a href="http://mwanasimba.online.fr/lexicon/lexicon/main.htm" name="" target="_blank">Woerterverzeichnis Swahili-Englisch (Mwana Simba)</a></li>
</ul>

<h3>Kiswahili Grammatik</h3>
<ul>
	 <li><a href="http://mwanasimba.online.fr/E_TABLE.htm" name="" target="_blank">Grammatik (Mwana Simba - in Englisch)</a></li>
	 <li><a href="http://www.webkenya.com/eng/kiswahili/grammar.php" name="" target="_self">WebKenya</a> (Kiswahili Grammer in english)</li>
	 <li><a href="http://www.kwangu.com/swahili/" name="" target="_blank">Karibu Kwangu</a> Kiswahili Grammer Page - Kleine Onlineprogramme um Wortstamm oder sonstige Grundformen zu ermitteln, damit man sie in einem  W&ouml;rterbuch nachschauen kann. (z.B. Verb Parser, Verb Derivator, Verb builder, Analyzer (in Englisch)</li>
	 
</ul>

<h3>Grammatik sonstige</h3>
<ul>
	 <li><a href="http://www.canoo.net/" name="" target="_blank">canoo.net - Deutsche W&ouml;rterb&uuml;cher und Grammatik</a></li>
	 <li><a href="http://de.wikibooks.org/wiki/Deutschunterricht/_Grammatik/_Grammatische_Grundbegriffe" name="" target="_blank">Grammatische Grundbegriffe (Deutsch)</a></li>
	 <li><a href="http://www.vokabeln.de/v4/vorschau/Swahili_Alltag.htm" name="" target="_blank">Langenscheidt Vokabeltrainer Grundwortschatz</a></li>
</ul>

<h3>Programmierung</h3>
<ul>
	 <li><a href="http://www.php.net/manual/de/" name="" target="_blank">PHP Manual</a></li>
	 <li><a href="http://www.php.net/manual/de/intro.pdo.php" name="" target="_blank">PHP-Manual: PHP Data Objects (PDO)</a></li>
	 <li><a href="http://dev.mysql.com/doc/refman/4.1/en/index.html" name="" target="_blank">MySQL Manual</a></li>
	 <li><a href="http://dev.mysql.com/doc/refman/5.0/en/fulltext-search.html" name="" target="_blank">MySQL Full Text Search Functions</a></li>
	 <li><a href="http://www.jquery.com">JQuery</a>  Das JavaScript Framework, das auf dieser Seite verwendet wurde.</li>
	 <li><a href="http://www.datatables.net" name="" target="_blank">DataTables (JQuery Plugin)</a></li>
	 <li><a href="http://www.phpro.org/tutorials/Introduction-to-PHP-PDO.html">Introduction to PHP Data Objects</a></li>
         <li><a href="http://blog.dmcinsights.com/2009/10/15/understanding-mvc-part-3/#more-523">Larry Ullman's Blog - Understanding MVC: Coding</a>
</ul>


<h1>Interne Notizen</h1>
<b>Wortarten</b>
<ul>
 <li>Nomen (Substantiv, Hauptwort)</li>
 <li>Verb (T&auml;tigkeitswort)</li>
 <li>Adjektiv (Eigenschaftswort)</li>
 <li>[Pronomen (F&uuml;rwort)]</li>
 <li>Adverb (Umstandswort)</li>
 <li>[Pr&auml;position/Verh&auml;ltniswort]</li>
 <li>[Konjunktion]</li>
 <li>Unflektierbar</li>
 <li>Ausdruck</li>
 <li>Beispiel</li>
</ul>
<br/>
<b>Kategorien</b>
<ul>
 <li>Allgemein</li>
 <li>Einkaufen</li>
 <li>Essen</li>
 <li>Haus &amp; Haushalt</li>
 <li>Natur &amp; Tiere</li>
 <li>Arbeit</li>
 <li>Computer</li>
 <li>Gespr&auml;che &amp; Telefon</li>
 <li>Ort</li>
 <li>Zeit</li>
</ul>
<h3>Triggers</h3>
<p>In der Datenbank ist folgender Trigger definiert (UPDATE: Der Trigger wurde wieder aus der Datenbank entfernt und wird jetzt in der Applikation via Validation-Rule realisiert.):</p>
<pre>
CREATE TRIGGER insert_verb BEFORE INSERT ON wortschatz<br/>
  FOR EACH ROW <br/>
  BEGIN<br/>
    IF NEW.wortart = 'Verb'<br/>
       THEN <br/>
       SET NEW.verb_infinitive = concat('ku', TRIM(LEADING '-' FROM NEW.kiswahili));<br/>
       SET NEW.verb_stem = TRIM(LEADING '-' FROM NEW.kiswahili);<br/>
    END IF;<br/>
  END;<br/>
</pre>
<p>(Dank an Sunny Walia f&uuml;r <a href="http://crazytoon.com/2008/03/03/mysql-error-1442-hy000-cant-update-table-t1-in-stored-functiontrigger-because-it-is-already-used-by-statement-which-invoked-this-stored-functiontrigger/" target="_self">diese L&ouml;sung </a>)</p>

<p>Die Triggers sind in der Informations-Datenbank INFORMATION_SCHEMA in der Tabelle 'triggers' gespeichert. Um den Inhalt der Datenbank anzusehen kann man diesen Befehl verwenden:</p>
<pre>
SELECT table_name FROM INFORMATION_SCHEMA.TABLES<br/>
WHERE table_schema = 'INFORMATION_SCHEMA'<br/>
AND table_name LIKE '%';<br/>
</pre>

<h3>Zeichens&auml;tze und Suche:</h3>
<p>Als Zeichensatz wird UTF-8 verwendet. Als Kollation der MySQL-Datenbank-Tabellen wird generell "utf8_general_ci" verwendet.
    Diese Kollation unterscheidet keine Umlaute von den entsprechenden Vokalen, ist aber case-insensitive, d.h. es beachtet keine Gross-/Kleinschreibung.<br />
    Es gibt nur 2 Ausnahmen: Die Spalten "deutsch" und "noun_plural_deutsch" in der Tabelle "wortschatz". Diese haben die Kollation "utf8_bin", damit die Umlaute richtig gefunden werden.
    Um das Problem mit der Gross-/Kleinschreibung zu umgehen, wird so gesucht: select ... where lower(deutsch) = lower('$query') ...<br />
<br />
<b>UTF8-Kollationen in MySQL:</b><br />
utf8_general_ci (A=Ä, U=Ü, O=Ö, case-insensitive) schneller als utf8_unicode_ci<br />
utf8_unicode_ci (wie utf8_general_ci plus ß=ss) <br />
utf8_bin (alle Umlaute werden von den Vokalen unterschieden aber es wird auch immer case-sensitive verglichen)<br />


</p>


<h1>Yii-Framework</h1>
<h3>Grundsätzliches zum Yii-Framework</h3>
<ul>
	<li>Bei Yii ist die Datei "index.php" das sogenannte "bootstrap script", d.h. die Ladedatei, die als erstes ausgeführt wird.</li>
	<li>Dieses bootstrap script erzeugt eine Instanz der Klasse CWebApplication, d.h. es wird ein Exemplar einer Yii-Webapplikation erzeugt.</li>
	<li>Diese Applikation kann nun die vom Browser angeforderte Webadresse - bzw. die sogenannte Route - auflösen. Die Route ist als Parameter an die URL angehängt und gibt zuerst den zu verwendenden "Controller" an und dann die auszuführende "Action". Beispiel: Die Webadresse http://swahili.ndanda-projekt.info/index.php?r=site/notes gibt an, dass der Controller "SiteController.php" verwendet werden soll und darin die Action "actionNotes()"</li>
	<li>In der Datenbank</li>
</ul>


<h3>Logging</h3>
<p>Man kann alle Aktivitäten, die Yii im Hintergrund ausführt, live auf der Webseite sehen. Dies ist z.B. beim Datenbankzugriff sehr nützlich, um die ausgeführte Query zu sehen.<br/>
Dazu muss die Log-Componente in <em>[projektverzeichnis]/protected/config/main.php</em> folgendermassen angepasst werden (rot): 
</p>
<pre>'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                <font color="red">array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace,info, error, warning',
                ),</font>
            ),
        ),
</pre>
<h3>Zeichensatz/Encoding</h3>
<p>
Wenn der Zeichensatz geändert werden muss, muss dies an zahlreichen verschiedenen Stellen gemacht werden. Eine Mischung verschiedener Zeichensätze funktioniert nicht.<br/>
Eine genaue, umfassende Anleitung gibt es hier: <a href="http://www.yiiframework.com/doc/cookbook/16/" target="_blank">http://www.yiiframework.com/doc/cookbook/16/</a> <br />
Das Wesentliche kurz zusammengefasst:
<ul>
	<li>Im Editor, mit dem die Applikation geschrieben wird (d.h. die Textfiles müssen die richtige Codierung haben.)</li>
	<li>In der Dokumentendeklaration der XHTML Seite (zur Darstellung im Browser)</li>
	<li>In der Yii-Applikation</li>
		<ul>
			<li>1. charset-Eigenschaft der Web-Applikation in <em>[projektverzeichnis]/protected/config/main.php</em>
			<pre>// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Kiswahili-Deutsch Wörterbuch',
	<font color="red">'charset'=>'UTF-8',</font></pre>
			</li>
			<li>2. charset-Eigenschaft der Datenbank-Verbindung in <em>[projektverzeichnis]/protected/config/main.php</em>
			<pre>'db'=>array(
            'class'=>'CDbConnection',
			//'connectionString'=>'mysql:host=ndandap.mysql.db.internal;dbname=ndandap_dict',
            //'username'=>'ndanda_dict',
            //'password'=>'dict',
            'connectionString'=>'mysql:host=localhost;dbname=ndandap_dict',
            'username'=>'elias',
            'password'=>'elias',<font color="red">
			'charset'=>'utf8',</font>
		),</pre>
			</li>
		</ul>
	<li>In der Datenbank</li>
</ul>
</p>



