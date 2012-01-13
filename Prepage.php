<?php
session_start();
if (!isset($_SESSION['auth'])) $_SESSION['auth'] = 0;
if (!isset($_SESSION['location'])) $_SESSION['location'] = $_SERVER['PHP_SELF'];
if (!isset($_SESSION['thread_id'])) $_SESSION['thread_id'] = -1;
$_SESSION['location'] = $_SERVER['PHP_SELF'];
$location = "";
for ($i = strlen($_SESSION['location'])-1; $i >= 0; $i--) {
	if ($_SESSION['location'][$i] == '/' || $_SESSION['location'][$i] == '\\') {
		break;
	} else {
		$location .= $_SESSION['location'][$i];
	}
}
$_SESSION['location'] = strrev($location);
if (strpos($_SESSION['location'], "viewThread.php") >= 0) {
	if (isset($_GET['id'])) {
		$_SESSION['thread_id'] = $_GET['id'];
	} else {
		$_SESSION['thread_id'] = -1;
	}
} else {
	$_SESSION['thread_id'] = -1;
}

$dbconn = mysql_connect("localhost", "root", "");
mysql_select_db("team2502_website");

// Variables
$create_account_request = 0; // -1 = Error || 0 = Not Done || 1 = Created
$login_account_request = 0; // -1 = User or Pass is Wrong || 0 = Not Done || 1 = Login Successfully

function set_top_page($title) {
	echo "<!DOCTYPE HTML><html><head>";
	echo "<title>$title</title>";
	echo "<link REL=StyleSheet HREF=\"style.css\" TYPE=\"text/css\">";
	echo "<link REL=Javascript HREF=\"jquery.js\"></head>";
	echo "<body><div id=\"container\">";
}
function safe_execute($dbconn, $query, $array = array()) {
	$safe = $query;
	for ($i = 0; $i < sizeof($array); $i++) {
		if (strpos($safe, "$".($i+1)."$") >= 0) {
			$safe = str_replace("$".($i+1)."$", "'".mysql_real_escape_string($array[$i])."'", $safe);
		} else {
			break;
		}
	}
	$return = mysql_query($safe);
	return $return;
}
if (isset($_POST['create_account_form'])) {
	$sql = "INSERT INTO ParentStudent VALUES (";
	$myarray = array();
	$fields = array("pass", "firstname_student", "lastname_student", "email_student", "phone_student"
		, "firstname_parent1", "lastname_parent1", "email_parent1", "phone_parent1"
		, "firstname_parent2", "lastname_parent2", "email_parent2", "phone_parent2"
		, "firstname_emergency", "lastname_emergency", "email_emergency", "phone_emergency");
	$is_set = 0;
	for ($i = 0; $i < sizeof($fields); $i++) {
		if (@$_POST[$fields[$i]] !== "" || !empty($_POST[$fields[$i]])) {
			$is_set++;
		}
	}
	if ($is_set == sizeof($fields)) {
		$subteam = "";
		if (isset($_POST['subteam_request1'])) {
			$subteam .= "b";
		}
		if (isset($_POST['subteam_request2'])) {
			$subteam .= "e";
		}
		if (isset($_POST['subteam_request3'])) {
			$subteam .= "p";
		}
		if (isset($_POST['subteam_request4'])) {
			$subteam .= "m";
		}
		if (isset($_POST['class_at1'])) $_POST['class_at1'] = 1; else $_POST['class_at1'] = 0;
		if (isset($_POST['class_rd'])) $_POST['class_rd'] = 1; else $_POST['class_rd'] = 0;
		if (isset($_POST['parent_interest'])) $_POST['parent_interest'] = 1; else $_POST['parent_interest'] = 0;
		if (isset($_POST['company_contact'])) $_POST['company_contact'] = 1; else $_POST['company_contact'] = 0;
		if (isset($_POST['food_help'])) $_POST['food_help'] = 1; else $_POST['food_help'] = 0;
		$values = "pass, type_user, ";
		$values .= "firstname_student, lastname_student, email_student, phone_student, ";
		$values .= "firstname_parent1, lastname_parent1, email_parent1, phone_parent1, ";
		$values .= "firstname_parent2, lastname_parent2, email_parent2, phone_parent2, ";
		$values .= "firstname_emergency, lastname_emergency, email_emergency, phone_emergency, ";
		$values .= "subteam_request, company_contact, parent_interest, health_concerns, class_rd, class_at1, food_help";
		
		$result = safe_execute($dbconn
		, "INSERT INTO ParentStudentData ($values) VALUES ($1$, $2$, $3$, $4$, $5$, $6$, $7$, $8$, $9$, $10$, $11$, $12$, $13$, $14$, $15$, $16$, $17$, $18$, $19$, $20$, $21$, $22$, $23$, $24$, $25$)"
		, array(
		md5($_POST['pass']), 
		"Member", 
		$_POST['firstname_student'], 
		$_POST['lastname_student'], 
		$_POST['email_student'], 
		$_POST['phone_student'], 
		$_POST['firstname_parent1'], 
		$_POST['lastname_parent1'], 
		$_POST['email_parent1'], 
		$_POST['phone_parent1'], 
		$_POST['firstname_parent2'], 
		$_POST['lastname_parent2'], 
		$_POST['email_parent2'], 
		$_POST['phone_parent2'], 
		$_POST['firstname_emergency'], 
		$_POST['lastname_emergency'], 
		$_POST['email_emergency'], 
		$_POST['phone_emergency'], 
		$subteam, 
		$_POST['company_contact'], 
		$_POST['parent_interest'], 
		$_POST['health_concerns'], 
		$_POST['class_rd'], 
		$_POST['class_at1'], 
		$_POST['food_help']
		));
		if (!$result) {
			echo mysql_error() . "<br />";
		} 
	}
	$create_account_request = 1;
}

