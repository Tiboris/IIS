<?php
	include('session.php');
	$_SESSION['id_syrov'] = $_POST['id_syr'];
	$sql = "SELECT syry.nazov, syry.id_syr FROM dodavatelia INNER JOIN ponukaju ON dodavatelia.id_dod=ponukaju.id_dod INNER JOIN syry ON ponukaju.id_syr=syry.id_syr WHERE dodavatelia.id_dod=${_SESSION['id_dod']}";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	unset($_POST);
?>
<h1>Objednať - Informácie o syroch</h1>
<form action="?page=order4" method="POST">
	<table>
	<?php
		foreach ($rows as $cheese) {
			if (in_array($cheese['id_syr'], $_SESSION['id_syrov'])) {  ?>
				<tr>
					<td><b><?php echo "${cheese['nazov']}" ?> </b></td>
					<td> hmotnosť: </td>
					<td><input type="number" name="hmot[]" min="1.0" max="100.0" required="yes" title="hmotnosť" step=0.01> kg *</td>
					<td> tuk: </td>
					<td><input type="number" name="tuk[]" min="1" max="100" required="yes" title="percento tuku"> % *</td>
					<td> trvanlivosť: </td>
					<td><input type="date" min="1970-01-01" max="2100-01-01" name="trvan[]" required="yes" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" placeholder="YYYY-MM-DD"  title="datum minimalnej trvanlivosti vo formate YYYY-MM-DD od 1970-01-01 do 2100-01-01"> *</td>
					<td> krajina: </td>
					<td>
						<select name="krajiny[]" title="krajina pôvodu">
							<?php
								$sql = "SELECT nazov, skratka FROM krajiny";
								$result = mysqli_query($db, $sql);
								$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
								foreach ($rows as $country) { ?>
									<option value="<?php echo $country['skratka'] ?>"><?php echo $country['nazov'] ?></option>
								<?php }
							?>
						</select>
					</td>
				</tr>
			<?php }
		}
	?>
	</table>
	<br>
	<input type="submit" name="submit" value="Pokračovať">
</form>
