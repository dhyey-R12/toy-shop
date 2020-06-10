<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_landing_page_before_slider' ); ?>

  <?php if(get_theme_mod('vw_landing_page_slider_hide_show')==1){ ?>

  <section id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <?php $vw_landing_page_slider_pages = array();
        for ( $count = 1; $count <= 4; $count++ ) {
          $mod = intval( get_theme_mod( 'vw_landing_page_slider_page' . $count ));
          if ( 'page-none-selected' != $mod ) {
            $vw_landing_page_slider_pages[] = $mod;
          }
        }
        if( !empty($vw_landing_page_slider_pages) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $vw_landing_page_slider_pages,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
      ?>     
      <div class="carousel-inner" role="listbox">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <?php the_post_thumbnail(); ?>
            <div class="carousel-caption">
              <div class="inner_carousel">
                <h1><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_landing_page_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_landing_page_slider_excerpt_number','30')))); ?></p>
                <div class="more-btn">
                  <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'READ MORE', 'vw-landing-page' ); ?><i class="<?php echo esc_attr(get_theme_mod('vw_landing_page_slider_button_icon','fa fa-angle-right')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'READ MORE','vw-landing-page' );?></span></a>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; endwhile; 
        wp_reset_postdata();?>
      </div>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
      endif;?>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
        <span class="screen-reader-text"><?php esc_attr_e( 'Previous','vw-landing-page' );?></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
        <span class="screen-reader-text"><?php esc_attr_e( 'Next','vw-landing-page' );?></span>
      </a>
    </div>
    <div class="clearfix"></div>
  </section>

  <?php } ?>

  <?php do_action( 'vw_landing_page_after_slider' ); ?>

  <?php if( get_theme_mod( 'vw_landing_page_info') != '') { ?>

  <section id="info-section">
    <div class="container">
      <div class="row">
        <?php
          $vw_landing_page_catData =  get_theme_mod('vw_landing_page_info','');
          if($vw_landing_page_catData){
          $page_query = new WP_Query(array( 'category_name' => esc_html($vw_landing_page_catData,'vw-landing-page'))); ?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
          <div class="col-lg-4 col-md-4">
            <div class="info-box">
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_landing_page_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_landing_page_info_excerpt_number','30')))); ?></p>
            </div>
          </div>
          <?php endwhile;
          wp_reset_postdata();
        } ?>
      </div>
    </div>
  </section>

  <?php }?>

  <?php do_action( 'vw_landing_page_after_services' ); ?>

  <section id="about-section">
    <div class="container">
      <?php if( get_theme_mod( 'vw_landing_page_section_title') != '') { ?>
        <h3><?php echo esc_html( get_theme_mod( 'vw_landing_page_section_title','vw-landing-page') ); ?></h3>
        <hr>
      <?php }?>
      <div class="row about-box">
        <?php $vw_landing_page_service_page = array();
          $mod = absint( get_theme_mod( 'vw_landing_page_about','vw-landing-page'));
          if ( 'page-none-selected' != $mod ) {
            $vw_landing_page_service_page[] = $mod;
          }
          if( !empty($vw_landing_page_service_page) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $vw_landing_page_service_page,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $count = 0;
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="col-lg-7 col-md-7">
                  <h4><?php the_title(); ?></h4>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_landing_page_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_landing_page_about_excerpt_number','30')))); ?></p>
                  <div class="content-bttn">
                    <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'READ MORE', 'vw-landing-page' ); ?><i class="<?php echo esc_attr(get_theme_mod('vw_landing_page_about_button_icon','fa fa-angle-right')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'READ MORE','vw-landing-page' );?></span></a>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5">
                  <?php the_post_thumbnail(); ?>
                </div>
              <?php $count++; endwhile; ?>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php endif;
          endif;
          wp_reset_postdata();
        ?>
      </div>
    </div>  
  </section>

  <?php do_action( 'vw_landing_page_after_about_section' ); ?>

  <div id="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>