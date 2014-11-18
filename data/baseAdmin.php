<?php
    require_once '../mainlib.php';
    global $app;
    $result=array();
	//watch the query closelys
    $query="select count(tct.creator_id) as rcount from (select distinct creator_id,participant.tournament_id from participant join tournament on tournament.tournament_id=participant.tournament_id where IsNULL(participant_is_approved) and tournament_date_start>now()) as tct";
    $rs=$app::$connection->query($query);
    $temp=$rs->fetch_array();
	$result['newRequestCount']=$temp['rcount'];
    $rs->close();
    echo json_encode($result);
?>