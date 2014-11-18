<?php
    require_once '../mainlib.php';
    global $app;
    if($app::$user instanceof AdminUser){
        $result=array();
        $query=sprintf("select *,rank_id+0 as rank from participant where tournament_id=%s and creator_id=%d;",$_GET['tournament'],$_GET['cid']);
        $rs=$app::$connection->query($query);
        $result['sportmans']=array();
        while ($temp=$rs->fetch_array()) {
            array_push($result['sportmans'],array('pid'=>$temp['participant_id'],'name'=>$temp['participant_name'],'surname'=>$temp['participant_surname'],'patronymic'=>$temp['participant_patronymic'],'dateBirthday'=>$temp['participant_date_birthday'],'weight'=>$temp['participant_weight'],'ismale'=>$temp['participant_is_male'],'rank'=>$temp['rank_id'],'status'=>$temp['participant_is_approved']));
        };
        $rs->close();
        $query="select concat(surname,\" \",Left(name,1),\".\",Left(patronymic,1),\".\") as fio, club_shortname  from users join club on users.club_id=club.club_id where id=1 ";
        $rs=$app::$connection->query($query);
        $temp=$rs->fetch_array();
        $result['creator']=$temp['fio'];
        $result['club']=$temp['club_shortname'];
        $rs->close();
        echo json_encode($result);
    }
?>