<div class="tm-top tm-media-block uk-block tm-theme-info">
  <div class="uk-container uk-container-center">
    <ul class="uk-subnav uk-margin-remove">
      <li>Version <span><a href="#js-release-notes" data-uk-modal><?php echo $version; ?></a></span></li>
      <li>Type: <span><?php echo $terms_as_text; ?></span></li>
      <li>Released: <span><?php echo $release_date; ?></span></li>
      <li>Designer: <span><?php if($designers_count > 0) { foreach ($designers as $designer) { echo $designer->name; } } ?></span></li>
      <li>Requirements: <span>WordPress 4.0+</span></li>
    </ul>
    <div id="js-release-notes" class="uk-modal">
      <div class="uk-modal-dialog">
          <a class="uk-modal-close uk-close"></a>
          <pre><?php echo $release_notes; ?></pre>
      </div>
    </div>
  </div>
</div>
<div class="tm-theme-menu">
  <div class="uk-container uk-container-center">
    <ul class="uk-grid uk-grid-width-1-4 uk-text-center" data-uk-switcher="{connect:'#js-theme-info'}">
      <li class="uk-active"><a href="">Features</a></li>
      <li><a href="">Downloads</a></li>
      <li><a href="">Setup Guide</a></li>
      <li><a href="">Support Options</a></li>
    </ul>
  </div>
</div>