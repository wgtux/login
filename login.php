<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=auto, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
session_start();
require 'config.php';

//se campo de email foi setado e ele não esta vazio
if(isset($_POST['email']) && empty($_POST['email']) == false){
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    try{
        $db = new PDO($dsn, $dbuser, $dbpas);
        $sql = $db->query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();
            $_SESSION['id'] = $dado['id'];
            header("Location: index.php");
        }
        else{
            header("Location: usuario.php");
        }
    }
    catch(PDOException $e){
        echo "Falhou: ".$e->getMessage();
    }
}

?>

<h1>Pagina de Login</h1>

<form method="POST">
    <span>Email: </span>
    <input type="email" name="email" /><br /> <br />

    <span>Senha: </span>
    <input type="password" name="senha" /><br /> <br />

    <input type="submit" value="Entrar" />
</form>
<br />
<span>Ainda não tem cadastro <a href="usuario.php">Clica Aqui</a></span>
    
</body>
</html>