if (isset($_POST['update_account_form']) && isset($_SESSION['id'])) {
	$sql = "INSERT INTO ParentStudent VALUES (";
	$myarray = array();
	$fields = array("pass", "firstname_student", "lastname_student", "email_student", "phone_student"
		, "firstname_parent1", "lastname_parent1", "email_parent1", "phone_parent1"
		, "firstname_parent2", "lastname_parent2", "email_parent2", "phone_parent2"
		, "firstname_emergency", "lastname_emergency", "email_emergency", "phone_emergency");
	$is_set = 0;
	for ($i = 0; $i < sizeof($fields); $i++) {
		if (@$_POST[$fields[$i]] !== "" || !empty($_POST[$fields[$i]])) {
			$is_set++;
		}
	}
	if ($is_set == sizeof($fields)) {
		if (isset($_POST['class_at1'])) $_POST['class_at1'] = 1; else $_POST['class_at1'] = 0;
		if (isset($_POST['class_rd'])) $_POST['class_rd'] = 1; else $_POST['class_rd'] = 0;
		if (isset($_POST['parent_interest'])) $_POST['parent_interest'] = 1; else $_POST['parent_interest'] = 0;
		if (isset($_POST['company_contact'])) $_POST['company_contact'] = 1; else $_POST['company_contact'] = 0;
		if (isset($_POST['food_help'])) $_POST['food_help'] = 1; else $_POST['food_help'] = 0;
		$values = array("firstname_student"
		, "lastname_student", "email_student", "phone_student"
		, "firstname_parent1", "lastname_parent1", "email_parent1", "phone_parent1"
		, "firstname_parent2", "lastname_parent2", "email_parent2", "phone_parent2"
		, "firstname_emergency", "lastname_emergency", "email_emergency", "phone_emergency"
		, /*"company_contact", "parent_interest", */"health_concerns"
		/*, "class_rd", "class_at1", "food_help"*/);
		$sql = "UPDATE ParentStudentData SET ";
		for ($i = 0; $i < sizeof($values); $i++) {
			$sql .= $values[$i] . " = '" . $_POST[$values[$i]] . "', ";
		}
		$sql .= "class_at1 = {$_POST['class_at1']} , class_rd = {$_POST['class_rd']}, ";
		$sql .= "parent_interest = {$_POST['parent_interest']} , company_contact = {$_POST['company_contact']}, ";
		$sql .= "food_help = {$_POST['food_help']}";
		$result = safe_execute($dbconn, $sql, array());
		if (!$result) {
			echo mysql_error() . "<br />";
		} 
	}
}

