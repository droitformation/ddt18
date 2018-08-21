/*--------------------------------------------------
		 CONTACT FORM CODE
---------------------------------------------------*/
jQuery(document).ready(function($){
	$('form#contact-form').submit(function() {
		$('form#contact-form .contact-error').remove();
		var hasError = false;
		$('form#contact-form .requiredField').each(function() {
			if(jQuery.trim($(this).val()) == '') {
            	var labelText = $(this).prev('label').text();
            	$(this).parent().append('<span class="contact-error">Champ requis</span>');
            	$(this).addClass('inputError');
            	hasError = true;
            } else if($(this).hasClass('email')) {
            	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            	if(!emailReg.test(jQuery.trim($(this).val()))) {
            		var labelText = $(this).prev('label').text();
            		$(this).parent().append('<span class="contact-error">Invalid</span>');
            		$(this).addClass('inputError');
            		hasError = true;
            	}
            }
		});

		if(!hasError) {
		    /*	var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){
                console.log(data);
				$("form#contact-form").before('<div class="contact-success"><strong>Merci!</strong><p>Votre email a été envoyé avec succès. Nous vous contacterons dès que possible.</p></div>');
			});*/
            return true;
		}

		return false;

	});
});