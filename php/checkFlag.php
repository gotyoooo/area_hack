<?php
//GET
$room_id = htmlspecialchars($_GET["room_id"]);

//DBに接続
$link = mysql_connect('localhost', 'root', '');
$db_selected = mysql_select_db('area_hack', $link);
mysql_set_charset('utf8');

//本来はこっちでやるべき
//$sql = "SELECT * FROM flag WHERE room_id = $room_id";
$sql = "SELECT * FROM flag";
$result = mysql_query($sql);
if(!$result){
    die('エラー'.mysql_error());
}

//データを取得
$score = 0;
$i = 0;
$return = array();
$return['flag_info'] = array();
while ($data = mysql_fetch_assoc($result)) {
    $return['flag_info'][$i] = array();
    $return['flag_info'][$i]['flag_id'] = $data['flag_id'];
    $return['flag_info'][$i]['joukyou'] = $data['joukyou'];
    $score = $score + $data['joukyou'];
    $i++;
}

// スコア判定
$return['judge'] = false;
if ($score > 2 || $score < -2) {
    $return['judge'] = true;
}

//DBを切断
$close_flag = mysql_close($link);

echo json_encode($return);
