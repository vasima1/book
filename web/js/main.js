// Functions

//toggle slideUp
function toggle(obj) {
    if (obj.is(':visible')) {
        obj.slideUp();
    } else {
        obj.slideDown();
    }
}

// Click events

$(document).ready(function () {


    // Отправка формы
    
    $(document).on('click', '#search-form-start', function (e) {    
        e.preventDefault(); 
        var formId = $(this).closest('form').attr('id');
        var result = $.ajax('/index/ajax-search', {type: 'post', async: false, data: $('#' + formId).serialize()}).responseText;
        $('#book-list-bl').html(result);
    });
    
    // Раскрытие спойлера
    
    $(document).on('click', '.spoiler', function (e) {    
        var obj = $(this).next()
        toggle(obj)
    });
})