<?php
$path = pg_escape_string($_POST["path"]);


echo'<div id="box_img"><div id="img"><img src="'.$path.'" ></div></div>';
?>