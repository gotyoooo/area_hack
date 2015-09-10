<?php
        //ユーザIDと座標もらう
        //反映させる
        //全部プッシュ　形後で
//http://localhost/%E5%BA%A7%E6%A8%99%E3%81%AE%E3%82%84%E3%83%BC%E3%81%A4.php?room_id=0000&user_id=3&lat=100&lng=50

        //db接続
        $link = mysql_connect('localhost','root','');
        $db_selected = mysql_select_db('area_hack',$link);
        mysql_set_charset('utf8');

        $room_id = htmlspecialchars($_GET["room_id"]);
        $user_id = htmlspecialchars($_GET["user_id"]);
        $lat = htmlspecialchars($_GET["lat"]);
        $lng = htmlspecialchars($_GET["lng"]);


        $UD_sql = "UPDATE user set lat=$lat, lng=$lng WHERE user_id=$user_id;";
        $result = mysql_query($UD_sql);
        if(!$result){
                die('座標の更新失敗'.mysql_error());
        }


        $return000 = array();
        $i = 0;
        $room_zahyou_sql = "SELECT user_id FROM matching WHERE room_id=$room_id";
        $result = mysql_query($room_zahyou_sql);
        if(!$result){
                die('ユーザIDの抽出失敗'.mysql_error());
        }
        while ($data = mysql_fetch_array($result)) {
                $get_user_id = $data['user_id'];
                $sql2 = "SELECT lat,lng FROM user WHERE user_id=$get_user_id;";
                $result2 = mysql_query($sql2);           
                $return000[$i] = array();
                if(!$result2){
                        die('latの抽出失敗'.mysql_error());
                }
                $data2 = mysql_fetch_array($result2);
                $return000[$i]['user_id'] = $get_user_id;
                $return000[$i]['lat'] = $data2['lat'];
                $return000[$i]['lng'] = $data2['lng'];
                $i++;
        }

        echo json_encode($return000);
