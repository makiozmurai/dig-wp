<ul class="bookmark clearfix">
	<?php /*
 <li class="twitter_button">
  <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical">tweet</a>
  <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 </li>*/ ?>
 <li class="facebook_button">
  <div class="fb-like" data-href="<?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="box_count" data-width="60" data-show-faces="false"></div>
 </li>
 <?php if (strtoupper(get_locale()) == 'JA') { ?>
 <li class="hatena_button">
  <a href="http://b.hatena.ne.jp/entry/<?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php the_title(); ?>" data-hatena-bookmark-layout="vertical" title="<?php the_title(); ?>をはてなブックマークに追加">
   <img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" />
  </a>
  <script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
 </li>
 <?php }; ?>
</ul>