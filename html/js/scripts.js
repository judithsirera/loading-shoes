
$(document).ready(function() {
  //CHARACTER COUNTER
  $('#description_product').characterCounter();

  //DATE PICKER
  $('#dateLimit').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
});

//MODAL
$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal-trigger').leanModal();
});
