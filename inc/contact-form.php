<?php

$errors = array();

if ( beans_post( 'tbr_contact' ) == true ) {

  // Check message
  if ( !beans_post( 'tbr_message' ) )
    $errors['tbr_message'] = __( 'Please enter your message.', 'tbr' );

  // Check first
  if ( !beans_post( 'tbr_first' ) )
    $errors['tbr_first'] = __( 'Please enter your first name.', 'tbr' );

  // Check last
  if ( !beans_post( 'tbr_last' ) )
    $errors['tbr_last'] = __( 'Please enter your last name.', 'tbr' );

  // Check e-mail
  if ( !$email = beans_post( 'tbr_email' ) )
    $errors['tbr_email'] = __( 'Please enter an e-mail address.', 'tbr' );
  elseif ( !is_email( $email ) )
    $errors['tbr_email'] = __( 'Please enter a valid e-mail address.', 'tbr' );


  // Preceed if no errors
  if ( empty( $errors ) ) {

    $first = $_POST['tbr_first'];
    $last = $_POST['tbr_last'];
    $email = $_POST['tbr_email'];
    $website = $_POST['tbr_website'];
    $message = $_POST['tbr_message'];
    $subject = 'New message from ' . $first . ' ' . $last;
    $body = "New message received from the ThemeButler site :)\n\nName: {$first} {$last}\nEmail: {$email}\nWebsite: {$website}";
    $body .= "\nMessage: {$message}";
    $headers = "From: {$first} {$last}<{$email}>\r\nReply-To: {$email}";
    wp_mail( 'hello@themebutler.com', $subject, $body, $headers ); ?>

    <div class="uk-text-center uk-block">
      <h2>Nice one! Your message is on its way to my inbox!</h2>
      <p class="uk-article-lead">You can expect a reply within 24 hours. If you don't hear back by then, please <a href="mailto:chris@themebutler.com">email me</a> directly.</p>
      <p class="uk-text-muted">In the mean time, be sure to check out our <a href="/" title="Premium quality WordPress themes, for free!">Free WordPress Themes</a> and other <a href="/resources/" title="Free stuff for WordPress">WordPress Goodies</a> ;)</p>
    </div>

  <?php }

} else {

?>
  <h1 class="uk-article-title uk-text-center">Say Hello</h1>
  <p class="tm-excerpt uk-article-lead uk-text-center">Got something you'd like to discuss, or interested in an ad package? Fill out the form below and I'll get back to you asap. Please post on the <a href="http://community.themebutler.com">Community Forum</a> for support related queries.</p>
  <hr class="uk-article-divider">
  <form id="contact-form" name="contact-form" method="post" class="uk-form" data-tm-form>
    <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-2 uk-margin-bottom">
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_first">First <span>*</span></label>
        <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_first', $errors ) ) echo ' tm-field-error'; ?>" type="text" value="<?php echo beans_post( 'tbr_first' ); ?>" placeholder="Eg, John" name="tbr_first" autofocus tabindex="1">
        <?php if ( $message = beans_get( 'tbr_first', $errors ) ) echo '<p class="uk-form-danger">' . $message . '</p>'; ?>
      </div>
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_last">Last <span>*</span></label>
        <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_last', $errors ) ) echo ' tm-field-error'; ?>" type="text" value="<?php echo beans_post( 'tbr_last' ); ?>" placeholder="Eg, Smith" name="tbr_last" tabindex="2">
        <?php if ( $message = beans_get( 'tbr_last', $errors ) ) echo '<p class="uk-form-danger">' . $message . '</p>'; ?>
      </div>
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_email">Email <span>*</span></label>
        <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_email', $errors ) ) echo ' tm-field-error'; ?>" type="email" value="<?php echo beans_post( 'tbr_email' ); ?>" placeholder="Eg, you@yourdomain.com" name="tbr_email" tabindex="3">
        <?php if ( $message = beans_get( 'tbr_email', $errors ) ) echo '<p class="uk-form-danger">' . $message . '</p>'; ?>
      </div>
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_website">Website (optional)</label>
        <input class="uk-width-1-1 tm-field" type="text" value="<?php echo beans_post( 'tbr_website' ); ?>" placeholder="Eg, http://yourwebsite.com" name="tbr_website" tabindex="4">
      </div>
      <div class="uk-width-1-1 uk-form-row tm-form-actions uk-margin-top">
        <label class="uk-form-label" for="tbr_message">Message <span>*</span></label>
        <textarea class="uk-form-large uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_message', $errors ) ) echo ' tm-field-error';?>" cols="13" rows="10" placeholder="What is this concerning?" name="tbr_message" tabindex="5"><?php echo beans_post( 'tbr_message' ); ?></textarea>
        <?php if ( $message = beans_get( 'tbr_message', $errors ) ) echo '<p class="uk-form-danger">' . $message . '</p>'; ?>
      </div>
      <div class="uk-width-1-1 uk-form-row tm-form-actions uk-margin-top uk-text-center">
        <input type="hidden" name="tbr_contact" value="1"/>
        <button class="uk-button uk-button-primary uk-button-large uk-margin-top" name="tbr_submit" tabindex="6"><?php _e( 'Send your message', 'themebutler' ); ?></button>
      </div>
    </div>
  </form>
  <?php } ?>