if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['login_form'])) {
	$result = safe_execute($dbconn, "SELECT * FROM ParentStudentData WHERE email_student = $1$ AND pass = $2$ LIMIT 1"
		, array($_POST['user'], md5($_POST['pass'])));
	if ($result) {
		if (mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			$_SESSION['email'] = $row['email_student'];
			$_SESSION['fname'] = $row['firstname_student'];
			$_SESSION['lname'] = $row['lastname_student'];
			$_SESSION['id']    = $row['id'];
			$_SESSION['auth'] = 1;
			if ($row['type_user'] == "Manager") $_SESSION['auth'] = 2;
			if ($row['type_user'] == "Captain") $_SESSION['auth'] = 3;
			if ($row['type_user'] == "Mentor") $_SESSION['auth'] = 4;
			if ($row['type_user'] == "Admin") $_SESSION['auth'] = 5;
		}
	} else {
		$login_account_request = -1;
	}
}

if (isset($_GET['logout'])) {
	if (strtolower($_GET['logout']) == "yes") {
		session_destroy();
		header("Location: index.php");
	}
}

if (isset($_POST['reply_thread']) && $_SESSION['thread_id'] !== -1 && isset($_POST['message_for_reply'])) {
	$values = "location, icon, title, text, author, date, time, replies, view, sticky, tutorial, category";
	$result = safe_execute($dbconn, "INSERT INTO threads ($values) VALUES ($1$, $2$, $3$, $4$, $5$, $6$, $7$, $8$, $9$, $10$, $11$, $12$)"
	, array(
	$_SESSION['thread_id']
	, ""
	, "Reply-To"
	, $_POST['message_for_reply']
	, $_SESSION['id']
	, date("Y-m-d")
	, date("H:i:s")
	, 0
	, 0
	, 0
	, 0
	, 0
	));
	if (!$result) {
		echo mysql_error() . "<br />";
	} else {
		safe_execute($dbconn, "UPDATE threads SET replies = replies+1 WHERE id = $1$", array($_SESSION['thread_id']));
	}
}

if (isset($_POST['thread_submit']) && isset($_POST['thread_title']) && isset($_POST['thread_message']) && $_SESSION['auth'] > 0) {
	$values = "location, icon, title, text, author, date, time, replies, view, sticky, tutorial, category";
	$tutorial = 0;
	if (isset($_POST['tutorial_value'])) $tutorial = 1;
	$result = safe_execute($dbconn, "INSERT INTO threads ($values) VALUES ($1$, $2$, $3$, $4$, $5$, $6$, $7$, $8$, $9$, $10$, $11$, $12$)"
	, array(
	$_SESSION['thread_id']
	, "thread.png"
	, $_POST['thread_title']
	, $_POST['thread_message']
	, $_SESSION['id']
	, date("Y-m-d")
	, date("H:i:s")
	, 0
	, 0
	, 0
	, $tutorial
	, 0
	));
	if (!$result) {
		echo mysql_error() . "<br />";
	}
}

if (isset($_POST['category_submit']) && isset($_POST['category_description']) && isset($_POST['category_title']) && $_SESSION['auth'] >= 3 && isset($_GET['id'])) {
	$result1 = safe_execute($dbconn, "SELECT * FROM ParentStudentData WHERE id = $1$ LIMIT 1", array($_SESSION['id']));
	if (mysql_num_rows($result1) == 1) {
	$row = mysql_fetch_array($result1);
	if ($row['type_user'] == "Captain" || $row['type_user'] == "Mentor" || $row['type_user'] == "Admin") {
		$values = "location, icon, title, text, author, date, time, replies, view, sticky, tutorial, category";
		$result = safe_execute($dbconn, "INSERT INTO threads ($values) VALUES ($1$, $2$, $3$, $4$, $5$, $6$, $7$, $8$, $9$, $10$, $11$, $12$)"
		, array(
		$_GET['id']
		, "regular.png"
		, $_POST['category_title']
		, $_POST['category_description']
		, $_SESSION['id']
		, date("Y-m-d")
		, date("H:i:s")
		, 0
		, 0
		, 0
		, 0
		, 1
		));
		if (!$result) {
			echo mysql_error() . "<br />";
		}
	}
	}
}







