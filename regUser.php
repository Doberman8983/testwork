<?php
// функция по добавлению нового пользователя в массив Users
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

// функция по добавлению нового пользователя пока не задействована
function checkLogin ($array)
	{$result = $check;
	 foreach ($array as $key => $value) {
 	if ($_POST["email"] == $value["Почта"]) {
 		return $check = 0;
 		exit();
 	}
 		elseif ($_POST["email"] != $value["Почта"]) {
 			return $check = 1;
 		}
	}}

// считываем зарегистрированных пользователей
$users = unserialize(file_get_contents("regUsers.txt")); 

// производим проверку на полный ввод данных
if ($_POST["go"] != "0" && $_POST["name"]=="" && $_POST["subname"] == "" && $_POST["age"] ==""&& $_POST["email"] == "" && $_POST["password"] == "" && $_POST["password2"] == ""){
	echo "Введите свои данные!!!";
	exit();	}
elseif ($_POST["name"] == "" ) {
	echo "Введите имя";
	exit();
}
elseif ($_POST["subname"] == "") {
	echo "Введите Фамилия";
	exit();
}	
elseif ($_POST["age"] == ""){ 
	echo "Введите возраст";
	exit();	
}
elseif ($_POST["email"] == ""){
 echo "Введите Емайл";
 
exit();
}
elseif ($_POST["password"] == ""){
 echo "Введите пароль";
 exit();
}
elseif ($_POST["password2"] == "") {
	echo "Введите повторные пароль";
	exit();
}
elseif ($_POST["password"] != $_POST["password2"]){ 
	echo "Пароли не совподают!!!";	
	exit();

}


// производим проверку нового пользователя со данными в БД на совподения
foreach ($users as $key => $value) {
	if ($_POST["email"] == $value["Почта"]) {
		$error = 1;
	}
	elseif ($_POST["email"] != $value["Почта"]) {
		$error = 0 ;
	}
}


if ($error == 1) {
	echo "Пользователь с таким почтовым ящиков уже существует";
	exit();}

	elseif ($error == 0) {
		// формируем новый массив с данными пользователя
		$newUser = addNewUserArray($_POST["name"],$_POST["subname"],$_POST["age"],$_POST["email"],$_POST["password"]);
	}
	$users[] = $newUser;

// производим запись массива с новым  пользователем в файл
if (isset($newUser)) {
	file_put_contents("regUsers.txt", serialize($users));
	echo "<h1 style=color:green>Вы успешно зарегестрировались</h1>";
exit();
 }


//echo "</pre>";	
//var_dump($newUser);
//echo "</pre>";
?>