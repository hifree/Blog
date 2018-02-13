<?php
	

echo 'FILES'.'<br>';
var_dump($_FILES);
echo 'GET'.'<br>';
var_dump($_GET);
echo 'POST'.'<br>';
var_dump($_POST);


// $file = fopen($fileName, "w");
		// fwrite ($file, $users);
		// fclose ($file);
		


// $uploaddir = '/';
// $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

// echo '<pre>';
// if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    // echo "Файл корректен и был успешно загружен.\n";
// } else {
    // echo "Возможная атака с помощью файловой загрузки!\n";
// }

// echo 'Некоторая отладочная информация:';
// print_r($_FILES);

// print "</pre>";


// в этой конструкции данные выводятся после выполнения sleep (хотя и стоят ранее sleep)
{
	// echo "123";
	// var_dump($_POST);
	// sleep(1);
}
