<?php include("Prepage.php"); set_top_page("Robotics - Create Account"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<?php
if ($create_account_request == 1) {
	echo "Create Account is Fine.<br />";
} else if ($create_account_request == -1) {
	echo "There was an error while creating your account.<br />";
}
?>
<form method="post" action="createAccount.php">
<fieldset>
<legend>Student Contact Information</legend>
<ul>

<li> <label for="firstname_student">First name: </label>
     <input type="text" name="firstname_student" />
</li>
<li> <label for="lastname_student">Last name: </label>
     <input type="text" name="lastname_student" />
</li>
<li> <label for="email_student">Email address: </label>
     <input type="text" name="email_student" />

</li>
<li> <label for="phone_student">Phone number: </label>
     <input type="text" name="phone_student" />
</li>
<li> <label for="pass_student">Password: </label>
	 <input type="password" name="pass" />
</li>
</ul>
</fieldset>
<div>
<fieldset class="left-side">
<legend>Parent Contact Information (Parent 1)</legend>
<ul>
<li> <label for="firstname_parent1">First name: </label>

     <input type="text" name="firstname_parent1" />
</li>
<li> <label for="lastname_parent1">Last name: </label>
     <input type="text" name="lastname_parent1" />
</li>
<li> <label for="email_parent1">Email address: </label>
     <input type="text" name="email_parent1" />
</li>
<li> <label for="phone_parent1">Phone number: </label>

     <input type="text" name="phone_parent1" />
</li>
</ul>
</fieldset>
<fieldset class="right-side">
<legend>Parent Contact Information (Parent 2)</legend>
<ul>
<li> <label for="firstname_parent2">First name: </label>
     <input type="text" name="firstname_parent2" />
</li>
<li> <label for="lastname_parent2">Last name: </label>

     <input type="text" name="lastname_parent2" />
</li>
<li> <label for="email_parent2">Email address: </label>
     <input type="text" name="email_parent2" />
</li>
<li> <label for="phone_parent2">Phone number: </label>
     <input type="text" name="phone_parent2" />
</li>
</ul>
</fieldset>

</div>
<fieldset>
<legend>Emergency Contact Information</legend>
<ul>
<li> <label for="firstname_emergency">First name: </label>
     <input type="text" name="firstname_emergency" />
</li>
<li> <label for="lastname_emergency">Last name: </label>
     <input type="text" name="lastname_emergency" />
</li>

<li> <label for="email_emergency">Email address: </label>
     <input type="text" name="email_emergency" />
</li>
<li> <label for="phone_emergency">Phone number: </label>
     <input type="text" name="phone_emergency" />
</li>
</ul>
</fieldset>
<fieldset>
<legend>Subteam Interests</legend>

<ul>
<li> <label for="subteam_request1">Build Team</label>
     <input type="checkbox" name="subteam_request1" id="subteam_request1" />
</li>
<li> <label for="subteam_request2">Electrical Team</label>
     <input type="checkbox" name="subteam_request2" />
</li>
<li> <label for="subteam_request3">Programming Team</label>
     <input type="checkbox" name="subteam_request3" />

</li>
<li> <label for="subteam_request4">Marketing Team</label>
     <input type="checkbox" name="subteam_request4" />
</li>
</ul><br/>
<div name="buildclasses" id="buildclasses">
<p>If you have taken any of these two courses, please check their respective boxes.</p>
<ul>
<li> <label for="class_rd">Research and Design</label>
     <input type="checkbox" name="class_rd" id="class_rd" />

</li>
<li> <label for="class_at1">Applied Technology 1</label>
     <input type="checkbox" name="class_at1" id="class_at1" />
</li>
</div>
</fieldset>
<br/>
<p>
<input type="checkbox" name="parent_interest" />
If one or both of your parents is interested in being a mentor for the team this year, please check this box.<br/>
<input type="checkbox" name="company_contact" />
If one or both of your parents would be willing to approach their company to ask for sponsorship for the team this year, please check this box.<br/>

<input type="checkbox" name="food_help" />
If one or both of your parents would be willing to provide snacks for the team, please check this box.
</p>
<p>If you have any health concerns we should know about, please briefly detail them here:<br/>
<textarea name="health_concerns" rows="3" cols="25">
No health concerns.
</textarea>
</p>
<p>
If everything looks good to you, click submit! Thanks for registering for the 2011-2012 season!
<input type="Submit" value="Submit!" name="create_account_form"/>
</p>
</form>
</div><!-- main_content -->
</body>
</html>
