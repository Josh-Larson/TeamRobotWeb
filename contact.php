<?php include("Prepage.php"); set_top_page("Robotics Contact"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<?php
function spamcheck($field)
  {
  //filter_var() sanitizes the e-mail
  //address using FILTER_SANITIZE_EMAIL
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

  //filter_var() validates the e-mail
  //address using FILTER_VALIDATE_EMAIL
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }
if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message'])) {
	$subject = "";
	$to = "jesse.loi@team2502.com"; // Defaults to Jesse Loi
	$email_to = $_POST['email_to'];
	if ($email_to == "captains") {
		$to = "captains@team2502.com";
	} else if ($email_to = "alex") {
		$to = "alex.reinking@team2502.com";
	} else if ($email_to = "blake") {
		$to = "blake.trantina@team2502.com";
	} else if ($email_to = "jesse") {
		$to = "jesse.loi@team2502.com";
	} else if ($email_to = "joe") {
		$to = "joe.haynes@team2502.com";
	} else if ($email_to = "justine") {
		$to = "justine.myers@team2502.com";
	} else if ($email_to = "kat") {
		$to = "kat.hammer@team2502.com";
	}
	if (isset($_POST['subject'])) $subject = $_POST['subject'];
	$email = spamcheck($_POST['email']);
	if ($email == TRUE) $email = $_POST['email'];
	if ($email !== FALSE) {
		mail($to, $subject, $_POST['message'], "From: ".$email."\r\n");
	}
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table>
<tr><td>&nbsp;</td><td>Email To:</td><td><select name="email_to">
<option value="captains">Captains and Mentors</option>
<option value="alex">Programming - Alex Reinking</option>
<option value="blake">Marketing - Blake Trantina</option>
<option value="jesse">Marketing - Jesse Loi</option>
<option value="joe">Build - Joe Haynes</option>
<option value="justine">Build - Justine Myers</option>
<option value="kat">Electrical - Kat Hammer</option>
</select></td></tr>
<tr><td>* </td><td>Your Name:</td><td><input type="text" name="name"></td></tr>
<tr><td>* </td><td>Your Email:</td><td><input type="text" name="email"></td></tr>
<tr><td>&nbsp;</td><td>Subject:</td><td><input type="text" name="subject"></td></tr>
<tr><td>* </td><td>Message:</td><td>&nbsp;</td></tr>
</table>
<textarea name="message" style="width: 70%; height: 200px;"></textarea><br />
<input type="submit" value="Send Email">
</form>
</div><!-- main_content -->
</body>
</html>
