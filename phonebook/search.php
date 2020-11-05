<?php
define('admin23', true);
include("include/db_connect.php");
include("functions/functions.php");
session_start();
//include("include/auth_cookie.php");

// Включение сообщений о всех ошибках
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$search= clear_string ($_GET["q"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
 	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-3.1.1.min"></script>
    <script type="text/javascript" src="/js/ji.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/js/textchange.js"></script>

	<title>Пошук - <?php echo $search; ?></title> 
</head>

<body>
<div id="block-body">

<div id="block-header">
	<?php include("include/block-header.php");?>
</div>

	

<div id="block-content-search">

<!--табличный вывод товара-->

<?php
	if(strlen($search)>=3 && strlen($search)<=150){


	

    //поиск по введенному названию
    $count=mysqli_query($link, "SELECT COUNT(*) FROM `table_phone` WHERE surname LIKE '%$search%'");
    $temp=mysqli_fetch_array($count);
    
  
//-----------------------------------------------------    
    if ($temp[0]>0){//проверка на отсутствие товаров по поиску
    ?>

<ul id="block-tovar-list">
</br>
<?php
	$result=mysqli_query($link, "SELECT * FROM `table_phone` WHERE surname LIKE '%$search%' ");
    if (mysqli_num_rows($result) > 0)
        {
        $row=mysqli_fetch_array($result);
        
        
        do{
       
                       
            echo '
            <li>

						<div class="cart-tovar-list">
	

						<div class="flex-tovar-list">						          
							<p class="style-tittle-list" ><a href="view_content.php?id='.$row["id"].'">'.$row["name"].'</a></p>
						</div>
						
						<div class="flex-tovar-list">						          
							<p class="style-tittle-list" ><a href="view_content.php?id='.$row["id"].'">'.$row["surname"].'</a></p>
						</div>
						
						<div class="flex-tovar-list">						          
							<p class="style-tittle-list" ><a href="view_content.php?id='.$row["id"].'">'.$row["num1"].'</a></p>
						</div>
					
							
					</div>
					
				</li>
				</br>
            ';
            
        }
        while($row=mysqli_fetch_array($result));
    }
    echo '</ul>';
        

 }else
 {
      echo "<p align='center' id='poisc-eror1'>По пошуковому запиту нічого не знайдено!</p>";  
 }
}else{
        echo '<p align="center" id="poisc-eror">Пошукове значення повинно бути від 3 до 150 символів!</p>';
    }
    
    ?>
</br>
</br>
</div>


</div>

</body>
</html>