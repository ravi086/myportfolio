<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$subject = $_POST['subject'];
		
		// Email configuration
		
		

		// Telegram configuration
		$botToken = "7355713107:AAEE6_wMKzgQZWp9Gc73YAccBg5QXIGqdLs";
		$chatId = "1395034397";
		$telegramMessage = "From: $name\nE-Mail: $email\nSubject: $subject\nMessage:\n$message";
		
		// Send message to Telegram
		$telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
		$telegramData = array(
			'chat_id' => $chatId,
			'text' => $telegramMessage
		);
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($telegramData)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($telegramUrl, false, $context);
		
		if ($result === FALSE) {
			die('Error sending message to Telegram');
		}

		// Redirect to thank you page
		header("Location: thank-you.html");
		exit;
	}
?>
