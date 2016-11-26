<?php
	include('session.php');
	$_SESSION['datum'] = $_POST['datum'];
	$_SESSION['umiestnenie'] = $_POST['umiestnenie'];
	unset($_POST);

	// objednavka
	$sql = "SELECT r_cislo FROM zamestnanci WHERE login='${_SESSION['login_user']}'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$sql = "INSERT INTO objednavky (datum, suma, r_cislo, id_dod) VALUES ('${_SESSION['datum']}', ${_SESSION['suma']}, '${row['r_cislo']}', ${_SESSION['id_dod']})";
	$result = mysqli_query($db, $sql);
	if (!$result) {
		echo "<script>alert('Objednávku sa nepodarilo pridať')</script>";
	}
	$last_id = mysqli_insert_id($db);
	$_SESSION['last_id'] = $last_id;

	// bochniky
	for ($i=0; $i < sizeof($_SESSION['id_syrov']); $i++) {
		$id_syr = $_SESSION['id_syrov'][$i];
		$hmot = $_SESSION['hmot_syrov'][$i];
		$krajina = $_SESSION['krajiny_syrov'][$i];
		$trvan = $_SESSION['trvan_syrov'][$i];
		$tuk = $_SESSION['tuk_syrov'][$i];
		$sql = "INSERT INTO bochniky (id_syr, akt_hmot, poc_hmot, krajina, trvanlivost, tuk, umiestnenie, id_obj) VALUES ($id_syr, $hmot, $hmot, '$krajina', '$trvan', $tuk, '${_SESSION['umiestnenie']}', $last_id)";
		$result = mysqli_query($db, $sql);
		if (!$result) {
			echo "<script>alert('Objednávku sa nepodarilo pridať')</script>";
		}
	}
	header("location: ?page=order6");
?>
