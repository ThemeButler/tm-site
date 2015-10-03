!(function( $ ) {

       $(".tm-header button").click(function () {
         $(this).text(function(i, v){
            return v === 'Show Navigation' ? 'Hide Navigation' : 'Show Navigation'
         })
       });

})( window.jQuery );
