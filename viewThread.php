<?php include("Prepage.php"); set_top_page("Robotics - View Thread"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<?php
if (!isset($_GET['id'])) {
	echo "No Thread Specified.\n";
} else {
	$id = $_GET['id'];
	$results = safe_execute($dbconn, "SELECT * FROM threads WHERE id = $1$ LIMIT 1", array($id));
	$results2 = safe_execute($dbconn, "SELECT * FROM threads WHERE location = $1$", array($id));
	if ($results) {
		if (mysql_num_rows($results) == 1) {
			$row = mysql_fetch_array($results);
			if ($row['category'] == 0) 
				safe_execute($dbconn, "UPDATE threads SET view = view+1 WHERE id = $1$", array($id));
			$parent = 1;
			/*
				Now that I have all the data,
				I am just going to HTML mode and use PHP when needed
			*/
?>

<div id="nav_panel_forum">
<?php
/**
 * Back Button
 */
if ($row['location'] !== "/") {
	?>
	<input type="submit" onclick="window.location='viewThread.php?id=<?php echo $row['location']; ?>'" value="Back one Thread" />
	<?php
} else {
	?>
	<input type="submit" onclick="window.location='forums.php'" value="Back one Thread" />
	<?php
}
/**
 * Start a New Thread
 */
if ($_SESSION['auth'] > 0) {
	?><input type="submit" onclick="window.location='startThread.php?id=<?php echo $row['id']; ?>'" value="New Thread" /><?php
}
/**
 * Create new Category
 */
if ($_SESSION['auth'] >= 3 && $row['category'] == 1) {
	?><input type="submit" onclick="window.location='createCategory.php?id=<?php echo $row['id']; ?>'" value="Create Category" /><?php
}
?></div><!-- nav_panel_forum --><?php
if ($row['category'] == 1) {
getCategoryResult($dbconn, $row);
} else {
	do {
		if ($parent == 0) echo "<hr>";
		echo '<div id="author_info" style="display: table-cell; width: 150px; color: #F0F0F0; border-right: solid 2px;">
				<div id="author_info_text" style="color: #000000;">';
		$author_results = safe_execute($dbconn, "SELECT * FROM ParentStudentData WHERE id = $1$ LIMIT 1", array($row['author']));
		if ($author_results) {
			if (mysql_num_rows($author_results) > 0) {
				$author_row = mysql_fetch_array($author_results);
				echo "<b>{$author_row['firstname_student']} {$author_row['lastname_student']}</b><br />";
			} else {
				echo "Anonymous. (Error - No User Exists?)<br />";
			}
		} else {
			echo "Anonymous. (Error - SQL Statement Fail)<br />" . mysql_error() . "<br />";
		}
	?>
</div> <!-- author_info_text -->
</div> <!-- author_info -->

<div id="forum_text" style="display: table-cell; width: 750px; padding-left: 3px; text-align: left;">
<?php if ($parent == 1) {
?><b><?php echo $row['title']; ?></b><?php } ?><br /><br />
<?php echo bb($row['text']); ?><br />

</div><!-- forum_text --><br />
<?php
		$parent = 0;
	} while ($row = mysql_fetch_array($results2));
?>
<?php
if ($_SESSION['auth'] > 0) {
?>
<hr>
<div id="author_info" style="width: 150px; display: table-cell;">
&nbsp;
</div>
<div style="display: table-cell; width: 750px; text-align: left;">
<div id="image_add" class="textarea_click" onclick="insertAtCaret('reply_thread', '[IMG]www.example.com/URL_OF_IMAGE.png[/IMG]')">IMG</div>
<div id="url_add" class="textarea_click" onclick="insertAtCaret('reply_thread', '[LINK=www.google.com]Link[/LINK]')">LINK</div>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
Reply:<br />
<textarea id="reply_thread" name="message_for_reply" style="width: 95%; height: 200px;"></textarea><br />
<input type="submit" value="Reply" name="reply_thread">
</form>
<script>
function getCaret(id) {
	var elem = document.getElementById(id);
	if (elem.selectionStart) {
		return elem.selectionStart;
	} else return 0;
}
function insertAtCaret(id, text) {
	var elem = document.getElementById(id).value;
	var before = elem.substr(0, getCaret(id));
	var after = elem.substr(getCaret(id));
	document.getElementById(id).value = elem.substr(0, getCaret(id)) + text + elem.substr(getCaret(id));
}
</script>
</div>
<?php
} // Authentication for Posting Reply
} // Category IF-ELSE
		} else { // mysql_num_rows()
			echo "No Such Thread.<br />";
		}
	} else {
		echo "No Such Thread.<br />";
	}
}
?>
</div><!-- main_content -->
</body>
</html>
