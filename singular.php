<?php
/**
 * Singular
 *
 * @package WordPress
 * @subpackage Fictioneer
 * @since 1.0
 * @see comments.php
 */
?>

<?php

// Header
get_header();

// Gate access
fictioneer_gate_unpublished_posts();

?>

<main id="main" class="main singular">
  <div class="observer main-observer"></div>
  <?php do_action( 'fictioneer_main' ); ?>
  <div class="main__background polygon polygon--main background-texture"></div>
  <div class="main__wrapper">
    <?php do_action( 'fictioneer_main_wrapper' ); ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php
        // Setup
        $title = fictioneer_get_safe_title( get_the_ID() );
        $this_breadcrumb = [$title, get_the_permalink()];
      ?>

      <article id="singular-<?php the_ID(); ?>" class="singular__article padding-left padding-right padding-top padding-bottom">

        <header class="singular__header">
          <h1 class="singular__title"><?php echo $title; ?></h1>
        </header>

        <section class="singular__content content-section"><?php the_content(); ?></section>

        <footer class="singular__footer"><?php do_action( 'fictioneer_singular_footer' ); ?></footer>

      </article>

      <?php do_action( 'fictioneer_before_comments' ); ?>

      <?php if ( comments_open() && ! post_password_required() ) : ?>
        <section class="singular__comments comment-section padding-left padding-right padding-bottom">
          <?php comments_template(); ?>
        </section>
      <?php endif; ?>

    <?php endwhile; ?>
  </div>
</main>

<?php
  // Footer arguments
  $footer_args = array(
    'post_type' => 'page',
    'post_id' => get_the_ID(),
    'breadcrumbs' => array(
      [fcntr( 'frontpage' ), get_home_url()]
    )
  );

  // Add current breadcrumb
  $footer_args['breadcrumbs'][] = $this_breadcrumb;

  // Get footer with breadcrumbs
  get_footer( null, $footer_args );
?>
