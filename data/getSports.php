<?php
    require_once '../mainlib.php';
    global $app;
    $result=array();
	//watch the query closelys
    $query="select sport_id,sport_name from sport";
    $rs=$app::$connection->query($query);
	$result['sports']=array();
    while($temp=$rs->fetch_array()){
    	array_push($result['sports'],array('id'=>$temp['sport_id'],'name'=>$temp['sport_name']));
    }
    $rs->close();
    echo json_encode($result);
?>