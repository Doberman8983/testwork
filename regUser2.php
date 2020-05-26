<?php

//if ($error = 1) {
	//header("location:index.php");
//}

header("location:index.php");
//session_start();
function addNewUserArray($name,$subName,$age,$emailUser,$pass)
	{ $users[] = $user;
	if (isset($name)) {
		if (isset($subName)) {
			if (isset($age)) {
				if (isset($emailUser)) {
					if (isset($pass)) {
						return $user[] =[
		"Статус" => "Пользователь",
		"Имя" => $name,
		"Фамилия" => $subName,
		"Возраст" => $age,
		"Почта" => $emailUser,
		"Пароль" => $pass
		];
	}}}}}} 

function checkDataUser()
{
	# code...
}
// получаем данные зарегестрированных пользователей
$users = unserialize(file_get_contents("regUsers.txt")); 

// проверяем на существование переменных если существуют присваиваем переменные
if (isset($_POST["password"])) $password = $_POST["password"]   ;

if (isset($_POST["password2"])) $password2 = $_POST["password2"] ;

if (isset($_POST["email" ]))$email = $_POST["email"]  ;


// выдается ошибка если данные не введены или введены не полностью
if (empty($password) or empty($password2) or empty($email) )
 { 
 	
	$error = 1;	
	
	exit();
}

// выдается ошибка если введенные пароли не совподают
if ($password != $password2) {
	echo " Введенные пароли не совподают";
	exit();
}

// если логин и пароль введены то обрабатываем их
$password = stripcslashes($password);
$password = htmlspecialchars($password);

$password2 = stripcslashes($password2);
$password2 = htmlspecialchars($password2);

$email = stripcslashes($email);
$email = htmlspecialchars($email);

//  удаляем лишние пробелы
$password = trim($password);
$password2 = trim($password2);
$email = trim($email);

// перебираем массив с пользователями на наличие совпадения логина
foreach ($users as $key => $value) {
	if ($email == $value["Почта"]) {
		echo "Пользователь с таким логином уже существует";
		exit();
	}
	elseif ($email != $value["Почта"]) {
		$error = 0 ;
	}
}
// создаем массив с данными нового пользователя
if ($error == 0) {
	$newUser = addNewUserArray($_POST["name"],$_POST["subname"],$_POST["age"],$email,$password2);
}

// записываем нового пользователя в основной массив Users
$users[] = $newUser;
if (isset($newUser)) {
	file_put_contents("regUsers.txt", serialize($users));
}
echo "<h1 style=color:green>Вы успешно зарегестрировались</h1>";
//echo "<pre>";
//var_dump($users);
//echo "</pre>";
exit();
?>