<?php
    require_once '../mainlib.php';
    global $app;
    $result=array();
    $query="select distinct name,surname,patronymic, concat(surname,\" \",Left(name,1),\".\",Left(patronymic,1),\".\") as fio, creator_id,participant.tournament_id,tournament_date_start,tournament_name from participant join tournament on (tournament.tournament_id=participant.tournament_id) join users on (creator_id=users.id) where IsNULL(participant_is_approved) and tournament_date_start>now()";
    $rs=$app::$connection->query($query);
    $result['newR']=array();
    while($temp=$rs->fetch_array()){
        array_push($result['newR'],array('creator'=>$temp['creator_id'],'tid'=>$temp['tournament_id'],'fio'=>$temp['fio'],'tname'=>$temp['tournament_name'],'dateStart'=>$temp['tournament_date_start']));
    }
    $rs->close();
    $query="select tid,cid,  name,surname,patronymic, concat(surname,\" \", Left(name,1),\".\",Left(patronymic,1),\".\") as fio,tournament_date_start,tournament_name from (select distinct tournament_id as tid,creator_id as cid, avg(not isNull(participant_is_approved)) as init from participant group by tid,cid having init=1) as src join tournament on (src.tid=tournament_id) join users on users.id=cid;";
    $rs=$app::$connection->query($query);
    $result['oldR']=array();
    while($temp=$rs->fetch_array()){
        array_push($result['oldR'],array('creator'=>$temp['cid'],'tid'=>$temp['tid'],'fio'=>$temp['fio'],'tname'=>$temp['tournament_name'],'dateStart'=>$temp['tournament_date_start']));
    }
    $rs->close();
    echo json_encode($result);
?>