<script>
function show_modal(id){
    jQuery('.az-modal-'+id).modal({
        backdrop: 'static',
        keyboard: true
    });
}
function hide_modal(id){
    jQuery('.az-modal-'+id).modal('hide');
}
function show_loading(){
    jQuery(".az-loading").show();
}

function hide_loading(){
    jQuery(".az-loading").hide();
}

function clear(){
    jQuery(".az-modal form input").not(".x-hidden, :radio").val("");
    jQuery(".az-modal form input:radio").prop('checked', false);
    jQuery(".az-modal form select").each(function(index, value) {
        if (jQuery(this).hasClass("select2-ajax")) {
            jQuery(this).val("").trigger("change");
        }
        else {
            jQuery(this).val(jQuery(this).find("option:first").val()).trigger("change");
        }
    });

    jQuery(".az-modal form textarea").val("");
    var t_ckeditor = jQuery(".az-modal form .ckeditor");
    jQuery(t_ckeditor).each(function(){
        var id_ckeditor = jQuery(this).attr('id');
        CKEDITOR.instances[id_ckeditor].setData('');                
    });
    var filter_table = jQuery(".filter-tabel select");
    jQuery(filter_table).each(function(){
        var fil = jQuery(this).attr("fil");
        jQuery("#"+fil).val(jQuery("#f"+fil).val());
    });

    jQuery('#l_product_name').text('-');

    jQuery(".az-modal form input[type='checkbox']").prop('checked', false);
    jQuery(".az-modal form input[type='radio']").prop('checked', false);

    try {
        jQuery("input[data-role='tagsinput']").tagsinput('removeAll');
    }
    catch(err){

    }
}

function edit (url, id, form, table_id, callback){
    show_loading();
    clear();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
        },
        success: function (response) {
            var err_message = response.err_message;
            if (err_message != undefined) {
                bootbox.alert(err_message);
            }
            else {
                callback(response);

                setTimeout(function() {
                    var f_input = jQuery('#'+form+' input');
                    var arr_ajax = [];
                    var arr_azimage = [];
                    jQuery.each(response[0], function(index, valu){
                        jQuery('#'+index).not("[type='file'], [type='checkbox']").val(valu).trigger("change");
                        if (jQuery('#'+index).hasClass("format-number")) {
                            jQuery('#'+index).val(thousand_separator(jQuery('#'+index).val()));
                        }
                        if (jQuery('#'+index).hasClass("format-number-minus")) {
                            jQuery('#'+index).val(thousand_separator(jQuery('#'+index).val()));
                        }
                        if (jQuery('#'+index).hasClass("format-number-decimal")) {
                            // var new_index = jQuery('#'+index).val().replace(/\./g, ',');
                            jQuery('#'+index).val(thousand_separator_decimal(jQuery('#'+index).val()));
                        }

                        jQuery.each(jQuery("input[name='"+index+"']"), function(adata, bdata) {
                            if (jQuery(bdata).attr('type') == 'radio' || jQuery(bdata).attr('type') == 'checkbox') {
                                jQuery(bdata).prop('checked', false);
                                if (jQuery(bdata).val() == valu) {
                                    jQuery(bdata).prop('checked', true);
                                }
                            }
                        });

                        try {
                            jQuery("#"+index+"[data-role='tagsinput']").tagsinput('removeAll');
                            jQuery("#"+index+"[data-role='tagsinput']").tagsinput('add', valu);
                        }
                        catch(err) {
                            
                        }

                        var ajax_ = index;

                        if (ajax_.indexOf("ajax_") >= 0) {
                            arr_ajax.push(ajax_);
                        }

                        var azimage_ = index;
                        if (azimage_.indexOf("azimage_") >= 0) {
                            arr_azimage.push(azimage_);
                        }
                    });

                    

                    if (arr_ajax.length > 0) {
                        jQuery.each(arr_ajax, function(index_arr, value_arr) {
                            var idajax = value_arr.replace("ajax_", "");
                            if (response[0][value_arr] != null) {
                                jQuery("#"+idajax+".select2-ajax").append(new Option(response[0][value_arr], response[0][idajax], true, true)).trigger('change');
                            }
                        });
                    }

                    var t_area = jQuery("#"+form+' .ckeditor');
                    jQuery(t_area).each(function (){
                        var id_ckeditor = jQuery(this).attr('id');
                        CKEDITOR.instances[id_ckeditor].setData(response[0][id_ckeditor]);
                    });

                    //azimage
                    if (arr_azimage.length > 0) {
                        jQuery.each(arr_azimage, function(index_arr, value_arr) {
                            var idazimage = value_arr.replace("azimage_", "");
                            if (response[0][value_arr] != null) {
                                jQuery(".az-content-image-"+idazimage+"").attr('src', "<?php echo base_url().AZAPP;?>" + 'assets/images/member_photos/' + response[0][value_arr] + '?<?php echo strtotime(Date('YmdHis'));?>');
                                jQuery('.az-image-file-div-'+idazimage).hide();
                            }
                            else {
                                jQuery(".az-content-image-"+idazimage+"").attr('src', "<?php echo base_url().AZAPP;?>" + 'assets/images/no-image.jpg');
                                jQuery('.az-image-file-div-'+idazimage).show();      
                            }
                        });
                    }
                    // jQuery('.az-image-container .az-image img').attr('src', base_url + 'assets/images/no-image.jpg');
                    // jQuery('.az-image-file-div').show();

                    callback(response);
                }, 100);
                
                jQuery(".modal-title span").text("<?php echo azlang('Edit');?>");
                show_modal(table_id);
            }
            hide_loading();

        },
        error: function (response) {
         hide_loading();
        },
        dataType: "json"
    });

};