function getCategoryResult($dbconn, $row) {
	$category_results = safe_execute($dbconn, "SELECT * FROM threads WHERE location = $1$ ORDER BY sticky DESC", array($row['id']));
	while ($category_row = mysql_fetch_array($category_results)) {
		?>
		<div id="category_forum">
		<a style="text-decoration: none; color: #000000;" href="<?php echo 'viewThread.php?id='.$category_row['id']; ?>" onmouseover="this.cursor='pointer'" onmouseout="this.cursor='auto'">
		<div style="float: left;"><img alt="Category Icon" style="border: solid 0px;" src="<?php echo $category_row['icon']; ?>" width="40" height="40"></div>
		<?php echo $category_row['title']; ?>
		<br />
		<a style="text-decoration: none;" href="<?php echo 'viewThread.php?id='.$category_row['id']; ?>" onmouseover="this.cursor='pointer'" onmouseout="this.cursor='auto'" id="category_description">
		<?php echo $category_row['text']; ?>
		</a> <!-- href - viewThread.php?id=$row['id'] -->
		</a> <!-- href - links to thread location -->
		</div> <!-- category_forum -->
		<?php
	}
}

function is_odd($intNumber)
{
  if ($intNumber % 2 == 0 ) return true;
  else return false;
}
function badlink($link, $prefix) {
    if ($prefix == "mailto:") {
        if (strpos($link, "@") === FALSE || strpos($link, ".", (strpos($link, "@")+2)) === FALSE || substr_count($link, "@") > 1 || strpos($link, "@") == 0) {
            return 1;
            }
        }
    if (strpos($link, ".") == 0 || strpos($link, ".") == strlen($link) || (strpos($link, "/") < strpos($link, ".") && strpos($link, "/") !== FALSE)) {
        return 1; 
        }
    };
function setlinks($r, $prefix) {
    if (substr($r, 0, strlen($prefix)) == $prefix) {
        $r = "\n".$r;
        }
    $r = str_replace("<br>".$prefix, "<br>\n".$prefix, $r);
    $r = str_replace(" ".$prefix, " \n".$prefix, $r);
    while (strpos($r, "\n".$prefix) !== FALSE) {
        list($r1, $r2) = explode("\n".$prefix, $r, 2);
        if (strpos($r2, " ") === FALSE && strpos($r2, "<br>") === FALSE) {
            if ($prefix != "mailto:") {
                $target = ' target="_blank"';
                }
            else {
                $target = "";
                }
            if (strpos($r2, ".") > 1 && strpos($r2, ".") < strlen($r2) && badlink($r2, $prefix) != 1) {
                $r = $r1.'<a href="'.$prefix.$r2.'"'.$target.'><font size="2" color="blue">'.$prefix.$r2.'</font></a>';
                }
            else {
                $r = $r1.$prefix.$r2;
                }
            }
        else {
            if (strpos($r2, " ") === FALSE || ( strpos($r2, " ") > strpos($r2, "<br>") && strpos($r2, "<br>") !== FALSE)) {
                list($r2, $r3) = explode("<br>", $r2, 2);
                if (badlink($r2, $prefix) != 1) {
                    $r = $r1.'<a href="'.$prefix.$r2.'"'.$target.'><font size="3" color="blue">'.$prefix.$r2.'</font></a><br>'.$r3;
                    }
                else {
                    $r = $r1.$prefix.$r2.'<br>'.$r3;
                    }
                }
            else {
                list($r2, $r3) = explode(" ", $r2, 2);
                if (strpos($r2, ".") > 1 && strpos($r2, ".") < strlen($r2) && badlink($r2, $prefix) != 1) {
                    $r = $r1.'<a href="'.$prefix.$r2.'"'.$target.'><font size="3" color="blue">'.$prefix.$r2.'</font></a> '.$r3;
                    }
                else {
                    $r = $r1.$prefix.$r2.' '.$r3;
                    }
                }
            }
        }
    return $r;
    };


