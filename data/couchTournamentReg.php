<?php
    require_once '../mainlib.php';
    global $app;
    if($app::$user instanceof CouchUser){
        $post=json_decode($HTTP_RAW_POST_DATA,true);
        $query=sprintf("select now()<tournament_time_limit as timelimit,if(isNull(participant.tournament_id),true,false) as alr from tournament left join participant on (tournament.tournament_id=participant.tournament_id) where tournament.tournament_id=%d;",$post['tournament']);
        $rs=$app::$connection->query($query);
        $temp=$rs->fetch_array();
        if($temp['timelimit']==true && $temp['alr']==true){
            $pattern="('%s','%s','%s',%d,%d,%d,%s,%d,%d,'%s')";
            $query="insert into participant(participant_surname,participant_name,participant_patronymic,tournament_id,creator_id,club_id,participant_is_male,participant_weight,rank_id,participant_date_birthday) values ";
            for($i=0;$i<count($post['athlets']);++$i){
                $temp=$post['athlets'][$i];
                if($i!=0)$query.=",";
                $club=$app::$user->getPersonInfo();
                $club=$club['club'];
                $query.=sprintf($pattern,$temp['surname'],$temp['name'],$temp['patronymic'],$post['tournament'],$app::$user->id,$club,$temp['gender']['value'],$temp['weight'],$temp['rank']['value'],date("Y.m.d",strtotime($temp['dateBirthday'])));
            }
            $app::$connection->query($query.";");
            echo "{\"result\":\"success\"}";
        }else{
            echo "Данная программа вам недоступна";
        }
    }
?>