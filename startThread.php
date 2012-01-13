<?php include("Prepage.php"); set_top_page("Robotics - Create Thread"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<?php
if (!isset($_GET['id'])) {
	echo "You cannot create a thread here.<br />";
} else if ($_SESSION['auth'] > 0) {
	?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
Title: <input type="text" name="thread_title"><br />
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="checkbox" id="tutorial_value" name="tutorial_value">
<label for="tutorial_value" onmouseover="this.style.cursor='pointer'" onmouseout="this.style.cursor='auto'">
Check this box if this thread should be recognized as a tutorial.</label><br />
Message: <br />
<textarea name="thread_message" style="width: 95%; height: 200px;"></textarea>
<input type="submit" name="thread_submit" value="Create Thread" />
</form>
	<?php
}
?>
</div><!-- main_content -->
</body>
</html>
