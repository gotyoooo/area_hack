<?php
/**
 * Created by PhpStorm.
 * User: era
 * Date: 15/09/05
 * Time: 15:03
 */
//ユーザーネームを取得
$name = htmlspecialchars($_GET["user_name"]);
//DBに接続
$link = mysql_connect('localhost','root','');
$db_selected = mysql_select_db('area_hack',$link);
mysql_set_charset('utf8');
//取得したユーザーネームをインサート
$sql = "INSERT INTO user (user_name) VALUES ('$name')";
//echo $sql;
//sql文を作成して実行
$result = mysql_query($sql);
if(!$result){
    die('エラー'.mysql_error());
}
$sql = "SELECT MAX(user_id),user_name FROM user WHERE user_name = '$name'";
//echo $sql;
$result = mysql_query($sql);
if(!$result){
    die('エラー2'.mysql_error());
}
//データを取得
$data = mysql_fetch_assoc($result);
//変数にDBから取得したデータの格納
$cb_id = $data['MAX(user_id)'];
$cb_name = $data['user_name'];
////DBを切断
//$close_flag = mysql_close($link);
//if($close_flag){
//    print('<p>切断に成功しました。</p>');
//}
$return = array();
$return['user_id']=$cb_id;
$return['user_name']=$cb_name;
print json_encode($return);
