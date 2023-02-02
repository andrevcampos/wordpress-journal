<?php
$jid = $_GET['jid'];
$title = $_GET['title'];
$subtitle = $_GET['subtitle'];
$message = $_GET['message'];
$link = $_GET['link'];
$imageurl = $_GET['imageurl'];
include '../../../wp-load.php';
update_post_meta( $jid, 'image_url', $imageurl);
update_post_meta( $jid, 'title', $title);
update_post_meta( $jid, 'subtitle', $subtitle);
update_post_meta( $jid, 'message', $message);
update_post_meta( $jid, 'link', $link);
?>