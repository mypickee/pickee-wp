<?php
/**
 * Functions.php
 *
 */
require_once('functions/common.php');
require_once('functions/single_product.php');

$gid = getenv('GOOGLE_ANALYTICS_ID');

if (!empty($gid)) {
  add_action('wp_head', function() use ($gid) { add_googleanalytics($gid); });

  function add_googleanalytics($gid) { ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gid; ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?php echo $gid; ?>');
    </script>
  <?php }
}
