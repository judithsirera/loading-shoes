

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgFile').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//SIGN UP
$(document).ready(function() {

    //CHECK USERNAME
    $('#name').on('keyup change focusout',function(){
        object = $('#name');
        len = object.val().length;
        val = object.val();
        error = false;

        console.log(val);

        if (object.hasClass('check')) {
            object.removeClass('valid');
            object.addClass('invalid');
        }

        if(len < 6) error = true;

        for (i=0; i<len; i++)
        {
            if(val.charAt(i) == " "){
                error = true;
                console.log(val.charAt(i))
            }
        }

        if(error){
            if(object.hasClass('valid')){
                object.removeClass('valid').addClass('invalid');
            }
        }else{
            if(object.hasClass('invalid')){
                object.removeClass('invalid').addClass('valid');
            }
        }

    });

    //CHECK PASSWORD
    $('input[type=password]').on('keyup change focusout',function(){
        object = $('input[type=password]');
        len = object.val().length;

        if (object.hasClass('check')) {
            object.removeClass('valid');
            object.addClass('invalid');
        }

        if(len < 6 || len > 10){
            if(object.hasClass('valid')){
                object.removeClass('valid').addClass('invalid');
            }
        }else if(len >= 6 && len <= 10){
            if(object.hasClass('invalid')){
                object.removeClass('invalid').addClass('valid');
            }
        }

    });

    //CHECK TWITTER
    $('#twitter').on('keyup change focusout',function(){
        object = $('#twitter');
        first = object.val().charAt(0);
        len = object.val().length;


        if (object.hasClass('check')) {
            object.removeClass('valid');
            object.addClass('invalid');
        }

        if(first != '@' || len < 2){
            if(object.hasClass('valid')){
                object.removeClass('valid').addClass('invalid');
            }
        }else if(first == '@' && len >= 2){
            if(object.hasClass('invalid')){
                object.removeClass('invalid').addClass('valid');
            }
        }
    });


    //SEARCH BAR
    $('#search').keydown(function (e){
        url = "/products/search/"
        if(e.keyCode == 13){
            return false;
        }
    });

    $('#searchBtn').on('click', function() {
        val = $('#search').val();
        href = url;
        if(val.length > 0){
            href = url + val;
            $(this).attr("href", href);
            href = $(this).attr("href");
            window.location = href;
        }

    });

    //DATEPICKER
    $('#datepicker').datepicker({
        minDate: 0,
        startOfWeek: 1,
        dateFormat: "dd/mm/yy"
    });

    //MODAL
    $('.modal-trigger').leanModal();

    //TINY EDITOR
    tinymce.init({
        selector:'textarea',
        height : '50px',
        max_height: '100px',
        resize: false
    });

    $('#fileName').change(function (){
        readURL(this);
    });
});








