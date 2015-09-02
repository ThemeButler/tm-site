!(function( $ ) {

    themebutlerApi = {

        ajaxInit: function( element ) {

            $( document ).find( 'button' ).attr( 'disabled', 'disabled' );

            if ( element != undefined )
                element.append( '<i class="uk-icon-spinner uk-icon-spin uk-margin-small-left"></i>' );

        },

        ajaxDone: function( element ) {

            $( document ).find( 'button' )
                .removeAttr( 'disabled' )
                .find( '.uk-icon-spin' ).remove();

        },

        toggleText: function ( a, b ) {

            if ( this.html() == a )
                this.html( b );
            else
                this.html( a );

        }

    }

})( window.jQuery );