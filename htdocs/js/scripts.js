$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});


$(document).ready(function() {
    $('#edit_select').material_select();

});


$('.edit').click(function(){
    var _id = $(event.target).parent().attr('id');
    var subs_id = _id.split('_');

    var href = ($('#edit_button').attr('href')).concat("/");

    $('#edit_button').attr('href', href.concat(subs_id[1]));
    console.log(href);
});