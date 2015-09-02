function selectBillingModel()
{
  (function($){

    $(document).ready(function(){

      var radioModel = $('input[name="ad_model"]:checked');
      var radioValues = $(".bsaProInputsValues");
      var radioValuesCPC = $(".bsaProInputsValuesCPC");
      var radioValuesCPM = $(".bsaProInputsValuesCPM");
      var radioValuesCPD = $(".bsaProInputsValuesCPD");

      $('input[name="ad_limit_cpc"]').prop('checked', false);
      $('input[name="ad_limit_cpm"]').prop('checked', false);
      $('input[name="ad_limit_cpd"]').prop('checked', false);

      $('input[name="ad_model"]').click(function() {
        $('.bsaInputInnerModel').removeClass('bsaSelected');
        $(this).parent(2).addClass('bsaSelected');
      });

      radioValues.slideUp();

      if ( radioModel.val() == 'cpc' ) {
        radioValuesCPC.slideDown();
        radioModel.addClass('bsaSelected');
      } else if ( radioModel.val() == 'cpm' ) {
        radioValuesCPM.slideDown();
        radioModel.addClass('bsaSelected');
      } else if ( radioModel.val() == 'cpd' ) {
        radioValuesCPD.slideDown();
        radioModel.addClass('bsaSelected');
      }

    });

  })(jQuery);
}

(function($){

  $(document).ready(function(){

    if ( $('#bsaSuccessProRedirect').length ) {
      var getRedirectUrl = $('#bsa_payment_url').val();
      setTimeout(function() {
        window.location.replace(getRedirectUrl);
      }, 2000);
    }

  });

})(jQuery);