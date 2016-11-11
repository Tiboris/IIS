<?php
	if (!isset($_SESSION)) {
		session_start();
		// if (isset($_SESSION['time'])) {
		// 	if(time() - $_SESSION['time'] > 10) { 
		// 	    echo "<script>alert('Boli ste odhlásený z dôvodu neaktivity dlhšej ako 10 minút');</script>";
		// 	    session_destroy();
		// 	    header("location: ?page=login");
		// 	} else {
		// 	    $_SESSION['time'] = time();
		// 	}
		// }
	}
?>
<!DOCTYPE HTML>
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
				<li <?php if($_GET['page']=="add"){ echo "class='active'";} ?> ><a href="?page=add">Pridať syr</a></li>
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