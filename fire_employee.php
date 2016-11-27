<?php
	include('session.php');
	if ($_SESSION['veduci'] != '1') {
		header("location: ?page=manage");
	}
	echo "<h1>Vyhodenie zamestnanca</h1>";
	$sql = "SELECT * FROM zamestnanci WHERE NOT login=''";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (isset($_POST['submit'])) {
		unset($_POST['submit']);
		$sql = "SELECT login FROM zamestnanci WHERE r_cislo='${_POST['employees']}'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row['login'] == $_SESSION['login_user']) {
			echo "<script>alert('Nemôžete vyhodiť sám seba!')</script>";
		} else {
			$sql = "UPDATE zamestnanci SET login=NULL WHERE r_cislo='${_POST['employees']}'";
			$result = mysqli_query($db, $sql);
			if ($result) {
				echo "<script>alert('Zamestnanec s rodným číslom ${_POST['employees']} bol prepustený!')</script>";
			}
			else {
				echo "<script>alert('Zamestnanca sa nepodarilo vyhodiť')</script>";
			}
		}
	}
?>
<form action="" method="POST">
	<table>
		<tr>
			<td>Vyberte zamestnanca </td>
			<td>
				<select id="emp" name="employees">
					<?php
					foreach ($rows as $employee) { ?>
						<option value="<?php echo $employee['r_cislo'] ?>"><?php echo "${employee['meno']} ${employee['priezvisko']}, ${employee['r_cislo']}, plat = ${employee['plat']}&euro; " ?></option>
					<?php }
					?>
				</select>
			</td>
		</tr>
	</table>
	<br>
	<input type="submit" name="submit" value="Prepustiť zamestnanca">
</form>
