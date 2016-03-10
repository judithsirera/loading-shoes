/*$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});*/


$(document).ready(function() {
    $('#edit_select').material_select();
    $('.modal-trigger').leanModal();
});


$('.edit').click(function(){

    var _id = $(event.target).parent().attr('id');
    var subs_id = _id.split('_');

    _id = subs_id[1];

    var href = ($('#edit_button').attr('href')).concat("/");

    $('#edit_button').attr('href', href.concat(subs_id[1]));


    var url = ((window.location.href).concat("/edit"));

    window.location.href = "http://g4.dev/edit/" + _id;
});