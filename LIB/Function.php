<?
function ViewRecord($tb,$pm=1) {
	$result=mysql_query("select * from " .$tb. " where pstatus=".$pm." order by pid DESC");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function ViewRecordADM($tb) {
	$result=mysql_query("select * from " .$tb. " order by pid DESC");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function ViewRecordRS($tb,$id) {
	$result=mysql_query("select * from " .$tb. " where ptype=".$id." order by pid DESC");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}
function ViewTopReply($tb1,$start,$pagesize,$pm=1) {
	$result=mysql_query("select  ptype,ptitle,ptime from " .$tb1. "  where pstatus=".$pm." group by ptype order by pid DESC LIMIT ".$start.",".$pagesize."");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function ViewLimit($tb,$start,$pagesize,$pm=1) {
	$result=mysql_query("select * from " .$tb. "  where  pstatus=".$pm." order by pid DESC LIMIT ".$start.",".$pagesize."");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function ViewLimitADM($tb,$start,$pagesize) {
	$result=mysql_query("select * from " .$tb. " order by pid DESC LIMIT ".$start.",".$pagesize."");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function ViewLimitRS($tb,$id,$start,$pagesize) {
	$result=mysql_query("select * from " .$tb. " where ptype=".$id." order by pid DESC LIMIT ".$start.",".$pagesize."");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function ViewByID($tb,$id) {
	$result=mysql_query("select * from " .$tb. " where pid=".$id." order by pid DESC");
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function ViewReply($tb1,$id,$sr,$pm=1) {
	$result=mysql_query("select * from ".$tb1." where tb_reply.ptype=".$id." and tb_reply.pstatus=".$pm." order by tb_reply.pid ".$sr);
	if ($result) {
		return $result;
	}else{
		exit();
	}
}

function LastRecords($tb,$fd){
	$result=mysql_query("select * from " .$tb. " order by " .$fd. " DESC");
	if ($result) {
		$rec=mysql_fetch_array($result);
		return $rec['pid'];
	}else{
		exit();
	}
}

function UpdateHits($tb,$vc,$id){
	$result=mysql_query("update " .$tb. " set pvisit= ".$vc." where pid=".$id);
}

function UpdateStatus($tb,$vc,$id){
	$result=mysql_query("update " .$tb. " set pstatus= ".$vc." where pid=".$id."");
}

function FmatID($snum) {
	$rnum="";
	switch(strlen($snum)){
		case 1 : $rnum = $rnum."00000".$snum;	break;
		case 2 : $rnum = $rnum."0000".$snum;	break;
		case 3 : $rnum = $rnum."000".$snum;	break;
		case 4 : $rnum = $rnum."00".$snum;	break;
		case 5 : $rnum = $rnum."0".$snum;	break;
		case 6 : $rnum = $rnum.$snum;	break;
	}
	return $rnum;
}

function CheckIP() {
	if ($_SERVER["HTTP_X_FORWARDED_FOR"]) { 
		if ($_SERVER["HTTP_CLIENT_IP"]) { 
			$proxy = $_SERVER["HTTP_CLIENT_IP"]; 
		} else { 
			$proxy = $_SERVER["REMOTE_ADDR"]; 
		} 
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; 

	} else { 
		if ($_SERVER["HTTP_CLIENT_IP"]) { 
			$ip = $_SERVER["HTTP_CLIENT_IP"]; 
		} else { 
			$ip = $_SERVER["REMOTE_ADDR"]; 
		} 
		$proxy ="";
	}
 	$res_ip[]=$proxy;
	$res_ip[]=$ip;
	return $res_ip;
}

function CheckTime() {
	$vtime=date("d-m-Y")." ".date("H:i:s");
	return $vtime;
}

function conv_date($x) {
	$vsec=explode(" ",$x);
	
	$vdate1=explode("-",$vsec[0]);
	$y=$vdate1[0];
	$m=$vdate1[1];
	$d=$vdate1[2];
	
	$conv_date="$d-$m-$y $vsec[1]";
	return $conv_date;
}

function gotohome() {
	header("Location: index.php");
}

function secondsToWords($seconds)
{
    /*** return value ***/
    $ret = "";

 /*** get the days ***/
    $days = intval(intval($seconds) / 86400);
    if($days > 0)
    {
        $ret .= "$days days ";
    }

    /*** get the hours ***/
    $hours = bcmod((intval($seconds) / 3600),24);
    if($hours > 0)
    {
        $ret .= "$hours hrs ";
    }
    /*** get the minutes ***/
    $minutes = bcmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0)
    {
        $ret .= "$minutes mins ";
    }
  
    return $ret;
}

?>