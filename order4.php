<?php
	include('session.php');
	$_SESSION['hmot_syrov'] = $_POST['hmot'];
	$_SESSION['tuk_syrov'] = $_POST['tuk'];
	$_SESSION['trvan_syrov'] = $_POST['trvan'];
	$_SESSION['krajiny_syrov'] = $_POST['krajiny'];
	$sql = "SELECT syry.nazov, syry.id_syr FROM dodavatelia INNER JOIN ponukaju ON dodavatelia.id_dod=ponukaju.id_dod INNER JOIN syry ON ponukaju.id_syr=syry.id_syr WHERE dodavatelia.id_dod=${_SESSION['id_dod']}";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	unset($_POST);
?>
<h1>Dokončenie objednávky</h1>
<form action="?page=order5" method="POST">
	<table>
		<tr>
			<td>Dátum objednávky: </td>
			<td><input type="date" min="1970-01-01" max="2100-01-01" name="datum" required="yes" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" placeholder="YYYY-MM-DD"  title="datum minimalnej trvanlivosti vo formate YYYY-MM-DD od 1970-01-01 do 2100-01-01" value=<?php echo date('Y-m-d') ?>> *</td>
		</tr>
		<tr>
			<td>Suma objednávky: </td>
			<td><input type="number" name="suma" min="1" title="Suma objednávky" required="yes"> &euro; *</td>
		</tr>
		<tr>
			<td>Objednať na: </td>
			<td>
				<select name="umiestnenie" required="yes">
					<option value="predajna">Predajňu</option>
					<option value="sklad">Sklad</option>
				</select>
			</td>
		</tr>
	</table>
	<br>
	<input type="submit" name="submit" value="Dokončiť">
</form>
