<?php include("Prepage.php"); set_top_page("Robotics - View Account"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<?php
if ($_SESSION['auth'] > 0 && isset($_SESSION['id'])) {
$user_results = safe_execute($dbconn, "SELECT * FROM ParentStudentData WHERE id = $1$", array($_SESSION['id']));
if (mysql_num_rows($user_results) == 1) {
$row = mysql_fetch_array($user_results);
$class_rd = "";
$class_at1 = "";
$parent_interest = "";
$company_interest = "";
$food_help = "";
if ($row['class_rd'] == 1) $class_rd = "checked=\"CHECKED\"";
if ($row['class_at1'] == 1) $class_at1 = "checked=\"CHECKED\"";
if ($row['parent_interest'] == 1) $parent_interest = "checked=\"CHECKED\"";
if ($row['company_contact'] == 1) $company_interest = "checked=\"CHECKED\"";
if ($row['food_help'] == 1) $food_help = "checked=\"CHECKED\"";
?>
<form method="post" action="account.php">
<fieldset>
<legend>Student Contact Information</legend>
<ul>

<li> <label for="firstname_student">First name: </label>
     <input type="text" name="firstname_student" value="<?php echo $row['firstname_student']; ?>"/>
</li>
<li> <label for="lastname_student">Last name: </label>
     <input type="text" name="lastname_student" value="<?php echo $row['lastname_student']; ?>" />
</li>
<li> <label for="email_student">Email address: </label>
     <input type="text" name="email_student" value="<?php echo $row['email_student']; ?>" />

</li>
<li> <label for="phone_student">Phone number: </label>
     <input type="text" name="phone_student" value="<?php echo $row['phone_student']; ?>" />
</li>
</ul>
</fieldset>
<div>
<fieldset style="width: 410px; display: table-cell; float: left;">
<legend>Parent Contact Information (Parent 1)</legend>
<ul>
<li> <label for="firstname_parent1">First name: </label>

     <input type="text" name="firstname_parent1" value="<?php echo $row['firstname_parent1']; ?>" />
</li>
<li> <label for="lastname_parent1">Last name: </label>
     <input type="text" name="lastname_parent1" value="<?php echo $row['lastname_parent1']; ?>" />
</li>
<li> <label for="email_parent1">Email address: </label>
     <input type="text" name="email_parent1" value="<?php echo $row['email_parent1']; ?>" />
</li>
<li> <label for="phone_parent1">Phone number: </label>

     <input type="text" name="phone_parent1" value="<?php echo $row['phone_parent1']; ?>" />
</li>
</ul>
</fieldset>
<fieldset style="width: 410px; display: table-cell; float: right;">
<legend>Parent Contact Information (Parent 2)</legend>
<ul>
<li> <label for="firstname_parent2">First name: </label>
     <input type="text" name="firstname_parent2" value="<?php echo $row['firstname_parent2']; ?>" />
</li>
<li> <label for="lastname_parent2">Last name: </label>

     <input type="text" name="lastname_parent2" value="<?php echo $row['lastname_parent2']; ?>" />
</li>
<li> <label for="email_parent2">Email address: </label>
     <input type="text" name="email_parent2" value="<?php echo $row['email_parent2']; ?>" />
</li>
<li> <label for="phone_parent2">Phone number: </label>
     <input type="text" name="phone_parent2" value="<?php echo $row['phone_parent2']; ?>" />
</li>
</ul>
</fieldset>

</div>
<fieldset>
<legend>Emergency Contact Information</legend>
<ul>
<li> <label for="firstname_emergency">First name: </label>
     <input type="text" name="firstname_emergency" value="<?php echo $row['firstname_emergency']; ?>" />
</li>
<li> <label for="lastname_emergency">Last name: </label>
     <input type="text" name="lastname_emergency" value="<?php echo $row['lastname_emergency']; ?>" />
</li>

<li> <label for="email_emergency">Email address: </label>
     <input type="text" name="email_emergency" value="<?php echo $row['email_emergency']; ?>" />
</li>
<li> <label for="phone_emergency">Phone number: </label>
     <input type="text" name="phone_emergency" value="<?php echo $row['phone_emergency']; ?>" />
</li>
</ul>
</fieldset>
<fieldset>
<legend>Other</legend>
<ul>
<li> <label for="class_rd">Research and Design</label>
     <input type="checkbox" name="class_rd" id="class_rd" <?php echo "$class_rd"; ?>/>

</li>
<li> <label for="class_at1">Applied Technology 1</label>
     <input type="checkbox" name="class_at1" id="class_at1" <?php echo "$class_at1"; ?>/>
</li>
<br/>
<p>
<input type="checkbox" name="parent_interest" <?php echo "$parent_interest"; ?>/>
If one or both of your parents is interested in being a mentor for the team this year, please check this box.<br/>
<input type="checkbox" name="company_contact" <?php echo "$company_interest"; ?>/>
If one or both of your parents would be willing to approach their company to ask for sponsorship for the team this year, please check this box.<br/>

<input type="checkbox" name="food_help" <?php echo "$food_help"; ?>/>
If one or both of your parents would be willing to provide snacks for the team, please check this box.
</p>
<p>If you have any health concerns we should know about, please briefly detail them here:<br/>
<textarea name="health_concerns" rows="3" cols="25">
<?php echo $row['health_concerns']; ?>
</textarea>
</p>
<p>
<input type="Submit" value="Submit!" name="update_account_form"/>
</p>
</form>
<?php } else { echo "Error - You don't exist."; } } else echo "You need to be logged in to do this.<br />"; ?>
</div><!-- main_content -->
</body>
</html>
