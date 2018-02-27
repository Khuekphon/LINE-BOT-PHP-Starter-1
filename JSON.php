<?php
include("connect.php");
$sql="select * from chat_TB where chat_question like '%".$_GET["key"]."%'";
$result = mysqli_query($conn, $sql);

$out = array();
while($row = mysqli_fetch_assoc($result)){
	$messages = [
		'type' => 'text',
		'text' => $row['chat_answer']
	];
	$out[] = $messages;
}


	$data = [
		'replyToken' => $_GET["reply_key"],
		'messages' => $out,
	];
	$post = json_encode($data);
	
	echo $post;