function bb($r)
	{
	
	$r = trim($r);
	$r = htmlentities($r);
	$r = str_replace("\r\n","<br>",$r);
	$r = str_replace("[b]","<b>",$r);
	$r = str_replace("[/b]","</b>",$r);
	$r = str_replace("[img]","<img src='",$r);
	$r = str_replace("[/img]","'>",$r);
	$r = str_replace("[IMG]","<img src='",$r);
	$r = str_replace("[/IMG]","'>",$r);
	$r = str_replace("[s]","<s>",$r);
	$r = str_replace("[/s]","</s>",$r);
	$r = str_replace("[ul]","<ul>",$r);
	$r = str_replace("[/ul]","</ul>",$r);
	$r = str_replace("[li]","<li>",$r);
	$r = str_replace("[/li]","</li>",$r);
	$r = str_replace("[ol]","<ol>",$r);
	$r = str_replace("[/ol]","</ol>",$r);
	$r = str_replace("[quote]","<br /><table width='80%' bgcolor='#ffff66' align='center'><tr><td style='border: 1px dotted black'><font color=black><b>Quote:<br></b>",$r);
	$r = str_replace("[/quote]","</font></td></tr></table>",$r);
	$r = str_replace("[i]","<i>",$r);
	$r = str_replace("[/i]","</i>",$r);
	$r = str_replace("[u]","<u>",$r);
	$r = str_replace("[/u]","</u>",$r);
	$r = str_replace("[spoiler]",'[spoiler]<font bgcolor ="#000000" color="#DDDDDD">',$r);
	$r = str_replace("[/spoiler]","</font>[/spoiler]",$r);
	
	//set [link]s
	while (strpos($r, "[link=") !== FALSE)
		{
		    list ($r1, $r2) = explode("[link=", $r, 2);
			    if (strpos($r2, "]") !== FALSE) {
			        list ($r2, $r3) = explode("]", $r2, 2);
				        if (strpos($r3, "[/link]") !== FALSE) {
				            list($r3, $r4) = explode("[/link]", $r3, 2);
				            $target = ' target="_blank"';
					            if (substr($r2, 0, 7) == "mailto:") {
					                $target = "";
				            }
				            $r = $r1.'<a href="'.$r2.'"'.$target.'><font size="3" color="blue">'.$r3.'</font></a>'.$r4;
			        }
				        else {
				            $r = $r1."[link\n=".$r2."]".$r3;
			        }
		    }
			    else {
			        $r = $r1."[link\n=".$r2;
		    }
	}
	$r = str_replace("[link\n=","[link=",$r);
	////[link]
	
	///default url link setting
	$r = setlinks($r, "http://");
	$r = setlinks($r, "https://");
	$r = setlinks($r, "ftp://");
	$r = setlinks($r, "mailto:");
	////links
	
	///emoticons
	$r = str_replace(":)",'<img src="images/smilie.gif">',$r);
	$r = str_replace(":(",'<img src="images/sad.gif">',$r);
	$r = str_replace(":angry:",'<img src="images/angry.gif">',$r);
	$r = str_replace(":D",'<img src="images/biggrin.gif">',$r);
	$r = str_replace(":blink:",'<img src="images/blink.gif">',$r);
	$r = str_replace(":blush:",'<img src="images/blush.gif">',$r);
	$r = str_replace("B)",'<img src="images/cool.gif">',$r);
	$r = str_replace("<_<",'<img src="images/dry.gif">',$r);
	$r = str_replace("^_^",'<img src="images/happy.gif">',$r);
	$r = str_replace(":huh:",'<img src="images/confused.gif">',$r);
	$r = str_replace(":lol:",'<img src="images/laugh.gif">',$r);
	$r = str_replace(":o",'<img src="images/ohmy.gif">',$r);
	$r = str_replace(":fear:",'<img src="images/fear.gif">',$r);
	$r = str_replace(":rolleyes:",'<img src="images/rolleyes.gif">',$r);
	$r = str_replace(":sleep:",'<img src="images/sleep.gif">',$r);
	$r = str_replace(":p",'<img src="images/tongue.gif">',$r);
	$r = str_replace(":P",'<img src="images/tongue.gif">',$r);
	$r = str_replace(":unsure:",'<img src="images/unsure.gif">',$r);
	$r = str_replace(":wacko:",'<img src="images/wacko.gif">',$r);
	$r = str_replace(":wink:",'<img src="images/wink.gif">',$r);
	$r = str_replace(":wub:",'<img src="images/wub.gif">',$r);
	
	$r = trim($r);
	return $r;
	
}
?>