function save(url, form, vtable, callback, data){
    show_loading();
    var formdata = new FormData();
   
    var txt_ckeditor = jQuery('#'+form+' .ckeditor');
    jQuery(txt_ckeditor).each(function(){
        var id_ckeditor = jQuery(this).attr("id");
        CKEDITOR.instances[id_ckeditor].updateElement();            
    });

    var data_file = jQuery('#'+form).find('input[type="file"]');
    // jQuery.each(data_file, function() {
    //     var file_id = jQuery(this).attr('id');
    //     var file_name = jQuery(this).attr('name');
    //     var file = jQuery('#'+file_id)[0].files[0];
    //     formdata.append(file_id, file);
    // });

    jQuery(data_file).each(function(adata, bdata) {
        var file_id = jQuery(bdata).attr('id');
        var file_name = jQuery(bdata).attr('name');
        var file = jQuery(bdata)[0].files[0];
        if (file_name.length > 0) {
            file_id = file_name;
        }

        var the = jQuery(bdata)[0].files.length;

        if (the == 1) {
            formdata.append(file_id, file);
        }
        else {
            var total_upload = 0;
            jQuery.each(jQuery(bdata)[0].files, function(xdata, ydata) {
                total_upload++;
                formdata.append(file_id + '_' + total_upload, ydata);
            });
            formdata.append('total_upload', total_upload);            
        }

    });

    $.each(jQuery('#'+form).serializeArray(), function (a, b) {
        formdata.append(b.name, b.value);
    }); 

    if (!data) {
        data = [];
    }

    jQuery.each(data, function (ke, va) {
        formdata.append(ke, jQuery(va).val());
    });


    $.ajax({
        url: url,
        data: formdata,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: "json",
        success: function (response) {
            hide_loading();
            if (response.sMessage != "") {
                var err_response = response.sMessage;
                err_response = err_response.replace(/\n/g, "<br>");
                bootbox.alert({
                    title: "<?php echo azlang('Error');?>",
                    message: err_response
                });
            }
            else {
                bootbox.alert({
                    title: "<?php echo azlang('Success');?>",
                    message: "<?php echo azlang('Save data success');?>"
                });

                jQuery(".az-modal").modal("hide");
                var dtable = jQuery('#'+vtable).dataTable({bRetrieve: true});
                dtable.fnDraw(false);
                callback(response);
            }
        },
        error: function (response) {
            console.log(response);
            hide_loading();
        }
    });
}

function remove(url, id, vtable, callback){
    bootbox.confirm({
        title: "<?php echo azlang('Delete data');?>",
        message: "<?php echo azlang('Are you sure for delete?');?>",
        callback : function(result) {
            if (result == true) {
                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function (response) {
                        if (response.err_code > 0) {
                            bootbox.alert({
                                title: "<?php echo azlang('Error');?>",
                                message: response.err_message
                            });
                        }
                        else {
                            var dtable = jQuery('#'+vtable).dataTable({bRetrieve: true});
                            dtable.fnDraw(false);
                            callback(response);
                        }
                    },
                    error: function (er) {
                        bootbox.alert({
                            title: "<?php echo azlang('Error');?>",
                            message: "<?php echo azlang('Delete data failed');?> "+er
                        });
                    }
                });
            }
        }
    });
}

