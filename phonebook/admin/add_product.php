<?php
session_start();

define('admin23', true);

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//if(isset($_GET["logout"])){
//    unset($_SESSION['auth_admin']);
//    header("Location: login.php");
//}


include("include/db_connect.php");
include("include/functions.php");

if (isset($_POST["submit_add"])){
    
    if(isset($_SESSION['add_tovar'])!='1'){
        
    $error=array();
    //проверка полей
    if(!$_POST["form_name"]){
        $error[]="Укажите имя";
    }
    if(!$_POST["form_surname"]){
        $error[]="Укажите фамилию";
    }
   
    if(count($error)){
        $_SESSION['message']="<p id='form-error'>".implode('<br />', $error)."</p>";
    }
    else{
		
		mysqli_query($link, "INSERT INTO `table_phone`(`id`, `name`, `surname`, `num1`, `num2`, `num3`, `num4`, `num5`, `num6`, `num7`, `num8`, `num9`, `num10`, `num11`, `num12`, `num13`, `num14`, `num15`, `num16`, `num17`, `num18`, `num19`, `num20`)
		VALUES (
		NULL,
		 '".$_POST["form_name"]."',
		'".$_POST["form_surname"]."',
		'".$_POST["form_num1"]."',
		'".$_POST["form_num2"]."',
		'".$_POST["form_num3"]."',
		'".$_POST["form_num4"]."',
		'".$_POST["form_num5"]."',
		'".$_POST["form_num6"]."',
		'".$_POST["form_num7"]."',
		'".$_POST["form_num8"]."',
		'".$_POST["form_num9"]."',
		'".$_POST["form_num10"]."',
		'".$_POST["form_num11"]."',
		'".$_POST["form_num12"]."',
		'".$_POST["form_num13"]."',
		'".$_POST["form_num14"]."',
		'".$_POST["form_num15"]."',
		'".$_POST["form_num16"]."',
		'".$_POST["form_num17"]."',
		'".$_POST["form_num18"]."',
		'".$_POST["form_num19"]."',
		'".$_POST["form_num20"]."'

		)");
			
		$id=mysqli_insert_id($link);
		
		$_SESSION['message']="<p id='form-success'>Контакт добавлен!</p>";
													
		$id=mysqli_insert_id($link);
    }
  }
  else{
    $msgerror='У Вас нет прав на добавление контакта';
  }  
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="jquery-confirm/jquery-confirm.css" rel="stylesheet" type="text/css" />
    <link href="jquery-confirm/jquery-confirm.less" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="./ckeditor/ckeditor/ckeditor.js"></script>
    
	<title>Панель управління</title>
</head>

<body>
<div id="block-body">

<div id="block-content">

<div id="block-parameters">
</br>
<p id="title-page">Добавление контакта</p>
		</br>
		</br>

	<a href="../index.php">Главная</a>
	</br>
</div>
<?php

if(isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';
	if(isset($_SESSION['message'])){
	   echo $_SESSION['message'];
       unset($_SESSION['message']);
	}
	if(isset($_SESSION['answer'])){
	   echo $_SESSION['answer'];
       unset($_SESSION['answer']);
	}
?>

<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">

<li>
<label>Имя</label>
<input type="text" name="form_name" />
</li>

<li>
<label>Фамилия</label>
<input type="text" name="form_surname" />
</li>

<li>
<label>Номер1</label>
<input type="text" name="form_num1" />
</li>

<li>
<label>Номер2</label>
<input type="text" name="form_num2" />
</li>

<li>
<label>Номер3</label>
<input type="text" name="form_num3" />
</li>

<li>
<label>Номер4</label>
<input type="text" name="form_num4" />
</li>

<li>
<label>Номер5</label>
<input type="text" name="form_num5" />
</li>

<li>
<label>Номер6</label>
<input type="text" name="form_num6" />
</li>

<li>
<label>Номер7</label>
<input type="text" name="form_num7" />
</li>

<li>
<label>Номер8</label>
<input type="text" name="form_num8" />
</li>

<li>
<label>Номер9</label>
<input type="text" name="form_num9" />
</li>

<li>
<label>Номер10</label>
<input type="text" name="form_num10" />
</li>

<li>
<label>Номер11</label>
<input type="text" name="form_num11" />
</li>

<li>
<label>Номер12</label>
<input type="text" name="form_num12" />
</li>

<li>
<label>Номер13</label>
<input type="text" name="form_num13" />
</li>

<li>
<label>Номер14</label>
<input type="text" name="form_num14" />
</li>

<li>
<label>Номер15</label>
<input type="text" name="form_num15" />
</li>

<li>
<label>Номер16</label>
<input type="text" name="form_num16" />
</li>

<li>
<label>Номер17</label>
<input type="text" name="form_num17" />
</li>

<li>
<label>Номер18</label>
<input type="text" name="form_num18" />
</li>

<li>
<label>Номер19</label>
<input type="text" name="form_num19" />
</li>

<li>
<label>Номер20</label>
<input type="text" name="form_num20" />
</li>

</ul>

<p align="right"><input type="submit" id="submit_form" name="submit_add" value="Добавить контакт" /></p>

</form>


</div>
</div>
</body>
</html>
