# popup contact form to send mail via ajax using bootstrap modal

html
'''
<button type="butotn" onclick="showContactForm()">Contact</button>
'''

javascript

'''

function showContactForm(){
	if(document.getElementById('contactFormModal')){
		jQuery('#contactFormModal').modal('show');
		return;
	}
	var modalContent = '<div class="modal fade" id="contactFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
	  <div class="modal-dialog modal-lg" role="document">\
		<div class="modal-content text-white" style="background:#393E46;">\
		  <div class="modal-header">\
			<h5 class="modal-title align-self-center w-100 display-4" id="exampleModalLabel">Contact us</h5>\
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
			  <span aria-hidden="true" class="text-white">&times;</span>\
			</button>\
		  </div>\
		  <div class="modal-body">\
			<form id="contact-form">\
			  <div class="form-group">\
				<input type="text" class="form-control" id="recipient-name" placeholder="NAME">\
			  </div>\
			  <div class="form-group">\
				<input type="email" class="form-control" id="recipient-email" placeholder="EMAIL">\
			  </div>\
			  <div class="form-group">\
				<input type="text" class="form-control" id="recipient-subject" placeholder="SUBJECT">\
			  </div>\
			  <div class="form-group">\
				<textarea class="form-control" id="message-text" placeholder="MESSAGE"></textarea>\
			  </div>\
			  <div class="form-group d-flex justify-content-center" id="formErrMsg"></div>\
			</form>\
		  </div>\
		  <div class="modal-footer d-flex justify-content-center">\
			<div class="btn-holder">\
                <a href="javascript:void(0)" onclick="sendMail()" class="cr-btn ex-padding" data-sr-id="77" style="visibility: visible; opacity: 1; transition: all 0.3s ease-in-out 0s, opacity 0.8s cubic-bezier(0.5, 0, 0, 1) 0s;">Submit</a>\
            </div>\
		  </div>\
		</div>\
	  </div>\
	</div>';
	jQuery('body').append(modalContent);
	jQuery('#contactFormModal').modal('show');
	return;
}

function sendMail(){
	jQuery.ajax({
		type: "POST",
		url: "https://wsoftpro.com/ajax/contact.php",
		dataType: 'json',
		data: {
			'name':jQuery('recipient-name').val(),
			'email':jQuery('recipient-email').val(),
			'subject':jQuery('recipient-subject').val(),
			'text':jQuery('recipient-text').val(),
			
		},
    beforeSend: function() {
		showContactResult('loading');
    },
    success: function(data) {
		if(data.result){
			showContactResult('Your mail has been sent!');	
		}else{
			showContactForm();
			jQuery('#formErrMsg').html(data.msg);
		}
		
    },
    error: function(res) { // if error occured
        showContactResult(res);
    }
	});
}

function showContactResult(msg){
	if(document.getElementById('contactFormModal')){
		jQuery('#contactFormModal').modal('hide');
		
	}
	
	if(msg=='loading'){
		msg="<img src='https://raw.githubusercontent.com/hixbotay/icon/master/loading/loading.gif' class=''/>"
	}
	if(document.getElementById('contactResultModal')){
		jQuery('#contact-result').html(msg);
		jQuery('#contactResultModal').modal('show');
		return;
	}
	let modalContent = '<div class="modal fade" id="contactResultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
	  <div class="modal-dialog modal-lg" role="document">\
		<div class="modal-content text-white" style="background:#393E46;">\
		  <div class="modal-header">\
			<h5 class="modal-title align-self-center w-100 display-4" id="exampleModalLabel">Contact us</h5>\
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
			  <span aria-hidden="true" class="text-white">&times;</span>\
			</button>\
		  </div>\
		  <div class="modal-body d-flex justify-content-center">\
			<div id="contact-result"></div>\
		  </div>\
		  <div class="modal-footer d-flex justify-content-center">\
			<div class="btn-holder">\
                <a href="javascript:void(0)" class="cr-btn ex-padding" data-sr-id="77" style="visibility: visible; opacity: 1; transition: all 0.3s ease-in-out 0s, opacity 0.8s cubic-bezier(0.5, 0, 0, 1) 0s;" data-dismiss="modal">Close</a>\
            </div>\
		  </div>\
		</div>\
	  </div>\
	</div>';
	jQuery('body').append(modalContent);
	jQuery('#contact-result').html(msg);
	jQuery('#contactResultModal').modal('show');
	return;
}
'''
