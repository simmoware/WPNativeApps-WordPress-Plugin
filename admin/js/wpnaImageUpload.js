jQuery( function($){
	// on upload button click
	$( 'body' ).on( 'click', '.wpna-upload', function( event ){
		event.preventDefault(); // prevent default link click and page refresh

		const button = $(this);
    const uploadSection = $(this).parent('.wpnaImageUploadSection');

		const imageId = uploadSection.children('.wpna_img_id').val();

    uploadSection.children('.wpnaImageUploadPreview').attr('background-image','');
    // uploadSection.children('.wpna_img_id').val('');
    uploadSection.children('.wpna_img_url').val('');



		const wpnaCustomUploader = wp.media({
			title: 'Insert image', // modal window title
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Use this image' // button label text
			},
			multiple: false
		}).on( 'select', function() { // it also has "open" and "close" events
			const attachment = wpnaCustomUploader.state().get( 'selection' ).first().toJSON();

			// button.removeClass( 'button' ).html( '<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
      uploadSection.children('.wpnaImageUploadPreview').css('background-image','url("'+attachment.url+'")')
			button.next().show(); // show "Remove image" link
      uploadSection.children('.wpna-remove').show();
      uploadSection.children('.wpna-upload').hide();

      uploadSection.children('.wpna_img_id').val(attachment.id);
      uploadSection.children('.wpna_img_url').val(attachment.url);

			// button.next().next().val( attachment.id ); // Populate the hidden field with image ID
		})

		// already selected images
		wpnaCustomUploader.on( 'open', function() {

			if( imageId ) {
			  const selection = wpnaCustomUploader.state().get( 'selection' )
			  attachment = wp.media.attachment( imageId );
			  attachment.fetch();
			  selection.add( attachment ? [attachment] : [] );
			}

		})

		wpnaCustomUploader.open()

	});
	// on remove button click
	$( 'body' ).on( 'click', '.wpna-remove', function( event ){
		event.preventDefault();
    const button = $(this);
		const uploadSection = $(this).parent('.wpnaImageUploadSection');
    uploadSection.children('.wpnaImageUploadPreview').css('background-image','');
    uploadSection.children('.wpna_img_id').val('');
    uploadSection.children('.wpna_img_url').val('');
    uploadSection.children('.wpna-remove').hide();
    uploadSection.children('.wpna-upload').addClass('upload').html('Upload Image').show().click();

		// button.hide().prev().addClass( 'button' ).html( 'Upload image' ); // replace the image with text
	});

});
