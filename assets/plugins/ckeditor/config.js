/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
   // config.filebrowserBrowseUrl = '/azapp/assets/plugins/ckfinder/ckfinder.html';
   // config.filebrowserImageBrowseUrl = '/azapp/assets/plugins/ckfinder/ckfinder.html?type=Images';
   // config.filebrowserFlashBrowseUrl = '/azapp/assets/plugins/ckfinder/ckfinder.html?type=Flash';
   // config.filebrowserUploadUrl = '/azapp/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
   // config.filebrowserImageUploadUrl = '/azapp/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
   // config.filebrowserFlashUploadUrl = '/azapp/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
   config.filebrowserImageBrowseUrl = app_url+'media_manager/media_list';
   config.protectedSource.push(/<i[^>]*><\/i>/g);
   config.fillEmptyBlocks = false;
   // config.extraAllowedContent = 'img[width,height]';
   config.allowedContent = true;
};