<?php
    require_once '../mainlib.php';
    global $app;
    if($app::$user instanceof AdminUser){
        $post=json_decode($HTTP_RAW_POST_DATA,true);
        $query="update tournament set tournament_name='%s',tournament_type=%d,tournament_address='%s',tournament_minAge='%d',tournament_maxAge='%d',tournament_date_start='%s',tournament_time_limit='%s',tournament_organaizer='%s',sport_id='%d',tournament_main_judge='%s' where tournament_id=%d;";
        $dateStart=date("Y-m-d",strtotime(str_replace('.', '-',$post['dateStart'])));
        $timeLimit=date("Y-m-d",strtotime(str_replace('.', '-',$post['acceptDate'])))." ".$post['acceptHour'].":".$post['acceptMinute'];
        $query=sprintf($query,$post['name'],$post['type'],$post['place'],$post['birthdayStart'],$post['birthdayEnd'],$dateStart,$timeLimit,$post['organaizer'],$post['sport'],$post['mainJudge'],$_GET['tid']);
        $rs=$app::$connection->query($query);
        echo "{\"result\":\"success\"}";
    }
?>