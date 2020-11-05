<?php
define('admin23', true);
include("include/db_connect.php");
include("functions/functions.php");
session_start();

$id= clear_string($_GET["id"]);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
 	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
       
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-3.1.1.min"></script>
    <script type="text/javascript" src="/js/ji.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
 
	<title>Информация о контакте</title>
    
</head>

<body>
<div id="block-body">
	<div id="block-header">
		<?php
			include("include/block-header.php");	
		?>
	</div>


<div id="block-content">
<?php
	$result1=mysqli_query($link, "SELECT * FROM `table_phone` WHERE id='$id'");
    if (mysqli_num_rows($result1) > 0)
        {
        $row1=mysqli_fetch_array($result1);
               
        do{
                                 
            echo '
			
			<h1 class="title_inform">Информация о контакте</h1>
			</br>

            <div class="cart-tovar-list-view">
	

						<div class="flex-tovar-list-view">						          
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["name"].'</a></p>
						</div>
						
						<div class="flex-tovar-list-view">						          
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["surname"].'</a></p>
						</div>
						
						<div class="flex-tovar-list-view">						          
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num1"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num2"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num3"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num4"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num5"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num6"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num7"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num8"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num9"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num10"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num11"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num12"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num13"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num14"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num15"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num16"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num17"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num18"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num19"].'</a></p>
							<p class="style-tittle-list-view" ><a href="view_content.php?id='.$row1["id"].'">'.$row1["num20"].'</a></p>
						</div>
					
							
					</div>
 
            ';
            }
             while($row1=mysqli_fetch_array($result1));
                       
 
 
 }
?>
</div>

</div>

</body>
</html>