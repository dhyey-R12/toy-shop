<?php
/**
 * The template part for header
 *
 * @package VW Landing Page 
 * @subpackage vw_landing_page
 * @since VW Landing Page 1.0
 */
?>

<?php
  $vw_landing_page_search_hide_show = get_theme_mod( 'vw_landing_page_search_hide_show' );
  if ( 'Disable' == $vw_landing_page_search_hide_show ) {
   $colmd = 'col-lg-9 col-md-8';
  } else { 
   $colmd = 'col-lg-8 col-md-6 col-6';
  } 
?>

<div class="main-header">
  <div class="header-menu <?php if( get_theme_mod( 'vw_landing_page_sticky_header') != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4">
          <div class="logo">
            <?php if ( has_custom_logo() ) : ?>
              <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <?php if( get_theme_mod('vw_landing_page_logo_title_hide_show',true) != ''){ ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php } ?>
                <?php else : ?>
                  <?php if( get_theme_mod('vw_landing_page_logo_title_hide_show',true) != ''){ ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                  <?php  }?>
                <?php endif; ?>
              <?php endif; ?>
              <?php
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) :
              ?>
              <?php if( get_theme_mod('vw_landing_page_tagline_hide_show',true) != ''){ ?>
                <p class="site-description">
                  <?php echo $description; ?>
                </p>
              <?php } ?>
            <?php endif; ?>
          </div>
        </div>
        <div class="<?php echo esc_html( $colmd ); ?>">
          <?php get_template_part( 'template-parts/header/navigation' ); ?>        
        </div>
        <?php if ( 'Disable' != $vw_landing_page_search_hide_show ) {?>
          <div class="col-lg-1 col-md-2 col-6">
            <div class="search-box">
              <a href="#" onclick="vw_landing_page_search_open()"><span><i class="fas fa-search"></i></span></a>
            </div>
          </div>
        <?php }?>
      </div>
      <div class="serach_outer">
        <div class="serach_inner">
          <?php get_search_form(); ?>
        </div>
        <a href="#main" onclick="vw_landing_page_search_close()" class="closepop"><i class="fa fa-window-close"></i></a>
      </div>
    </div>
  </div>
</div>