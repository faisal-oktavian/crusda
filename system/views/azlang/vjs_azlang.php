<script>
jQuery('#btn_add_lang').click(function() {
	jQuery('.container-lang').append('\
		<div class="row field-azlang">\
			<div class="col-sm-6">\
				<input type="text" class="form-control" name="key[]"/>\
			</div>\
			<div class="col-sm-6">\
				<input type="text" class="form-control" name="value[]""/>\
			</div>\
	');

 	jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, 1000);

});

jQuery("#btn_save_lang").click(function() {
	jQuery("#form_language").submit();
});

jQuery("#idlanguage").change(function() {
	change_language();
});

var sel_language = "<?php echo $sel_language;?>";
if (sel_language == '') {
	change_language();
}

function change_language() {
	location.href = app_url+'azlang?idlanguage='+jQuery("#idlanguage").val();
}

var msg = "<?php echo $this->session->flashdata('msg');?>";
if (msg != "") {
	bootbox.alert(msg);
}