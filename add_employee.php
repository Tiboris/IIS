<?php 
	include('session.php');
	if ($_SESSION['veduci'] != '1') {
		header("location: ?page=manage");
	}
	$sql = "SELECT * FROM zamestnanci";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (isset($_POST['submit'])) {
		var_dump($_POST);
		unset($_POST['submit']);
			$sql = "INSERT INTO zamestnanci (r_cislo, login, pass, meno, priezvisko, ulica, cislo, mesto, psc, plat, veduci) VALUES ('${_POST['r_cislo']}', '${_POST['login']}', '${_POST['pass']}', '${_POST['meno']}', '${_POST['priezvisko']}', '${_POST['ulica']}', ${_POST['cislo']}, '${_POST['mesto']}', '${_POST['psc']}', ${_POST['plat']}, ${_POST['veduci']})";
			$result = mysqli_query($db, $sql);
			var_dump($result);
			$sql = "SELECT * FROM zamestnanci";
			$result = mysqli_query($db, $sql);
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			var_dump($rows);
	}
?>
<h1>Pridať zamestanca</h1>
<form action="" method="POST">
	<table>
		<tr>
			<td>Meno: </td>
			<td><input type="text" name="meno" maxlength="20" placeholder="John" required="yes" pattern="[a-zA-Z]+"> *</td>
		</tr>
		<tr>
			<td>Priezvisko: </td>
			<td><input type="text" name="priezvisko" maxlength="20" placeholder="Doe" required="yes" pattern="[a-zA-Z]+"> *</td>
		</tr>
		<tr>
			<td>Rodné číslo: </td>
			<td><input type="text" name="r_cislo" maxlength="20" placeholder="940514/9538" required="yes" pattern="[0-9]{6}/[0-9]{4}"> *</td>
		</tr>
		<tr>
			<td>Login: </td>
			<td><input type="text" name="login" maxlength="32" placeholder="janik" required="yes" pattern="[a-zA-Z0-9]+"> *</td>
		</tr>
		<tr>
			<td>Heslo: </td>
			<td><input type="password" name="pass" maxlength="20" required="yes"> *</td>
		</tr>
		<tr>
			<td>Ulica: </td>
			<td><input type="text" name="ulica" maxlength="30" placeholder="Kolejní" pattern="[a-zA-Z]+"></td>
			<td>Číslo: </td>
			<td><input type="number" name="cislo" max="100" placeholder="2"></td>
		</tr>
		<tr>
			<td>Mesto: </td>
			<td><input type="text" name="mesto" maxlength="30" placeholder="Brno" pattern="[a-zA-Z]+"></td>
			<td>PSČ: </td>
			<td><input type="text" name="psc" minlength="5" maxlength="5" placeholder="61200" pattern="[0-9]+"></td>
		</tr>
		<tr>
			<td>Plat: </td>
			<td><input type="number" name="plat" min="0" max="10000000" placeholder="500"></td>
		</tr>
		<tr>
			<td>Vedúci: </td>
			<td><input type="number" name="veduci" min="0" max="1" placeholder="0" required="yes"> *</td>
		</tr>
	</table>
	<br>
	<input type="submit" name="submit" value="Pridať zamestnanca">
</form>
