<?php 
	include('session.php');
	if ($_SESSION['veduci'] != '1') {
		header("location: ?page=manage");
	}
	$sql = "SELECT * FROM zamestnanci";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (isset($_POST['submit'])) {
		unset($_POST['submit']);
		$sql = "SELECT login FROM zamestnanci WHERE r_cislo='${_POST['employees']}'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row['login'] == $_SESSION['login_user']) {
			echo "<h3>Nemôžete vyhodiť sám seba!</h3>";
		} else {
			$sql = "DELETE FROM zamestnanci WHERE r_cislo='${_POST['employees']}'";
			$result = mysqli_query($db, $sql);
			$sql = "SELECT * FROM zamestnanci";
			$result = mysqli_query($db, $sql);
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		}
		echo "Zamestnanec s rodným číslom ${_POST['employees']} prepustený!<br>";
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
