<?php
//GET
$room_id = htmlspecialchars($_GET["room_id"]);
$user_id = htmlspecialchars($_GET["user_id"]);

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
if ($count_room_user > 3 || $count_room_user == 0) {
    $return['judge'] = false;
} else {
    // colorわけの処理
    $color = 1;
    if ($count_room_user == 1 || $count_room_user == 3) {
        $color = -1;
    } 

    $sql = "INSERT INTO matching(room_id,user_id,color) VALUES($room_id, $user_id, $color)";
    $result = mysql_query($sql);
    if(!$result){
        die('エラー2'.mysql_error());
    }
    $return['judge'] = true;
}


//DBを切断
$close_flag = mysql_close($link);

echo json_encode($return);
