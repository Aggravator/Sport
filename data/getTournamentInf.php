<?php
    require_once '../mainlib.php';
    global $app;
    //if($app::$user instanceof AdminUser){
        $rs=$app::$connection->query("select tournament_name as name,tournament_type+0 as type,tournament_address as place,tournament_minAge as minAge,tournament_maxAge as maxAge,tournament_date_start as dateStart,tournament_time_limit as timeLimit,tournament_organaizer as organaizer,sport_id,tournament_main_judge as judge from tournament where tournament_id=".$_GET['tid']);
        $temp=$rs->fetch_array();
        $dateStart=date("Y.m.d",strtotime($temp['dateStart']));
        $acceptDate=date("Y.m.d",strtotime($temp['timeLimit']));
        $acceptHour=date("H",strtotime($temp['timeLimit']));
        $acceptMin=date("i",strtotime($temp['timeLimit']));
        $result=array('name'=>$temp['name'],'type'=>$temp['type'],'place'=>$temp['place'],'birthdayStart'=>$temp['minAge'],'birthdayEnd'=>$temp['maxAge'],'dateStart'=>$dateStart,'organaizer'=>$temp['organaizer'],'sport'=>$temp['sport_id'],'acceptDate'=>$acceptDate,'acceptHour'=>$acceptHour,'acceptMinute'=>$acceptMin,'mainJudge'=>$temp['judge']);
        $rs->close();
        echo json_encode($result);
    //}
?>