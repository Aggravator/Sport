<?php
    require_once '../mainlib.php';
    global $app;
    if($app::$user instanceof AdminUser){
        $post=json_decode($HTTP_RAW_POST_DATA,true);
        $query=sprintf("delete  from participant where creator_id=%d and tournament_id=%s",$_GET['cid'],$_GET['tournament']);
        $app::$connection->query($query);
        $pattern="('%s','%s','%s',%d,%d,%d,%s,%d,%d,'%s',%s)";
            $query="insert into participant(participant_surname,participant_name,participant_patronymic,tournament_id,creator_id,club_id,participant_is_male,participant_weight,rank_id,participant_date_birthday,participant_is_approved) values ";
        for($i=0;$i<count($post['athlets']);++$i){
            $temp=$post['athlets'][$i];
            if($i!=0)$query.=",";
            $status="NULL";
            if($temp['status']==1)$status='true';else if($temp['status']==="0")$status='false';
            $query.=sprintf($pattern,$temp['surname'],$temp['name'],$temp['patronymic'],$_GET['tournament'],$_GET['cid'],$app::$user->getPersonInfo()['club'],$temp['gender']['value'],$temp['weight'],$temp['rank']['value'],date("Y.m.d",strtotime($temp['dateBirthday'])),$status);
        }
        //echo $query;
        $app::$connection->query($query.";");
        echo "{\"result\":\"success\"}";
    }
?>