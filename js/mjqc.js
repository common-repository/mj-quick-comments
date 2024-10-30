$(document).ready(function() {

	$('p.quick-comment a').click(function(e) {
		e.preventDefault();
		var cf = $(this).parent().next('div.quick-comm-wrapper');
		if( cf.is(':hidden') ) cf.show();
		else cf.hide();
	});
	
	
	var mailexp = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+)*$/;
	var emailValid = true;
	var submitAction;
	$('input.mjqc-submit').click(function() {
		var e = $(this);
		var author_ = e.parent().find('input.author').val();
		var email_ = e.parent().find('input.email').val();
		var url_ = e.parent().find('input.url').val();
		var comment_ = e.parent().find('textarea').val();
		var pid_ = e.attr('id');
		pid_ = pid_.split('-');
		pid_ = pid_[1];
		
		if(email_.search(mailexp) != 0) {
			emailValid = false;
			submitAction = 'mjqc-ajax-submit-fail';
		} else {
			e.next('p.loader').html('<img src="' + mjqcAjax.mjqc_loader + '" />');
			emailValid = true;
			submitAction = 'mjqc-ajax-submit';
		}
		
		jQuery.post(
				mjqcAjax.mjqc_ajaxurl,{ action: submitAction, author: author_ , email: email_, url: url_, comment: comment_, pid: pid_  },
				function() {
					if(emailValid) {
						e.next('p.loader').html('');
						if(author_=="" || email_=="" || comment_=="" || pid_=="")
							alert("Warning: You must fill in your name, email and comment");
						else {
							e.parent().prev('p.quick-comment').remove();
							e.parent().html('<p class="mjqc-thankyou">Thank you! Your comment is awaiting moderation.</p>');
						}
					} else alert("Invalid email");
				}
			);
	});
});