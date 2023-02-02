<?php
$title = $_GET['title'];
$subtitle = $_GET['subtitle'];
$message = $_GET['message'];
$imageurl = $_GET['imageurl'];
$link = $_GET['link'];

include '../../../wp-load.php';
$new_post = array(
    'post_title' => $title,
    'post_status'   => 'publish',
    'post_type'     => 'bm-journal'
);
$postId = wp_insert_post($new_post);
add_post_meta( $postId, 'image_url', $imageurl, true );
add_post_meta( $postId, 'title', $title, true );
add_post_meta( $postId, 'subtitle', $subtitle, true );
add_post_meta( $postId, 'message', $message, true );
add_post_meta( $postId, 'link', $link, true );
echo $postId;
?>