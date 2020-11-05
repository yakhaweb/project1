<?php
session_start();

define('admin23', true);

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


//if(isset($_GET["logout"])){
  //  unset($_SESSION['auth_admin']);
    //header("Location: login.php");
//}
$_SESSION['urlpage']="<a href='index.php'>Головна</a> \ <a href='tovar.php'>Товари</a>";

include("include/db_connect.php");
include("include/functions.php");

//$type=$_GET["type"];


$id= isset ($_GET["id"]);


if(isset($_GET["action"]))
$action= $_GET["action"];//удаление товара из базы данных

if(isset($action)){
	
    $id = (int)$_GET["id"];

    switch ($action){
        case 'delete':
        if (isset($_SESSION['delete_tovar'])!='1'){
        $delete=mysqli_query($link, "DELETE FROM `table_phone` WHERE id='$id'");
        break;
        }
        else{
            $msgerror='У Вас немає прав доступу на видалення товару';
        }
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
    <script type="text/javascript" src="jquery-confirm/js/jquery-confirm.js"></script>
	<title>Панель управления</title>
</head>

<body>
<div id="block-body">
<?php

    $all_count=mysqli_query($link, "SELECT * FROM `table_phone`");
    $all_count_result=mysqli_num_rows($all_count);
?>
<div id="block-content">

	<div id="block-info">
		<p id="count-style">Всего контактов - <strong><?php echo $all_count_result; ?></strong></p>
		<p align="right" id="add-style"><a href="add_product.php">Добавить контакт</a></p>
				</br>
		</br>
</br>
	<a href="../index.php">Главная</a>
	</br>
	</div>



<ul id="block-tovar">
<?php

if(isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

$num=8;

$count=mysqli_query($link, "SELECT COUNT(*) FROM `table_phone`");
$temp=mysqli_fetch_array($count);
$post=$temp[0];
//находим общее число страниц
$total=(($post-1)/$num)+1;
$total=intval($total);
//oпределяем начало сообщений для текущей страницы

 if(isset($_GET['page']))
            $page=(int)$_GET['page'];
//$page=intval($page);
//если значение $page меньше единицы или отрицательно переходим на новую страницы
//a усли слишком большое, то переходим на последнюю	
if (empty($page) or $page<0) $page=1;
if($page>$total) $page=$total;
//вычисляем начиная с какого номера
//следует выводить сообщение
$start=$page*$num-$num;
if($temp[0]>0){
$result=mysqli_query($link, "SELECT * FROM `table_phone` ORDER BY id DESC LIMIT $start, $num");
    if (mysqli_num_rows($result) > 0)
        {
        $row=mysqli_fetch_array($result);
        

        do{
            
			
			if(!isset($url)) {$url = '';}
				echo '                      
					<p><a>'.$row["name"].'</a> <a>'.$row["surname"].'</a> <a>'.$row["num1"].'</a></p>
					<p align="center" class="link-action"><a class="green" href="edit_product.php?id='.$row["id"].'">Изменить</a> | <a rel="tovar.php?'.$url.'id='.$row["id"].'&action=delete" class="delete">Удалить</a></p>
					</br>
					</br>
				';       
        }
        while($row=mysqli_fetch_array($result));

    }        
}
  //нижняя навигация по страницам
    if($page!=1){$pervpage='<li><a class="pstr-prev" href="tovar.php?'.$url.'page='.($page-1).'">&lt;</a></li>';}
    if($page!=$total) $nextpage='<li><a class="pstr-next" href="tovar.php?'.$url.'page='.($page+1).'">&gt;</a></li>';
    
    if($page-5>0) $page5left='<li><a href="tovar.php?'.$url.'page='.($page-5).'">'.($page-5).'</a></li>';
    if($page-4>0) $page4left='<li><a href="tovar.php?'.$url.'page='.($page-4).'">'.($page-4).'</a></li>';
    if($page-3>0) $page3left='<li><a href="tovar.php?'.$url.'page='.($page-3).'">'.($page-3).'</a></li>';
    if($page-2>0) $page2left='<li><a href="tovar.php?'.$url.'page='.($page-2).'">'.($page-2).'</a></li>';
    if($page-1>0) $page1left='<li><a href="tovar.php?'.$url.'page='.($page-1).'">'.($page-1).'</a></li>';
    
    if($page+5<=$total) $page5right='<li><a href="tovar.php?'.$url.'page='.($page+5).'">'.($page+5).'</a></li>';
    if($page+4<=$total) $page4right='<li><a href="tovar.php?'.$url.'page='.($page+4).'">'.($page+4).'</a></li>';
    if($page+3<=$total) $page3right='<li><a href="tovar.php?'.$url.'page='.($page+3).'">'.($page+3).'</a></li>';
    if($page+2<=$total) $page2right='<li><a href="tovar.php?'.$url.'page='.($page+2).'">'.($page+2).'</a></li>';
    if($page+1<=$total) $page1right='<li><a href="tovar.php?'.$url.'page='.($page+1).'">'.($page+1).'</a></li>';
    
    
    if($page+5<$total){
        $strtotal='<li><p class="nav-point">...</p></li><li><a href="tovar.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
    }
    else{
        $strtotal="";
    }
  ?>
  <div id="footerfix"></div>
  <?php  
    if($total>1){
        echo '
        <center>
        <div class="pstrnav">
        <ul>
        ';
		
				if(!isset($pervpage))
			$pervpage = '';
		if(!isset($page5left))
			$page5left = '';
		if(!isset($page4left))
			$page4left = '';
		if(!isset($page3left))
			$page3left = '';
		if(!isset($page2left))
			$page2left = '';
		if(!isset($page1left))
			$page1left = '';
		if(!isset($page1right))
			$page1right = '';
		if(!isset($page2right))
			$page2right = '';
		if(!isset($page3right))
			$page3right = '';
		if(!isset($page4right))
			$page4right = '';
		if(!isset($page5right))
			$page5right = '';
		if(!isset($nextpage))
			$nextpage = '';
        
        echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='tovar.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
       echo '
        </center>
        </ul>
        </div>
        ';
    }
?>

</div>
</div>


</body>
</html>
