/* -----------------------------------------------------------------------------
  REGULAR SCRIPTS COMPONENT
  
----------------------------------------------------------------------------- */
$(document).ready(function() {
  $('.nav-tabs li').click(function(){
        $('.nav-tabs .active').removeClass('active');
        $(this).addClass('active');
        $(this).tab('show');
  });
});
