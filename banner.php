<script type="text/javascript">
function login_keep_fields() {
	var user = document.getElementById("user_login");
	var pass = document.getElementById("pass_login");
}
</script>
<div id="banner_container">
<div id="banner_img_container">
<img src="robot_icon.png" style="border: solid 0px; height: 150px;" />
</div>
<div id="navigation_container">
<div id="login_form">
<?php
if ($_SESSION['auth'] == 0) {
?>
<form method="post" action="index.php" style="text-align: right;">
<input type="hidden" value="Yes" name="login_form">
<input type="text" value="Email Address" name="user" id="user" style="font-size: 13px; width: 140px;">
<input type="password" value="Password" name="pass" id="pass" style="font-size: 13px; width: 140px;">
<input type="submit" value="Login"> &nbsp;<a style="font-size: 13px;" href="createAccount.php">Create Account</a>
</form>
<?php
} else {
	echo "Welcome, " . $_SESSION['fname'] . " ";
	echo "<input type='submit' value='Logout' onclick='window.location=\"index.php?logout=yes\"' />";
}
?>
</div> <!-- login_form -->
<div id="navigation">
<table>
<tr>
<td style="border-right: solid 1px; background-color: inherit; padding: 3px;"
	onmouseover="this.style.backgroundColor='#AFAFAF'; this.style.cursor = 'pointer'; this.style.cursor = 'pointer'"
	onmouseout="this.style.backgroundColor='inherit'; this.style.cursor = 'auto'"
	onclick="window.location='index.php'">Home</td>

<?php if ($_SESSION['auth'] > 0) { ?>
<td style="border-right: solid 1px; background-color: inherit; padding: 3px;"
	onmouseover="this.style.backgroundColor='#AFAFAF'; this.style.cursor = 'pointer'"
	onmouseout="this.style.backgroundColor='inherit'; this.style.cursor = 'auto'"
	onclick="window.location='account.php'">My Account</td>
<?php } else { ?>
<td style="border-right: solid 1px; background-color: inherit; padding: 3px;"
	onmouseover="this.style.backgroundColor='#AFAFAF'; this.style.cursor = 'pointer'"
	onmouseout="this.style.backgroundColor='inherit'; this.style.cursor = 'auto'"
	onclick="window.location='createAccount.php'">Create Account</td>
<?php } ?>

<td style="border-right: solid 1px; background-color: inherit; padding: 3px;"
	onmouseover="this.style.backgroundColor='#AFAFAF'; this.style.cursor = 'pointer'"
	onmouseout="this.style.backgroundColor='inherit'; this.style.cursor = 'auto'"
	onclick="window.location='forums.php'">Forums</td>

<td style="background-color: inherit; padding: 3px; border-right: solid 1px;"
	onmouseover="this.style.backgroundColor='#AFAFAF'; this.style.cursor = 'pointer'"
	onmouseout="this.style.backgroundColor='inherit'; this.style.cursor = 'auto'"
	onclick="window.location='team.php'">Our Team</td>

<td style="background-color: inherit; padding: 3px;"
	onmouseover="this.style.backgroundColor='#AFAFAF'; this.style.cursor = 'pointer'"
	onmouseout="this.style.backgroundColor='inherit'; this.style.cursor = 'auto'"
	onclick="window.location='contact.php'">Contact</td>

</tr>
</table>
</div> <!-- navigation -->
</div> <!-- navigation_container -->
</div> <!-- banner_container -->

