$('.memenu li').on('click', function (e) {
    $.each($('.memenu li'), function (i,el) {
        $(el).removeClass('active');
    });
    $(e.target).parent().addClass('active');

})
