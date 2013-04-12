<?php
	//Posem les funcions de consulta de la base de dades
	include_once('inc/sessio.inc');

	//INICIALITZEM LA PLANTILLA SMARTY
	include_once $Smarty_path;
	$smarty = new Smarty;
	$smarty->compile_check = true;
	$smarty->debugging = false;

	//Comprovació de seguretat
	if($_SESSION['validat']!=1){
		$smarty->display('noacces.htm');
		exit;
	}

	//Posem les funcions de consulta de la base de dades
	include_once('inc/db.php');

	//Agafem les dades dels idiomes
	$langs=getAllLanguages();
	$lang=getLang($lang);

	if(isset($_REQUEST['submit']) && $_REQUEST['submit']!=""){
		//$valida=(isset($_REQUEST['valida'])?$_REQUEST['valida']:'0');
		$titles=array(); $validates=array();
		foreach ($langs as $lang){
			$titles['titol_'.$lang['lang']]=$_REQUEST['titol_'.$lang['lang']];
			$validates['valida_'.$lang['lang']]=(isset($_REQUEST['valida_'.$lang['lang']]) && $_REQUEST['valida_'.$lang['lang']]=="on")?1:0;
		}
		#$args=array_merge(array('titol'=>$_REQUEST['titol'],'cid'=>$_REQUEST['cid'],'lang'=>$lang), $titles, $validates);
		$args=array_merge(array('cid'=>$_REQUEST['cid'],'lang'=>$lang), $titles, $validates);
		editChapter($args);
		header('location:index.php');
	}

	//Agafem les dades del capitol
	$capitols=array();
	foreach ($langs as $l){
		$capitol=getChapter(array('cid'=>$_REQUEST['id'],'validat'=>$_SESSION['validat'],'lang'=>$l['lang']));
		$capitol['name']=$l['name'];
		array_push($capitols, $capitol);
	}
	$langs=$capitols;

	$smarty->assign('langs',$langs);
	$smarty->assign('lang',$lang);

	$smarty->assign('capitol',$capitol);
	$smarty->display('edita2.htm');
?>
