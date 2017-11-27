$( document ).ready(function() {
	$('#attachFilePlusBtn').click(function () {
		var $chooseFile = $(this).parents('form').find('.chooseFileInput').first();
		$chooseFile.clone().insertAfter( $chooseFile );
	});

	$('textarea#message').froalaEditor();
});