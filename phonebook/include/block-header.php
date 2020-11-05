<?php
	defined('admin23') or die('Доступ запрещен!');
	
?>

<div id="block-header">


		<h1>Телефонная книга</h1>

	<div id="block-search">
		<form method="GET" action="search.php?q=">
			<span></span>
				<input type="text" id="input-search" name="q" placeholder="Введите фамилию" value="<?php $search = $search ?? ''; echo $search; ?>" />
				<input type="submit" id="button-search" value="Поиск"/>
		</form>
	</div>
	
	<div class="edit">
		<a href="admin/tovar.php">редактировать</a>
	</div>
	</br>
	<div class="home">
		<a href="index.php"><img src="images/home.png"></a>
	</div>

</div>