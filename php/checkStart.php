<?php
//GET
$room_id = htmlspecialchars($_GET["room_id"]);

//DBに接続
$link = mysql_connect('localhost', 'root', '');
$db_selected = mysql_select_db('area_hack', $link);
mysql_set_charset('utf8');

$sql = "SELECT status FROM room WHERE room_id = $room_id";
$result = mysql_query($sql);
if(!$result){
    die('エラー'.mysql_error());
}

$data = mysql_fetch_assoc($result);
$status = $data['status'];

//データを取得
$return = array();
// スコア判定
$return['judge'] = false;
if ($status == 2) {
    $return['judge'] = true;
}

//DBを切断
$close_flag = mysql_close($link);

echo json_encode($return);
