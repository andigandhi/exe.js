<?php
	function addJSON($pictures, $name) {
		$newData['user'] = $_POST['user'];
		$newData['name'] = $name;
		$newData['points'] = 0;
		
		array_push($pictures, $newData);
		
		file_put_contents('bildergalerie/pictures.txt', json_encode($pictures));
	}

	define('UPLOAD_DIR', 'bildergalerie/');
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	
	$pictures = json_decode(file_get_contents('bildergalerie/pictures.txt'), true);
	$lineNo = count($pictures);

	$file = UPLOAD_DIR . $lineNo .'.png';
	$success = file_put_contents($file, $data);

	addJSON($pictures, $lineNo);

	echo("Erfolgreich!");
?>