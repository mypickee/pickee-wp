<?php
/**
 * Template name: Carousel Half Background
 *
 * This template uses a 2-column (row) layout to display background image and
 * content side-by-side. It rotates through a set of images as the background
 * image.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="alternate icon" href="/favicon.ico">
</head>

  <div id="primary" class="content-area fullscreen-split">
    <header>
      <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/pickee_logo.svg"); ?>
    </header>
    <div class="hero-container">
      <?php
        $heroes = [
          "https://d11sudltbj4efq.cloudfront.net/wp-content/uploads/2021/01/24215200/prelaunch_hero_1.jpg",
          "https://d11sudltbj4efq.cloudfront.net/wp-content/uploads/2021/01/24215204/prelaunch_hero_2.jpg",
          "https://d11sudltbj4efq.cloudfront.net/wp-content/uploads/2021/01/24215210/prelaunch_hero_3.jpg",
          "https://d11sudltbj4efq.cloudfront.net/wp-content/uploads/2021/01/24215216/prelaunch_hero_4.jpg",
          "https://d11sudltbj4efq.cloudfront.net/wp-content/uploads/2021/01/24215221/prelaunch_hero_5.jpg",
          "https://d11sudltbj4efq.cloudfront.net/wp-content/uploads/2021/01/24215227/prelaunch_hero_6.jpg"
        ];
        shuffle($heroes);
        foreach($heroes as $i => $hero) {
          $fadeInClass = $i == 0 ? ' fade-in' : '';
          echo '<div class="hero' . $fadeInClass . '" style="background-image: url(' . $hero . ');"></div>';
        }
      ?>
    </div>
    <main id="main" class="site-main" role="main">
      <?php
        while (have_posts()):
          the_post();
          get_template_part( "content", "page" );
        endwhile;
      ?>
    </main><!-- #main -->

    <div id="social" class="social" style="display: none;">
      <a class="ig" href="https://instagram.com/mypickee?igshid=ksusixav50gx">
        <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/instagram.svg"); ?>
        <span class="social-label">mypickee</span>
      </a>
    </div>

    <footer>&copy; Pickee 2021</footer>
  </div><!-- #primary -->

  <script>
    window.addEventListener("load", () => {
      setInterval(() => fadeInNextHero("hero", "fade-in"), 3000)

      appendSocial("ml-form-successContent")
    })

    function fadeInNextHero(heroClass, fadeInClass) {
      const first = document.querySelector(`.${heroClass}`)
      const current = document.querySelector(`.${heroClass}.${fadeInClass}`)
      const next = (current && current.nextElementSibling) || first

      if (current) { current.classList.remove(fadeInClass) }
      next.classList.add(fadeInClass)
    }

    function appendSocial(destClass) {
      const social = document.querySelector("#social")
      const dest = document.querySelector(`.${destClass}`)

      if (dest) {
        dest.appendChild(social)
        social.style.display = ""
      }
    }
  </script>
<?php
