<?php
define('admin23', true);
include("include/db_connect.php");
include("functions/functions.php");
session_start();

$cat= clear_string( isset($_GET["cat"])) ?? '';
$type= clear_string( isset($_GET["type"])) ?? '';
//$sorting=$_GET["sort"] ?? '';
//$page=(isset ($_GET['page'])) ?? '';

// Включение сообщений о всех ошибках
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


/*Убирает ошибку Notice: Undefined variable:*/
error_reporting(E_ALL & ~E_NOTICE);

	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-3.1.1.min"></script>
    <script type="text/javascript" src="/js/ji.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/js/textchange.js"></script>



	<title>Телефонная книга</title> 
</head>

<body>

<div id="block-body">
	
	<div id="block-header">
		<?php
			include("include/block-header.php");	
		?>
	</div>
	

<div id="block-content">


<ul id="block-tovar-list">
<?php


	//---Calculation quantity page---------
    $num=12;

    
    $count=mysqli_query($link, "SELECT COUNT(*) FROM `table_phone`");
    $temp=mysqli_fetch_array($count);
    
    if ($temp[0]>0){
        $tempcount=$temp[0];
        //Находим общее число страниц
        $total=(($tempcount-1)/$num)+1;
        $total=intval($total);
        
        if(isset($_GET['page']))
            $page=(int)$_GET['page'];
        //$page=intval($page);
        
        if(empty($page) or $page<0) $page=1;
        if($page>$total) $page=$total;
        
        $start=$page*$num-$num;
        
        $qury_start_num="LIMIT $start, $num";
        
    }
//----End calculation quantity page--------------  



	$result=mysqli_query($link, "SELECT * FROM `table_phone` $qury_start_num");
    if (mysqli_num_rows($result) > 0){
        
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
    
    //нижняя навигация по страницам
    if($page!=1){$pstr_prev='<li><a class="pstr-prev" href="index.php?page='.($page-1).'">&lt;</a></li>';}
    if($page!=$total) $pstr_next='<li><a class="pstr-next" href="index.php?page='.($page+1).'">&gt;</a></li>';
    
    if($page-5>0) $page5left='<li><a href="index.php?page='.($page-5).'">'.($page-5).'</a></li>';
    if($page-4>0) $page4left='<li><a href="index.php?page='.($page-4).'">'.($page-4).'</a></li>';
    if($page-3>0) $page3left='<li><a href="index.php?page='.($page-3).'">'.($page-3).'</a></li>';
    if($page-2>0) $page2left='<li><a href="index.php?page='.($page-2).'">'.($page-2).'</a></li>';
    if($page-1>0) $page1left='<li><a href="index.php?page='.($page-1).'">'.($page-1).'</a></li>';
    
    if($page+5<=$total) $page5right='<li><a href="index.php?page='.($page+5).'">'.($page+5).'</a></li>';
    if($page+4<=$total) $page4right='<li><a href="index.php?page='.($page+4).'">'.($page+4).'</a></li>';
    if($page+3<=$total) $page3right='<li><a href="index.php?page='.($page+3).'">'.($page+3).'</a></li>';
    if($page+2<=$total) $page2right='<li><a href="index.php?page='.($page+2).'">'.($page+2).'</a></li>';
    if($page+1<=$total) $page1right='<li><a href="index.php?page='.($page+1).'">'.($page+1).'</a></li>';
    
    
    if($page+5<$total){
        $strtotal='<li><p class="nav-point">...</p></li><li><a href="index.php?page='.$total.'">'.$total.'</a></li>';
    }
    else{
        $strtotal="";
    }
    
    if($total>=1){
        echo '
        <div class="pstrnav">
        <ul>
        ';
		if(!isset($pstr_prev))
			$pstr_prev = '';
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
		if(!isset($pstr_next))
			$pstr_next = '';
		
        
        echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='index.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
       echo '
        </ul>
        </div>
		</br>
        ';
    }
    //--------------------------------------------
?>

</div>

</div>


</body>
</html>