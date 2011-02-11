<?php
/*!
 * upload demo for php
 * @requires xhEditor
 * 
 * @author Yanis.Wang<yanis.wang@gmail.com>
 * @site http://pirate9.com/
 * @licence LGPL(http://www.opensource.org/licenses/lgpl-license.php)
 * 
 * æ³¨ï¼æ¬ç¨åºä»ä¸ºæ¼ç¤ºç¨ï¼è¯·æ¨æ ¹æ®èªå·±éæ±è¿è¡ç¸åºä¿®æ¹ï¼æèéå¼åã
 */
header('Content-Type: text/html; charset=UTF-8');

function uploadfile($inputname)
{
	$attachdir='upload';//ä¸ä¼ æä»¶ä¿å­è·¯å¾ï¼ç»å°¾ä¸è¦å¸¦/
	$dirtype=1;//1:æå¤©å­å¥ç®å½ 2:ææå­å¥ç®å½ 3:ææ©å±åå­ç®å½  å»ºè®®ä½¿ç¨æå¤©å­
	$maxattachsize=2097152;//æå¤§ä¸ä¼ å¤§å°ï¼é»è®¤æ¯2M
	$upext='txt,rar,zip,jpg,jpeg,gif,png,swf,avi';//ä¸ä¼ æ©å±å
	
	$err = "";
	$msg = "";
	$upfile=$_FILES[$inputname];
	if(!empty($upfile['error']))
	{
		switch($upfile['error'])
		{
			case '1':
				$err = 'æä»¶å¤§å°è¶è¿äºphp.iniå®ä¹çupload_max_filesizeå¼';
				break;
			case '2':
				$err = 'æä»¶å¤§å°è¶è¿äºHTMLå®ä¹çMAX_FILE_SIZEå¼';
				break;
			case '3':
				$err = 'æä»¶ä¸ä¼ ä¸å®å¨';
				break;
			case '4':
				$err = 'æ æä»¶ä¸ä¼ ';
				break;
			case '6':
				$err = 'ç¼ºå°ä¸´æ¶æä»¶å¤¹';
				break;
			case '7':
				$err = 'åæä»¶å¤±è´¥';
				break;
			case '8':
				$err = 'ä¸ä¼ è¢«å¶å®æ©å±ä¸­æ­';
				break;
			case '999':
			default:
				$err = 'æ ææéè¯¯ä»£ç ';
		}
	}
	elseif(empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none')$err = 'æ æä»¶ä¸ä¼ ';
	else
	{
			$temppath=$upfile['tmp_name'];
			$fileinfo=pathinfo($upfile['name']);
			$extension=$fileinfo['extension'];
			if(preg_match('/'.str_replace(',','|',$upext).'/i',$extension))
			{
				$filesize=filesize($temppath);
				if($filesize <= $maxattachsize)
				{
					switch($dirtype)
					{
						case 1: $attach_subdir = 'day_'.date('ymd'); break;
						case 2: $attach_subdir = 'month_'.date('ym'); break;
						case 3: $attach_subdir = 'ext_'.$extension; break;
					}
					$attach_dir = $attachdir.'/'.$attach_subdir;
					if(!is_dir($attach_dir))
					{
						@mkdir($attach_dir, 0777);
						@fclose(fopen($attach_dir.'/index.htm', 'w'));
					}
					PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
					$filename=date("YmdHis").mt_rand(1000,9999).'.'.$extension;
					$target = $attach_dir.'/'.$filename;
					
					move_uploaded_file($upfile['tmp_name'],$target);
					$msg=$target;
				}
				else $err='æä»¶å¤§å°è¶è¿'.$maxattachsize.'å­è';
			}
			else $err='ä¸ä¼ æä»¶æ©å±åå¿éä¸ºï¼'.$upext;

			@unlink($temppath);
	}
	return array('err'=>$err,'msg'=>$msg);
}

$state=uploadfile('upload');
echo json_encode($state);

?>