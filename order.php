<?php
	include('session.php');
	$sql = "SELECT * FROM dodavatelia";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<h1>Objednať - Výber dodávateľa</h1>
<form action="?page=order2" method="POST">
	<table>
		<tr>
			<td>Vybrať dodávateľa: </td>
			<td>
				<select name="id_dod">
					<?php
					foreach ($rows as $supplier) { ?>
						<option value="<?php echo $supplier['id_dod'] ?>"><?php echo "${supplier['nazov']}, ${supplier['mesto']}" ?></option>
					<?php } 
					?>
				</select>
			</td>
			<td><input type="submit" name="submit" value="Pokračovať"></td>
		</tr>
	</table>
</form>
