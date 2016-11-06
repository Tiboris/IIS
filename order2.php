<?php
	include('session.php');
	$_SESSION['id_dod'] = $_POST['id_dod'];
	$sql = "SELECT syry.nazov, syry.id_syr FROM dodavatelia INNER JOIN ponukaju ON dodavatelia.id_dod=ponukaju.id_dod INNER JOIN syry ON ponukaju.id_syr=syry.id_syr WHERE dodavatelia.id_dod=${_POST['id_dod']}";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	unset($_POST);
?>
<h1>Objednať - Výber syrov</h1>
<form action="?page=order3" method="POST">
	<table>
		<tr>
			<td>* Vybrať syry</td>
			<td>
				<select name="id_syr[]" multiple required="yes">
					<?php
					foreach ($rows as $cheese) { ?>
						<option value="<?php echo $cheese['id_syr'] ?>"><?php echo "${cheese['nazov']}" ?></option>
					<?php } 
					?>
				</select>
			 </td>
			<td><input type="submit" name="submit" value="Pokračovať"></td>
		</tr>
	</table>
	<p>Držte CTRL pre označenie viacerých možností</p>
</form>
