<?php include("Prepage.php"); set_top_page("Robotics Home"); ?>
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
	$to = "joshua@ourclan.net";
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
