<?php
	//ルーム作成とデータの初期かを行うAPI

	
	//db接続
	$link = mysql_connect('localhost','root','');
	$db_selected = mysql_select_db('area_hack',$link);
	mysql_set_charset('utf8');

	//フラッグの占拠状態の初期化(0、未占拠状態にする)
	$flag_sql = "UPDATE flag set joukyou = 0;";
	$result = mysql_query($flag_sql);
	if(!$result){
		die('フラッグの占拠状況の初期化'.mysql_error());
	}


	//roomテーブルに
	//ルームID、ユーザID、部屋に入れるかのbool(真だと入れる←デフォ真
	$owner_id = htmlspecialchars($_GET["user_id"]);		//ユーザID
	$add_sql = "INSERT INTO room(owner_id) VALUES ( ". $owner_id .");";
	// echo $add_sql;
	$result = mysql_query($add_sql);
	if(!$result){
		die('add失敗'.mysql_error());
	}


	//ルームID取得
	$room_sql = "SELECT MAX(room_id) FROM room WHERE owner_id=" . $owner_id .";";
	$result = mysql_query($room_sql);
	if(!$result){
		die('roomへのadd失敗'.mysql_error());
	}
	while($data = mysql_fetch_array($result)){
		$room_id = $data['MAX(room_id)'];
	}



	//matchingテーブルに
	//ルームID、ユーザID、チーム情報(ホストは1固定)
	$matching_sql = "INSERT INTO matching(room_id,user_id,color) VALUES (" . $room_id .", ". $owner_id .",'1')";
	$result = mysql_query($matching_sql);
	if(!$result){
		die('matchingへのadd失敗'.mysql_error());
	}

	//切断
	$close_flag = mysql_close($link);
	if(!$close_flag){
		die('切断失敗'.mysql_error());
	}


	//JSONに変換して出力
	$return = array();
	$return['room_id']=$room_id;
	echo json_encode($return);
