<?php
    require_once '../mainlib.php';
    global $app;
    if($app::$user instanceof CouchUser){
        $result=array();
        $query=sprintf("select *,rank_id+0 as rank from participant where tournament_id=%s and creator_id=%d;",$_GET['tournament'],$app::$user->id);
        $rs=$app::$connection->query($query);
        $result['sportmans']=array();
        while ($temp=$rs->fetch_array()) {
            array_push($result['sportmans'],array('pid'=>$temp['participant_id'],'cid'=>$temp['creator_id'],'name'=>$temp['participant_name'],'surname'=>$temp['participant_surname'],'patronymic'=>$temp['participant_patronymic'],'dateBirthday'=>$temp['participant_date_birthday'],'weight'=>$temp['participant_weight'],'ismale'=>$temp['participant_is_male'],'rank'=>$temp['rank_id'],'status'=>$temp['participant_is_approved']));
        };
        $rs->close();
        $query=sprintf("select tournament_minAge,tournament_maxAge from tournament where tournament_id=%s;",$_GET['tournament']);
        $rs=$app::$connection->query($query);
        $temp=$rs->fetch_array();
        $result['minAge']=$temp['tournament_minAge'];
        $result['maxAge']=$temp['tournament_maxAge'];
        $rs->close();
        echo json_encode($result);
    }
?>