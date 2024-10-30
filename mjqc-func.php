<?php

function mjqc_getCommentForm( $mjqc_postid , $mjqc_title="" ) {
	$mjqc_output = "";
	$mjqc_output .= '<p class="quick-comment"><a href="#">'.$mjqc_title.'</a></p>';
	$mjqc_output .= '<div class="quick-comm-wrapper" style="display:none;">';
	$mjqc_output .= '<p><input type="text" size="22" class="author" name="author" /><label for="author"> <small>Name (required)</small></label></p>';
	$mjqc_output .= '<p><input type="text" size="22" class="email" name="email"><label for="email"> <small>Mail (will not be published) (required)</small></label></p>';
	$mjqc_output .= '<p><input type="text" size="22" class="url" name="url"><label for="url"> <small>Website (optional)</small></label></p>';
	$mjqc_output .= '<p><textarea rows="5" cols="35" class="comment" name="comment"></textarea></p>';
	$mjqc_output .= '<input type="submit" value="Post Comment" class="submit mjqc-submit" name="submit" id="submit-'.$mjqc_postid.'" />';
	$mjqc_output .= '<p class="loader"></p>';
	$mjqc_output .= '</div>';
	return $mjqc_output;
}

?>