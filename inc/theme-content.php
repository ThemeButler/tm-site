<div class="tm-theme-content">
  <div class="uk-container uk-container-center">
    <div id="js-theme-info" class="uk-switcher uk-width-1-1">
      <div>
        <h2 class="uk-article-title uk-text-center uk-margin-top-remove uk-margin-large-bottom"><?php echo get_post( 41 )->post_title; ?></h2>
        <?php echo get_post( 41 )->post_content; ?>
      </div>
      <div>
        <h2>Downloads for <?php echo $title; ?></h2>
        <hr class="uk-article-divider">
        <div class="uk-grid uk-grid-width-1-3">
          <div>
            <img src="/wp-content/uploads/icon-parent-theme.svg" alt="" width="60" height="60" class="uk-float-left uk-margin-right uk-border-rounded">
            <h3 class="uk-margin-small">Parent-theme</h3>
            <a href="<?php echo $download_parent; ?>" onclick="javascript:_paq.push(['trackEvent', 'Theme', 'Download' '<?php echo $title; ?>']);">Download tm-<?php echo $lowercase_title . '-v'. $version . '.zip'; ?></a>
          </div>

          <div>
            <img src="/wp-content/uploads/icon-child-theme.svg" alt="" width="60" height="60" class="uk-float-left uk-margin-right uk-border-rounded">
            <h3 class="uk-margin-small">Child-theme</h3>
            <a href="<?php echo $download_child; ?>" onclick="javascript:_paq.push(['trackEvent', 'Child Theme', 'Download' '<?php echo $title; ?>']);">Download tm-<?php echo $lowercase_title . '-child.zip'; ?></a>
          </div>
          <div>
            <img src="/wp-content/uploads/icon-sketch.svg" alt="" width="60" height="60" class="uk-float-left uk-margin-right uk-border-rounded">
             <h3 class="uk-margin-small">Sketch source</h3>
            <a href="<?php echo $download_sketch; ?>" onclick="javascript:_paq.push(['trackEvent', 'Sketch Source', 'Download' '<?php echo $title; ?>']);">Download <?php echo $lowercase_title . '-sketch.zip'; ?></a>
          </div>
        </div>
      </div>
      <div>
        <h2>Setup notes for <?php echo $title; ?></h2>
        <hr class="uk-article-divider">
        <p class="uk-article-lead"><?php echo $title; ?> is a parent-theme for WordPress, so you would install it like you would any other theme, via the Appearance > Themes page in the WordPress admin.</p>
        <h3>Customizing via a child theme</h3>
        <p>In order to receive automatic updates for <?php echo $title; ?>, it is recommended that you add all customizations via a child-theme for <?php echo $title; ?>. Once you have installed the theme, you should see a prompt to install the associated child-theme. Once the child-theme is installed, activate it and you are ready to start customizing.</p>
        <h3>Tutorials</h3>
        <p>While <?php echo $title; ?> will work great out-the-box, the more time you invest, the more you'll get out of it. Below are a couple of recommended tutorials to get you started:</p>
        <ul class="uk-list">
          <li><a href="http://getbeans.io/documentation/customization-overview/" target="_blank" title="An introduction to customizing Beans">An introduction to customizing Beans</a></li>
          <li><a href="http://getbeans.io/documentation/starter-child-theme/" target="_blank" title="Overview of using child-themes with Beans">Overview of using child-themes with Beans</a></li>
          <li><a href="http://getbeans.io/documentation/using-page-templates/" target="_blank" title="Using page templates">Using page templates</a></li>
          <li><a href="http://getbeans.io/documentation/page-layouts/" target="_blank" title="Customizing the page layouts">Customizing the page layouts</a></li>
          <li><a href="http://getbeans.io/documentation/uikit-in-beans/" target="_blank" title="Taking advantage of UIkit in your theme">Taking advantage of UIkit in your theme</a></li>
          <li><a href="http://getbeans.io/documentation/working-with-css-less-and-javascript/" target="_blank" title="Working with CSS, LESS and JavaScript">Working with CSS, LESS and JavaScript</a></li>
          <li><a href="http://getbeans.io/documentation/editing-images/" target="_blank" title="Modifying images">Modifying images</a></li>
          <li><a href="http://getbeans.io/documentation/markup-and-attributes/" target="_blank" title="Customizing markup and attributes">Customizing markup and attributes</a></li>
          <li><a href="http://getbeans.io/documentation/adding-a-widget-area/" target="_blank" title="Adding widget areas">Adding widget areas</a></li>
          <li><a href="http://getbeans.io/documentation/using-fields/" target="_blank" title="Working with Fields (plugin terratory)">Working with Fields (plugin terratory)</a></li>
        </ul>
        <h3>Developer Resources</h3>
        <p><?php echo $title; ?> is built using the awesome <a href="https://getbeans.io">Beans framework</a>, which has awesome <a href="http://getbeans.io/documentation/" title="Documentation for the awesome Beans framework for WordPress." target="_blank">developer documentation</a>, <a href="http://getbeans.io/documentation/" title="Code reference for the awesome Beans framework for WordPress." target="_blank">code reference</a> and <a href="http://getbeans.io/documentation/" title="Code snippets for the awesome Beans framework for WordPress." target="_blank">snippet library</a> that I would recommend you check out, as it will make customizing <?php echo $title; ?> a breeze.</p>
      </div>
      <div>
        <h3>Support Options</h3>
        <hr class="uk-article-divider">
        <div class="uk-grid uk-grid-width-1-2">
          <div>
            <figure class="uk-thumbnail uk-float-right uk-margin-left uk-margin-large-top"><a href="" target="_blank"><img src="http://themebutler.webmonkeys.netdna-cdn.com/wp-content/uploads/community.svg" width="125" height="125" alt="Community support for <?php echo $title; ?>"></a></figure>
            <h4>Community Forum</h4>
            <p>While I don't officially provide support for <?php echo $title; ?>, there is a Community discussion forum, where members can help each other.</p>
            <a href="http://community.themebutler.com/t/<?php echo $lowercase_title; ?>" class="uk-button">Ask a question about <?php echo $title; ?></a>
          </div>
          <div>
            <figure class="uk-thumbnail uk-float-right uk-margin-left uk-margin-large-top"><a href="/?bsa_pro_id=23&amp;bsa_pro_url=1" target="_blank"><img src="http://themebutler.webmonkeys.netdna-cdn.com/wp-content/uploads/bsa-pro-upload/1441270951-banner-codeable-125.png" width="125" height="125" alt="WordPress Experts On Demand"></a></figure>
            <h4>Get help on Codeable</h4>
            <p>Need help customizing <?php echo $title; ?>? Codeable is a network of highly skilled WordPress developers, that are available for projects big and small.</p>
            <a href="https://api.referoo.co/s/0gFdE" class="uk-button">Get a free quote</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
