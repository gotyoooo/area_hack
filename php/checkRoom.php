<?php
//GET
$room_id = htmlspecialchars($_GET["room_id"]);

//DBに接続
$link = mysql_connect('localhost', 'root', '');
$db_selected = mysql_select_db('area_hack', $link);
mysql_set_charset('utf8');

$sql = "SELECT COUNT(user_id) FROM matching WHERE room_id = $room_id";
$result = mysql_query($sql);
if(!$result){
    die('エラー'.mysql_error());
}

//データを取得
$data = mysql_fetch_assoc($result);
//変数にDBから取得したデータの格納
$count_room_user = $data['COUNT(user_id)'];
$return = array();
if ($count_room_user > 3 || $count_room_user === 0) {
    $return['judge'] = true;
} else {
    $return['judge'] = false;
}

//ユーザリスト取得
$return['user_info'] = array();
$sql = "SELECT user.user_id, user_name,color FROM matching INNER JOIN user ON matching.user_id = user.user_id WHERE room_id = $room_id";
$result = mysql_query($sql);
if(!$result){
    die('エラー'.mysql_error());
}
$i = 0;
while($data = mysql_fetch_assoc($result)) {
    $return['user_info'][$i] = array();
    $return['user_info'][$i]['user_id'] = $data['user_id'];
    $return['user_info'][$i]['user_name'] = $data['user_name'];
    $return['user_info'][$i]['color'] = $data['color'];
    $i++;
}

//DBを切断
$close_flag = mysql_close($link);

echo json_encode($return);
