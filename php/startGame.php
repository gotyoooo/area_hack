<?php
/**
 * Created by PhpStorm.
 * User: era
 * Date: 15/09/05
 * Time: 15:03
 */
//ユーザーネームを取得
$room_id = htmlspecialchars($_GET["room_id"]);
//DBに接続
$link = mysql_connect('localhost','root','');
$db_selected = mysql_select_db('area_hack',$link);
mysql_set_charset('utf8');

//roomをstart状態にする
$sql = "UPDATE room SET status = 2 WHERE room_id = $room_id";
//echo $sql;
//sql文を作成して実行
$result = mysql_query($sql);

$return = array();
$return['judge']=true;
if(!$result){
    $return['judge'] = false;
}
print json_encode($return);
