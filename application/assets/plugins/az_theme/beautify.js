var windowWidth = $(window).width();
if (windowWidth <= 768) {
    $('.btn-beautify-menu').attr('state','inactive');
}
if (windowWidth > 768) {
    $('body').on('click','.btn-beautify-menu',function(){
        if($(this).attr('state') == "active"){
            $('#beautify-left').css({
                width: '0px',
            });
            $('#beautify-right').css({
                width: '100%',
                marginLeft: 0,
            });
            $('.btn-beautify-menu').attr('state','inactive');
        }
        else{
            $('#beautify-left').css({
                width: '240px',
            });
            $('#beautify-right').css({
                width: parseInt(windowWidth)-240,
                marginLeft: 240,
            });
            $('.btn-beautify-menu').attr('state','active');
        }
    }); 
}
if (windowWidth <= 768) {
    $('body').on('click','.btn-beautify-menu',function(){
        if($(this).attr('state') == "active"){
            $('#beautify-left').css({
                width: '0px',
            });
            $('.btn-beautify-menu').attr('state','inactive');
            $('.az-menu-trigger-mobile').hide();
        }
        else{
            $('#beautify-left').css({
                width: '240px',
            });
            $('.btn-beautify-menu').attr('state','active');
            $('.az-menu-trigger-mobile').show();
        }
    }); 

    $('body').on('click','.az-menu-trigger-mobile',function(){
        if($('.btn-beautify-menu').attr('state') == "active"){
            $('#beautify-left').css({
                width: '0px',
            });
            $('.btn-beautify-menu').attr('state','inactive');
            $('.az-menu-trigger-mobile').hide();
        }
        else{
            $('#beautify-left').css({
                width: '240px',
            });
            $('.btn-beautify-menu').attr('state','active');
            $('.az-menu-trigger-mobile').show();
        }
    });

}
$('body').on('click','.az-header-toolbar-user', function(){
    console.log('test');
    $('.az-header-toolbar').find('.account-detail').toggle();
});