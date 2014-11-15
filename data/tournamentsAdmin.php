<?php
    require_once '../mainlib.php';
    global $app;
    $result=array();
    $query="select tournament.tournament_id,tournament_name,tournament_date_start, if(tournament_date>now(),true,false))";
    $rs=$app::$connection->query($query);
    $result['actualT']=array();
    $result['oldT']=array();
    while($temp=$rs->fetch_array()){
        if($temp['actual']==true){
            array_push($result['actualT'],array('id'=>$temp['tournament_id'],'name'=>$temp['tournament_name'],'dateStart'=>$temp['tournament_date_start']));
            continue;
        }else{
            array_push($result['oldT'],array('id'=>$temp['tournament_id'],'name'=>$temp['tournament_name'],'dateStart'=>$temp['tournament_date_start']));
        }
    }
    $rs->close();
    //$result['user']=$app::$user->getPersonInfo();
    echo json_encode($result);
?>