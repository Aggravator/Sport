<?php
    require_once '../mainlib.php';
    global $app;
    $result=array();
	//watch the query closelys
    $query=sprintf("select distinct count(creator_id) as cr from participants where IsNULL(participant_is_approved);",$app::$user->id,$app::$user->id);
    $rs=$app::$connection->query($query);
	$result['newRequestCount']=($rs->fetch_array())['cr'];
    $rs->close();
    echo json_encode($result);
?>