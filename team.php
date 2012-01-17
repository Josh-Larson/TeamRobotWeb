<?php include("Prepage.php"); set_top_page("Robotics Team"); ?>
<?php include("banner.php"); ?>
<div id="main_content">
<script type="text/javascript">
var maximum = 14;
var pos = 6;
var fl = "float: right;";
function append_images() {
	for (var i = pos; i <= maximum && i < pos+5; i++) {
		document.getElementById("image_container_team").innerHTML += "\<div style=\"overflow: hidden\">\<img src='Images\/img"+i+".jpg' style='"+fl+"' \/\>\<\/div\>";
		if (fl == "float: right;") {
			fl = "float: left;";
		} else {
			fl = "float: right;";
		}
	}
	pos += 5;
	if (pos > maximum) {
		document.getElementById("load_more_text").style.visibility = "hidden";
	}
}
</script>
<div id="image_container_team" style="overflow: hidden;">
<div style="overflow: hidden;"><img src="Images/img1.jpg" style="float: left;"/></div>
<div style="overflow: hidden;"><img src="Images/img2.jpg" style="float: right;" /></div>
<div style="overflow: hidden;"><img src="Images/img3.jpg" style="float: left;"/></div>
<div style="overflow: hidden;"><img src="Images/img4.jpg" style="float: right;" /></div>
<div style="overflow: hidden;"><img src="Images/img5.jpg" style="float: left;"/></div>
</div><br />
<div id="load_more_text" style="visibility: visible;">
<a style="color: #000000;" href="javascript:append_images()">Load More</a>
</div>
</div><!-- main_content -->
</body>
</html>
