/**
 * @author Tonatiuh Flores Castelán
 * @file main.js
 * @version 1.1
 *
 **/
 $(document).ready(function(){

 	$('#form').validate({
 		rules: {
			name: 'required',
			email: {required: true, email: true},
			company: 'required'
		},
		submitHandler: function(form) {
			var form = $('#form').serialize();

			$.ajax({
				data: form,
				url: 'php/process.php',
				type: 'POST',
				dataType: 'json',
				beforeSend: function() {
					$('#loading').show();
				},
				success: function (response) {
					console.log(response);
					/*var flag = response.success;
					var message = response.data.message;
					if (flag) {
						swal({
							title: 'Hecho',
							html: message,
							type: 'success'
						}).then(function() {
							window.location = base_url + 'cardholder/cardholderlist';
						});
					} else {
						swal({
							html : message,
							title : 'Error',
							type : 'error'
						})
					}*/
				}
			});
		}
 	});
 	$('.days').on('click',function(){

 		$(this).parent().find('.active').removeClass('active');
 		$(this).find('label').addClass('active');
 		console.log($(this).attr('class'));
 	});
 });