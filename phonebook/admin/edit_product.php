<?php
session_start();

define('admin23', true);

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include("include/db_connect.php");
include("include/functions.php");

$id=clear_string($_GET["id"]);

if (isset($_POST["submit_save"])){
    
    if(isset($_SESSION['edit_tovar'])!='1'){
    
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
        
        $querynew="name='{$_POST["form_name"]}', surname='{$_POST["form_surname"]}', num1='{$_POST["form_num1"]}', num2='{$_POST["form_num2"]}', num3='{$_POST["form_num3"]}', num4='{$_POST["form_num4"]}', num5='{$_POST["form_num5"]}', num6='{$_POST["form_num6"]}', num7='{$_POST["form_num7"]}', num8='{$_POST["form_num8"]}', num9='{$_POST["form_num9"]}', num10='{$_POST["form_num10"]}', num11='{$_POST["form_num11"]}', num12='{$_POST["form_num12"]}', num13='{$_POST["form_num13"]}', num14='{$_POST["form_num14"]}', num15='{$_POST["form_num15"]}', num16='{$_POST["form_num16"]}', num17='{$_POST["form_num17"]}', num18='{$_POST["form_num18"]}', num19='{$_POST["form_num19"]}', num20='{$_POST["form_num20"]}'";

        $update="UPDATE `table_phone` SET `name`='{$_POST["form_name"]}',`surname`='{$_POST["form_surname"]}', `num1`='{$_POST["form_num1"]}', `num2`='{$_POST["form_num2"]}', `num3`='{$_POST["form_num3"]}', `num4`='{$_POST["form_num4"]}', `num5`='{$_POST["form_num5"]}', `num6`='{$_POST["form_num6"]}', `num7`='{$_POST["form_num7"]}', `num8`='{$_POST["form_num8"]}', `num9`='{$_POST["form_num9"]}', `num10`='{$_POST["form_num10"]}', `num11`='{$_POST["form_num11"]}', `num12`='{$_POST["form_num12"]}', `num13`='{$_POST["form_num13"]}', `num14`='{$_POST["form_num14"]}', `num15`='{$_POST["form_num15"]}', `num16`='{$_POST["form_num16"]}', `num17`='{$_POST["form_num17"]}', `num18`='{$_POST["form_num18"]}', `num19`='{$_POST["form_num19"]}', `num20`='{$_POST["form_num20"]}' WHERE `id`='$id'";

      if (mysqli_query($link, $update)) {
					echo "Record updated successfully";
					} else {
						echo "Error updating record: " . mysqli_error($link);

						}
	  	  	  
	  $_SESSION['message']="<p id='form-success'>Контакт успешно изменен!</p>";   
  
    }
    }
                else{
                    $msgerror='У Вас нет прав на изменение товара!';
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
    
	<title>Панель управления</title>
</head>

<body>
<div id="block-body">

<div id="block-content">

<div id="block-parameters">
</br>
	<p id="title-page">Редактирование контактов</p>
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

<?php
	$result=mysqli_query($link, "SELECT * FROM `table_phone` WHERE `id`='$id'");

        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_array($result);
                do{
                    echo '
                    <form enctype="multipart/form-data" method="post">
                    <ul id="edit-tovar">

                    <li>
                    <label>Имя</label>
                    <input type="text" name="form_name" value="'.$row["name"].'" />
                    </li>

                    <li>
                    <label>Фамилия</label>
                    <input type="text" name="form_surname" value="'.$row["surname"].'" />
                    </li>

                    <li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num1" value="'.$row["num1"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num2" value="'.$row["num2"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num3" value="'.$row["num3"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num4" value="'.$row["num4"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num5" value="'.$row["num5"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num6" value="'.$row["num6"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num7" value="'.$row["num7"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num8" value="'.$row["num8"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num9" value="'.$row["num9"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num10" value="'.$row["num10"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num11" value="'.$row["num11"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num12" value="'.$row["num12"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num13" value="'.$row["num13"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num14" value="'.$row["num14"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num15" value="'.$row["num15"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num16" value="'.$row["num16"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num17" value="'.$row["num17"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num18" value="'.$row["num18"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num19" value="'.$row["num19"].'" />
                    </li>
					<li>
                    <label>Номер телефона</label>
                    <input type="text" name="form_num20" value="'.$row["num20"].'" />
                    </li>


                </ul>


                <p align="right"><input type="submit" id="submit_form" name="submit_save" value="Зберегти" /></p>

                </form>
                ';
                       }
                while ($row=mysqli_fetch_array($result));
        }

?>

</div>
</div>
</body>
</html>