function thousand_separatorx(x){
    if (x == null) {
        return x;
    }
    if(typeof x !== 'undefined') {
        return x.toString().replace(/\./g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
}

function thousand_separator(x) {
    if (x == null) {
        return x;
    }
    if(typeof x !== 'undefined') {
        x = x.toString().replace(/\./g, '');
        var n= x.toString().split(",");
        n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return n.join(",");
    }
}

function thousand_separator_decimal(x) {
    if (x == null) {
        return x;
    }
    if(typeof x !== undefined) {
        if (x == '') {
            x = 0;
        }
        new_x = parseFloat(x).toFixed(2);
        new_x = new_x.toString().replace(/\./g, ',');
        var n = new_x.toString().split(",");
        n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        var ret = n.join(",");
        return ret;
    }
}

function get_thousand_separator_decimal(x) {
     if (x == null) {
        return x;
    }
    if(typeof x !== 'undefined') {
        var x = x.toString().replace(/\./g, ',');
        return thousand_separator_decimal(x);
    }
}

function remove_separator(x){
    if (x == null) {
        return x;
    }
    if(typeof x !== 'undefined') {
        var new_x = x.toString().replace(/\./g, '');
        new_x = new_x.toString().replace(/\,/g, '.');
        return new_x;
        // return x.toString().replace(/\./g, '');
    }
}

function remove_dot(x) {
    if (x == null) {
        return x;
    }
    if (typeof x !== 'undefined') {
        return x.toString().replace(/\./g, '');
    }
}


//if CSRF TRUE
<?php 
    $ci =& get_instance();
    $csrf = $ci->config->item('csrf_protection');
    if ($csrf) {
?>

jQuery("body form").append('<input class="x-hidden" type="hidden" name="<?php echo $ci->security->get_csrf_token_name();?>" value="<?php echo $ci->security->get_csrf_hash();?>">');

csrf_token_name = "<?php echo $ci->security->get_csrf_token_name(); ?>";
csrf_cookie_name = "<?php echo $ci->config->item('csrf_cookie_name'); ?>";
jQuery(function (jQuery) {
    // this bit needs to be loaded on every page where an ajax POST 
    var object = {};
    object[csrf_token_name] = jQuery.cookie(csrf_cookie_name);
    jQuery.ajaxSetup({
        data: object
    });
    $(document).ajaxComplete(function () {
        object[csrf_token_name] = jQuery.cookie(csrf_cookie_name);
        jQuery.ajaxSetup({
            data: object
        });
        jQuery("input[name='"+csrf_token_name+"']").val(jQuery.cookie(csrf_cookie_name));
    });
});

<?php
    }
?>

function az_reload_csrf() {
    setTimeout(function() {
        jQuery('input[name=\"'+csrf_token_name+'\"]').val(jQuery.cookie(csrf_cookie_name));
    }, 1000);
}


jQuery(document).ready(function(){
    jQuery('.az-modal').on('shown', function() {
        jQuery(document).off('focusin.modal');
    });

    try {
        jQuery("select.select").select2(); 
    }
    catch(e) {
        
    }
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    
    jQuery("body").append(jQuery(".az-modal"));

    jQuery('.az-modal').on('shown.bs.modal', function () {
        jQuery('input:text:visible:first', this).not('.x-hidden, .x-focus').focus();
        jQuery(document).off('focusin.modal');
    });  

    jQuery(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * jQuery('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            jQuery('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    jQuery(document).on('hidden.bs.modal', '.modal', function () {
        jQuery('.modal:visible').length && jQuery(document.body).addClass('modal-open');
    });

    jQuery("body").on("change", ".filter-table select", function(){
        var table_id = jQuery(".filter-tabel").attr("tid");
        var dtable = jQuery('#'+table_id).dataTable({bRetrieve: true});
        dtable.fnDraw(false);
    });

    jQuery('.az-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        if(event.target.tagName != 'TEXTAREA') {
            e.preventDefault();
            return false;
        }
      }
    });

    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 4000;  //time in ms, 5 second for example
    <?php 
        $typing_interval = $ci->config->item('typing_interval');
    ?>
    var config_interval = "<?php echo $typing_interval;?>";
    if (config_interval != "") {
        doneTypingInterval = config_interval;
    }


    jQuery("body").on('keyup keydown', '.format-number', function(e){
        jQuery(this).val(thousand_separator(jQuery(this).val()));
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    jQuery("body").on('keydown keyup', '.format-number-decimal', function(e) {
        var the = jQuery(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function() {
            var new_val = remove_separator(the.val());
            the.val(thousand_separator_decimal(new_val));
        }, doneTypingInterval);

        if ($.inArray(e.keyCode, [188, 46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    jQuery("body").on('keydown keyup', '.format-number-decimal-new', function(e) {
        var the = jQuery(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function() {
            var new_val = remove_separator(the.val());
            if(the.val().toString().includes(",")) {
                the.val(thousand_separator_decimal(new_val));
            } else {
                the.val(thousand_separator(new_val));
            }
        }, doneTypingInterval);

        if ($.inArray(e.keyCode, [188, 46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    // jQuery("body").on('keyup', '.format-number-decimal', function(e){
    //     var the = jQuery(this);
    //     clearTimeout(typingTimer);
    //     typingTimer = setTimeout(function() {
    //         the.val(thousand_separator_decimal(the.val()));
    //     }, doneTypingInterval);
    // });

    jQuery("body").on('keyup keydown', '.format-number-minus', function(e){
        jQuery(this).val(thousand_separator(jQuery(this).val()));
        if ($.inArray(e.keyCode, [189, 46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    jQuery("body").on('keyup keydown', '.format-phone', function(e){
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    jQuery(document).on( 'click', '.az-table tbody tr td', function (event) {
        var btn = jQuery(this).find('button');
        if (btn.length == 0) {
            jQuery(this).parents('tr').toggleClass('selected');
        }
    });
});