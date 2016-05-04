
//SIGN UP
$(document).ready(function() {
    //CHECK PASSWORD
    $('input[type=password]').on('keyup',function(){
        object = $('input[type=password]');
        len = $('input[type=password]').val().length;

        if (object.hasClass('validate')) {
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
    $('#twitter').on('keyup',function(){
        object = $('#twitter');
        first = $('#twitter').val().charAt(0);
        len = $('#twitter').val().length;
        console.log(first);
        console.log(len);

        if (object.hasClass('validate')) {
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
});

//SEARCH BAR
$(document).ready(function() {
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
});

$(document).ready(function() {
  //CHARACTER COUNTER
  $('#description_product').characterCounter();

  //DATE PICKER
  /*$('#dateLimit').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });*/

    $('#datepicker').datepicker({
        minDate: 0,
        startOfWeek: 1
    });
});

//MODAL
$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal-trigger').leanModal();
});

//date

