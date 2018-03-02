<?php
include("connect.php");
$access_token = 'FTAdDbJGsMUtmLTNqwOjUIe7qr0BGt/2y53y5kLiBEletJdkqL14wFVXbeIl5CiqSw6n/iXXq+96GzgacfYNnf3apBSlWAfmey+QSWx2lcrQF87OX5WmzePZar5mos520Tu0IaQvAmOsjbNCSD8+4QdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$text = $event['message']['text'];
			// Get replyToken
				$replyToken = $event['replyToken'];
			
			
			$sql="select * from chat_TB where chat_question like '%".$text."%'";
			$result = mysqli_query($conn, $sql);
			$row_cnt = $result->num_rows;
			if($row_cnt > 0){
			$out = array();
		
			while($row = mysqli_fetch_assoc($result)){
				$messages = [
					'type' => 'text',
					'text' => $row['chat_answer']
				];
				$out[] = $messages;
		
			}
			}else{
			$out = array(
				array(
				'type' => 'text',
				'text' => 'ขออภัย!! แชทบอททางศูนย์คอมพิวเตอร์ไม่สะดวก สามารถสอบถามได้ช่องทางนี้'
				),
				array(
				'type' => 'text',
				'text' => 'https://cc.rmu.ac.th/2017/'
				),
				array(
				'type' => 'text',
				'text' => 'เบอร์โทรติดต่อ 043-712160'
				),
				array(
				'type' => 'text',
				'text' => 'ติต่อเจ้าหน้าที่ https://cc.rmu.ac.th/2017/about/contact/'
				),
			);
			}

				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
			
				
			
				$data = [
				
					'replyToken' => $replyToken,
					'messages' => $out,
					
				];
			
				
				$post = json_encode($data);
			
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);

				echo $result . "\r\n";
		}
	}
}
echo "OK";
