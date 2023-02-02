<?php
$jid = $_GET['jid'];
include '../../../wp-load.php';
global $wpdb;
$wpdb->get_results("DELETE FROM `" . $wpdb->prefix . "posts` where ID = $jid");
$wpdb->get_results("DELETE FROM `" . $wpdb->prefix . "postmeta` where post_id=$jid");
?>