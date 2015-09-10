<?php
	$flag_id = htmlspecialchars($_GET["flag_id"]);
	$color = htmlspecialchars($_GET["color"]);
	$UD_flag_sql = "UPDATE flag set joukyou=".$color." WHERE flag_id=".$flag_id.";";
	//db接続
	$link = mysql_connect('localhost','root','');
	$db_selected = mysql_select_db('area_hack',$link);
	mysql_set_charset('utf8');
	$result = mysql_query($UD_flag_sql);
        
        $return = array();
        $return['judge'] = true;
	if(!$result){
		$return['judge'] = false;
	}

	echo json_encode($return);	
