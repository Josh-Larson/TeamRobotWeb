<?php include("Prepage.php"); set_top_page("Robotics - Forums"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<div id="forum_container">
<?php
$results = safe_execute($dbconn, "SELECT * FROM threads WHERE location = '/' AND category = 1 ORDER BY id", array());
while ($row = mysql_fetch_array($results)) {
	?>
<div id="category_forum" style="height: 40px;">
<a style="text-decoration: none; color: #000000;" href="<?php echo 'viewThread.php?id='.$row['id']; ?>" onmouseover="this.cursor='pointer'" onmouseout="this.cursor='auto'">
<div style="float: left;"><img alt="Category Icon" style="border: solid 0px;" src="<?php echo $row['icon']; ?>" width="40" height="40"></div>
<?php echo $row['title']; ?>
<br />
<a style="text-decoration: none;" href="<?php echo 'viewThread.php?id='.$row['id']; ?>" onmouseover="this.cursor='pointer'" onmouseout="this.cursor='auto'" id="category_description">
<?php echo $row['text']; ?>
</a>
</a>
</div> <!-- category_forum -->
	<?php
}
?>
<br />

</div> <!-- forum_container -->
</div><!-- main_content -->
</body>
</html>
