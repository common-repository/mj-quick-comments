<?php
/*
Plugin Name: MJ Quick Comments
Plugin URI: http://markojakic.net/mjqc
Description: This plugin enables you to post quick comments to any post.
Version: 0.1
Author: Marko Jakic
Author URI: http://markojakic.net/
License: GPL
*/

include_once 'mjqc-func.php';

add_action('init', 'mjqc_comment_form');



$loader = get_option('siteurl').'/wp-content/plugins/'.basename(dirname(__FILE__)).'/img/ajax-loader.gif';
wp_enqueue_script( 'mjqc-ajax-request', plugin_dir_url( __FILE__ ) . 'js/mjqc.js', array( 'jquery' ) );
wp_localize_script( 'mjqc-ajax-request', 'mjqcAjax', array( 'mjqc_ajaxurl' => admin_url( 'admin-ajax.php' ) , 'mjqc_loader' => $loader ) );

add_action( 'wp_ajax_nopriv_mjqc-ajax-submit', 'mjqc_ajax_submit' );
add_action( 'wp_ajax_mjqc-ajax-submit', 'mjqc_ajax_submit' );
add_action( 'wp_ajax_nopriv_mjqc-ajax-submit-fail', 'mjqc_ajax_submit_fail' );
add_action( 'wp_ajax_mjqc-ajax-submit-fail', 'mjqc_ajax_submit_fail' );


function mjqc_ajax_submit() {
	if($_POST["author"]!="" && $_POST["email"]!="" && $_POST["comment"]!="" && $_POST["pid"]!="") {
		$author = $_POST["author"];
		$email = $_POST["email"];
		$url = $_POST["url"];
		$comment = $_POST["comment"];
		$pid = $_POST["pid"];
		$ip = $_SERVER["REMOTE_ADDR"];
		$user_agent = $_SERVER["HTTP_USER_AGENT"];
		$time = current_time('mysql');
		$gmt = get_gmt_from_date($time);
		$data = array(
			'comment_post_ID' => $pid,
			'comment_author' => $author,
			'comment_author_email' => $email,
			'comment_author_url' => $url,
			'comment_content' => $comment,
			'comment_parent' => 0,
			'comment_date' => $time,
			'comment_approved' => 0,
			'comment_author_IP' => $ip,
			'comment_agent' => $user_agent
		);
		wp_insert_comment($data);
	}
	exit;
}

function mjqc_ajax_submit_fail() {
	exit;
}
function mjqc_comment_form( $mjqc_postid,$mjqc_title="" ) {
	return mjqc_getCommentForm( $mjqc_postid,$mjqc_title );
}
