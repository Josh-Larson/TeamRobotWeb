<?php include("Prepage.php"); set_top_page("Robotics - Create Thread"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<?php
if (!isset($_GET['id'])) {
	echo "You cannot create a thread here.<br />";
} else if ($_SESSION['auth'] >= 3) {
	?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
Title: <input type="text" name="category_title"><br />
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
Description: <br />
<input type="text" name="category_description" style="width: 95%;">
<input type="submit" name="category_submit" value="Create Category" />
</form>
	<?php
}
?>
</div><!-- main_content -->
</body>
</html>
