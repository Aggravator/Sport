<?php
    require_once '../mainlib.php';
    global $app;
    $result=array();
    $query=sprintf("select tournament.tournament_id,tournament_name,tournament_date_start, false as actual from tournament where tournament_time_limit>now() and tournament_id not in (select distinct tournament_id from participant where creator_id=%d)
union
select tournament.tournament_id,tournament_name,tournament_date_start, if(tournament_time_limit>now(),true,false) as actual from participant join tournament on tournament.tournament_id=participant.tournament_id and creator_id=%d;",$app::$user->id,$app::$user->id);
    $rs=$app::$connection->query($query);
    $result['newT']=array();
    $result['activeT']=array();
    $result['oldT']=array();
    while($temp=$rs->fetch_array()){
        if($temp['actual']==true){
            array_push($result['activeT'],array('id'=>$temp['tournament_id'],'name'=>$temp['tournament_name'],'dateStart'=>$temp['tournament_date_start']));
            continue;
        }
        if(new DateTime($temp['tournament_date_start'])>new DateTime()){
            array_push($result['newT'],array('id'=>$temp['tournament_id'],'name'=>$temp['tournament_name'],'dateStart'=>$temp['tournament_date_start']));
        }else{
            array_push($result['oldT'],array('id'=>$temp['tournament_id'],'name'=>$temp['tournament_name'],'dateStart'=>$temp['tournament_date_start']));
        }
    }
    $rs->close();
    //$result['user']=$app::$user->getPersonInfo();
    echo json_encode($result);
?>