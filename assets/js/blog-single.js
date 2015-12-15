!(function( $ ) {

    var audio;

    $( document ).ready( function() {

        var audio = $('#crickets')[0];
        addEventHandlers();

        $('.tm-crickets').hover(function() {
            $(this).attr("src","/wp-content/themes/tm-site/assets/images/crickets-active.jpg");
            audio.play();
        }, function() {
            $(this).attr("src","/wp-content/themes/tm-site/assets/images/crickets-inactive.jpg");
            audio.pause();
        });

    });

    function addEventHandlers(){
        $('a.mute').click(toggleMuteAudio);
    }
    function toggleMuteAudio(){
        audio.prop('muted',!audio.prop('muted'));
    }

})( window.jQuery );
