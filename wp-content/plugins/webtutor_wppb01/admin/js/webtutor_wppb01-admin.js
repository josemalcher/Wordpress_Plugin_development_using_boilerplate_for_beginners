(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready(function() {
		$('#example').DataTable();

		$('#frmAddPlayList').validate({
			submitHandler:function () {

			}
		});


		$('#media_photo').on("click", function () {
			var image = wp.media({
				title: "Upload Image for Modelo",
				multiple: false
				//multiple: true
			}).open().on("select", function () {
				var files = image.state().get("selection").first();// uma imagem
				//var files = image.state().get("selection");
				var jsonFiles = files.toJSON();
				//console.log(jsonFiles);
				/*
				$.each(jsonFiles, function (index, item) {
					console.log(item.title);
				});
				*/
				$("#media-img").attr("src", jsonFiles.url);
				$("#image-url").val(jsonFiles.url);
			});
		});

	} );



})( jQuery );


