!(function( $ ) {


    var themebutler = function() {

        this.browserFlag();
	    this.listen();
        this.redirect = false;

    }

    themebutler.prototype = {

    	constructor: themebutler,

        browserFlag: function() {

            if ( $.browser.msie && parseInt( $.browser.version ) < 9 ) {

                $( 'html' ).css( 'background-color', '#F5F5F5' );
                $( 'body' ).css( 'height', '100%' );

                $( '.tm-site' ).html('<div class="uk-container uk-container-center uk-margin-large-top"><div class="uk-alert uk-alert-danger section-spacing"><p>You are using an outdated browser. Updating to the latest version will improve your entire experience on the web.</p></div></div>');
            }

        },

        modalShow: function() {

            $modal.find( '.uk-modal-spinner' ).show();
            $modal.find( '.tm-modal-body' ).html( '' );
            $modal.show();

        },

        modalIframe: function( iframeSrc ) {

            this.modalShow();
            $modal.find( '.tm-modal-body').html( '<iframe src="' + iframeSrc + '" width="100%" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' );

            $modal.find( 'iframe' ).bind( 'load', function() {

                $modal.find( '.uk-modal-spinner' ).hide();

            });

        },

        subscribe: function( fields ) {

            $.ajax( {
                type: 'POST',
                url: themebutlerArgs.ajaxurl,
                data: fields,
                success: function( html ) {

                    $( '#text-7 form' ).replaceWith( html );

                    themebutlerApi.ajaxDone();

                }
            } );

        },

        subscribe: function( fields ) {

            $.ajax( {
                type: 'POST',
                url: themebutlerArgs.ajaxurl,
                data: fields,
                success: function( html ) {

                    $( '#text-7 form' ).replaceWith( html );

                    themebutlerApi.ajaxDone();

                }
            } );

        },

        toggleSearch: function() {

            $( '.tm-primary-menu .menu-item' ).toggle();
            $( '.tm-primary-menu .tm-search' ).toggle();

            if ( $( '.tm-primary-menu .tm-search' ).is( ':visible' ) ) {

                $( '.tm-primary-menu .tm-search input' ).focus();

                $( '[data-tm-search]' ).find( 'i').removeClass( 'uk-icon-search' ).addClass( 'uk-icon-close' );

            } else {

                $( '[data-tm-search]' ).find( 'i').removeClass( 'uk-icon-close' ).addClass( 'uk-icon-search' );
            }
        },

        listen: function() {

            var $this = this;

            $( document ).on( 'click', '[data-tm-form] button, #commentform button', function() {

                $( this ).parents( 'form' ).submit();

            } );


            $( document ).on( 'click', '[data-tm-subscribe] button', function() {

                $this.subscribe( $( this ).parents( 'form' ).serialize() );

            } );

            $( document ).on( 'click', 'button', function( e ) {

                e.preventDefault();

                themebutlerApi.ajaxInit( $( this ) );

            } );

            $( document ).on( 'click', '#google-map', function( e ) {

                e.preventDefault();

                $( this ).find( 'iframe' ).css( 'pointer-events', 'auto' );

            } );

            $( document ).on( 'click', '[data-tm-search]', function( e ) {

                e.preventDefault();

                $this.toggleSearch();

            } );

            $( document ).on( 'click', '[data-tm-site-info]', function( e ) {

                e.preventDefault();

                $( '.tm-site-info-field' ).toggle();

            } );

            $( document ).on( 'click', '[data-tm-modal-iframe]', function( e ) {

                e.preventDefault();

                $this.modalIframe( $( this ).data( 'tm-modal-iframe' ) );

            } );

            // Toogle founder read more text
            $( '.tm-founders [data-uk-toggle]' ).toggle( function() {

                $( this ).text( 'Show less' );

            }, function() {

                $( this ).text( 'Show more' );

            } );

            // Remove tooltip on touch device.
            $( 'html.uk-touch' ).find( '[data-uk-tooltip]' ).removeAttr( 'data-uk-tooltip' );

            // Add form input focus.
            $( '.tm-light-page-box, .tm-subhead' ).find( 'form input:enabled' ).first().focus();

        }

    };

    // Fire thembutler js.
    $( document ).ready( function() {

        var modal = UIkit.modal( '#tm-modal' );
        $modal = modal;

        new themebutler();

    });

})( window.jQuery );