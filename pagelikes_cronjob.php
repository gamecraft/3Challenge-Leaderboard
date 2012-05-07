<?php
require_once("include_me.php");
require_once('facebook.php');

$facebook = new Facebook(array(
	'appId' => $fb_config["appId"],
	'secret' => $fb_config["appSecret"],
));

$sql = "SELECT id, pageId FROM ideas";
$res = $database -> query($sql);

while($row = $res->fetch(PDO::FETCH_OBJ)) {
	$current = $facebook->api($row->pageId);
	$database -> exec("UPDATE ideas SET likes = ? WHERE id = ? LIMIT 1", array($current["likes"], $row->id));
}