<!DOCTYPE HTML>
<?php
	ini_set("default_charset", "UTF-8");
	// echo 'Current PHP version: ' . phpversion();
	function mysqli_fetch_all($result, $arg)
	{// PHP installation was not compiled with mysqlnd
		$rows = array();
		while ($row = $result->fetch_assoc()) {
	    	$rows[] = $row;
		}
		return $rows;
	}

	if (!isset($_SESSION)) {
		session_start();
		//logout after 10 min
		if (isset($_SESSION['time'])) {
			if(time() - $_SESSION['time'] > 600) {
			    echo "<script>alert('Boli ste odhlásený z dôvodu neaktivity dlhšej ako 10 minút');</script>";
			    session_destroy();
			    header("location: ?page=login");
			} else {
			    $_SESSION['time'] = time();
			}
		}
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Informačný systém pre predajňu so syrmi - SYRIIS</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<?php
	if(isset($_GET['page'])){$_GET['page']=$_GET['page'];}
	else {$_GET['page'] = "";}
	?>
</head>
<body>
	<header>
		<nav>
			<div id="logo"><h1>SYRIIS</h1></div>
			<ul>
				<li <?php if($_GET['page']=="home"){ echo "class='active'";} ?> ><a href="?page=home"> Home</a></li>
				<li <?php if($_GET['page']=="add_cheese"){ echo "class='active'";} ?> ><a href="?page=add_cheese">Pridať syr</a></li>
				<li <?php if($_GET['page']=="change_emplacement"){ echo "class='active'";} ?> ><a href="?page=change_emplacement">Premiestniť bochník</a></li>
				<li <?php if($_GET['page']=="order"){ echo "class='active'";} ?> ><a href="?page=order"> Objednať</a></li>
				<li <?php if($_GET['page']=="find"){ echo "class='active'";} ?> ><a href="?page=find"> Hľadať</a></li>
				<li <?php if($_GET['page']=="loaves" or $_GET['page']=="loaf"){ echo "class='active'";} ?> ><a href="?page=loaves"> Bochníky</a></li>
				<li <?php if(in_array($_GET['page'], array("manage", "add_employee", "fire_employee", "change_salary"))){ echo "class='active'";} ?> ><a href="?page=manage"> Správa zamestnancov</a></li>
				<?php if (isset($_SESSION['login_user'])) { ?>
					<li <?php if($_GET['page']=="logout"){ echo "class='active'";} ?> ><a href="?page=logout"> Logout</a></li>
				<?php } else { ?>
					<li <?php if($_GET['page']=="login"){ echo "class='active'";} ?> ><a href="?page=login"> Login</a></li>
				<?php } ?>
			</ul>
		</nav>
	</header>
	<section>
		<div id="center">
			<article>
				<?php
					if(!empty($_GET['page'])) {
						if (!file_exists($_GET['page'].".php"))
							include("home.php");
						else
							include($_GET['page'] .".php");
					}
					else
						include("login.php");
				?>
			</article>
			<div class="clear"></div>
		</div>
	</section>
	<footer>
		 Patrik Segedy (xseged00) &amp; Tibor Dudlák (xdudla00) &copy;2016
	</footer>
</body>
</html>
