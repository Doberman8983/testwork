/Если пришли данные на обработку
if(isset($_POST['login']) && isset($_POST['password']))
{
    //Записываем все в переменные
    $login=htmlspecialchars(trim($_POST['login']));
    $password=htmlspecialchars(trim($_POST['password']));
    $mdPassword = md5($password);
    
    // Подключение к базе данных
    require_once 'db_connect.php';
    
    //Достаем из таблицы инфу о пользователе по логину
    $res=mysql_query("SELECT * FROM `users` WHERE `login`='$login' ");
    $data=mysql_fetch_array($res);
 
    require_once 'header.php';
    $error = false;
    //Если такого нет, то пишем что нет
    if(empty($data['login']))
    {
        $error[0] = 'Такого пользователя не существует!';
    }
    else {
        //Если пароли не совпадают
        if($mdPassword!=$data['password'])
        {
            $error[1] = 'Введенный пароль неверен!';
        }
        else
        {
            //Если капча не совпадают
            if($_POST['kapcha'] != $_SESSION['rand_code'])
            {
                $error[2] = 'Капча введена неверно';
            }
        }
    }
 
    if ($error == false) {
        //Запускаем пользователю сессию
        session_start();
     
        //Записываем в переменные login и id
        $_SESSION['login']=$data['login'];
        $_SESSION['id']=$data['id'];
        $_SESSION['status']=$data['status'];
        
        //Переадресовываем на главную
        header("location: index.php");
    }
}
    require_once 'header.php';
?>
        
    <section id="contact" class="login">        
            <div class="container">         
                <div class="row text-center clearfix">              
                    <div class="col-sm-8 col-sm-offset-2">                  
                        <div class="contact-heading">                       
                            <h2 class="title-one">Авторизация</h2>                  
                        </div>              
                    </div>          
                </div>      
            </div>      
            <div class="container">
                <div class="pattern"></div> 
                <div class="row text-center clearfix">                  
                    <div class="col-md-6 col-md-offset-3">                      
                        <div id="contact-form-section2">
                            <form id="contact-form" class="contact" name="contact-form" method="post" role="form" action="login.php">
                                <div class="form-group">                                    
                                    <input type="text" name="login" class="form-control name-fields" required="required" placeholder="Ваш логин">
                                <div class="status alert alert-success"><?php echo $error[0]; ?></div>
                                </div>                              
                                <div class="form-group">    
                                    <input type="password" name="password" class="form-control mail-fields" required="required" placeholder="Ваш пароль">
                                </div> 
                                <div class="status alert alert-success"><?php echo $error[1]; ?></div>
                                <div class="form-group">
                                      <img src="captcha.php" />
                                      <input type="text" name="kapcha" class="form-control mail-fields" required="required" placeholder="Капча" />
                                </div>
                                <div class="status alert alert-success"><?php echo $error[2]; ?></div>
                                <div class="form-group">                                    
                                    <button type="submit" class="btn btn-primary">Войти</button>
                                </div>                          
                            </form>                     
                        </div>                  
                    </div>              
                </div>      
            </div>  
        </section>
        
<?php
    require_once 'footer.php';
?>