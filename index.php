<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
</head>
<body>


<p>   <h1 style=color:green> Станица регистрации нового пользователя  </h1></p>
<form method="POST">
Имя <br><input type="text" name="name"><br>
Фамилия <br><input type="text" name="subname"><br>
Возраст <br><input type="text" name="age"><br>
Email <br><input type="email" name="email"><br>
Пароль <br><input type="password" name="password" maxlength="15"><br>
Повторите пароль <br><input type="password2" name="password2" maxlength="15"><br>
<br><input type="submit" name="go" value="Регистрация">


</form>

<?php



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
if ($password or $password2 or $email == "0" )
 { 
 	
	echo "Вы не ввели данные";	
	
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



</body>
</html>

<!--Брат привет, этой мой код дополнил 
,что у тебя не было ошибки слияния, я не двигал твой код, а просто добавил
по слиянию потом уже будем.
 -->