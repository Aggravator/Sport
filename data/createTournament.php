<?php
    require_once '../mainlib.php';
    global $app;
    if($app::$user instanceof AdminUser){
        $post=json_decode($HTTP_RAW_POST_DATA,true);
        $query="insert into tournament(tournament_name,tournament_type,tournament_address,tournament_minAge,tournament_maxAge,tournament_date_start,tournament_time_limit,tournament_organaizer,sport_id,tournament_main_judge) values ('%s',%d,'%s',%d,%d,'%s','%s','%s',%d,'%s');";
        $dateStart=date("Y-m-d",strtotime(str_replace('.', '-', $post['dateStart'])));
        $timeLimit=date("Y-m-d",strtotime(str_replace('.', '-',$post['acceptDate'])))." ".$post['acceptHour'].":".$post['acceptMinute'];
        $query=sprintf($query,$post['name'],$post['type'],$post['place'],$post['birthdayStart'],$post['birthdayEnd'],$dateStart,$timeLimit,$post['organaizer'],$post['sport'],$post['mainJudge']);
        $rs=$app::$connection->query($query);
        echo "{\"result\":\"success\"}";
    }
?>