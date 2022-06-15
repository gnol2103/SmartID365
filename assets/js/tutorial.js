$(document).ready(function () {
    var collapse = $('.k_collapse'); 
    collapse.click(function(){
        var muiten = $(this).find('.icon_mt');
        if(muiten.hasClass("rotate180")) {
            muiten.removeClass("rotate180");
        } else {
            muiten.addClass("rotate180");
        }
    });  
});