<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php $mobile_repair_zone_slide_pages = array();
      for ( $count = 1; $count <= 3; $count++ ) {
        $mobile_repair_zone_mod = intval( get_theme_mod( 'mobile_repair_zone_top_slider_page' . $count ));
        if ( 'page-none-selected' != $mobile_repair_zone_mod ) {
          $mobile_repair_zone_slide_pages[] = $mobile_repair_zone_mod;
        }
      }
      if( !empty($mobile_repair_zone_slide_pages) ) :
        $mobile_repair_zone_args = array(
          'post_type' => 'page',
          'post__in' => $mobile_repair_zone_slide_pages,
          'orderby' => 'post__in'
        );
        $mobile_repair_zone_query = new WP_Query( $mobile_repair_zone_args );
        if ( $mobile_repair_zone_query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $mobile_repair_zone_query->have_posts() ) : $mobile_repair_zone_query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <p><?php $mobile_repair_zone_excerpt = get_the_excerpt(); echo esc_html( mobile_repair_zone_string_limit_words( $mobile_repair_zone_excerpt, 40 ) ); ?></p>
            <div class="slider-box-btn mt-4">
              <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','mobile-repair-zone'); ?></a>
            </div>
          </div>
          <div class="social-link">
            <?php if(get_theme_mod('mobile_repair_zone_facebook_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('mobile_repair_zone_facebook_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('mobile_repair_zone_facebook_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('mobile_repair_zone_twitter_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('mobile_repair_zone_twitter_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('mobile_repair_zone_twitter_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('mobile_repair_zone_intagram_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('mobile_repair_zone_intagram_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('mobile_repair_zone_intagram_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('mobile_repair_zone_linkedin_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('mobile_repair_zone_linkedin_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('mobile_repair_zone_linkedin_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('mobile_repair_zone_pintrest_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('mobile_repair_zone_pintrest_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('mobile_repair_zone_pintrest_icon') ); ?>"></i></a>
            <?php }?>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
  </section>

  <section id="team_post" class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 align-self-center">
          <?php if(get_theme_mod('mobile_repair_zone_team_heading') != ''){ ?>
            <h2><?php echo esc_html(get_theme_mod('mobile_repair_zone_team_heading','')); ?></h2>
          <?php }?>
          <?php if(get_theme_mod('mobile_repair_zone_team_heading_text') != ''){ ?>
            <p><?php echo esc_html(get_theme_mod('mobile_repair_zone_team_heading_text','')); ?></p>
          <?php }?>
          <?php if(get_theme_mod('mobile_repair_zone_team_btn_link') != '' || get_theme_mod('mobile_repair_zone_team_btn_text') != ''){ ?>
            <div class="team-btn my-4">
              <a href="<?php echo esc_html(get_theme_mod('mobile_repair_zone_team_btn_link','')); ?>"><?php echo esc_html(get_theme_mod('mobile_repair_zone_team_btn_text','')); ?></a>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 align-self-center team-box">
          <?php $mobile_repair_zone_other_team_post_section = array();
            $team_post_loop = get_theme_mod('mobile_repair_zone_team_post_loop');
            for ($i=1; $i <= $team_post_loop; $i++) {
              $mobile_repair_zone_mod = intval( get_theme_mod( 'mobile_repair_zone_other_team_post_section' .$i));
              if ( 'page-none-selected' != $mobile_repair_zone_mod ) {
                $mobile_repair_zone_other_team_post_section[] = $mobile_repair_zone_mod;
              }
            }
            if( !empty($mobile_repair_zone_other_team_post_section) ) :
            $mobile_repair_zone_args = array(
              'post_type' => 'post',
              'post__in' => $mobile_repair_zone_other_team_post_section,
              'orderby' => 'post__in'
            );
            $mobile_repair_zone_query = new WP_Query( $mobile_repair_zone_args );
            if ( $mobile_repair_zone_query->have_posts() ) :
              $i = 1;
          ?>
          <div class="owl-carousel team-inner-box" role="listbox">
            <?php while ( $mobile_repair_zone_query->have_posts() ) : $mobile_repair_zone_query->the_post(); ?>
              <div class="article-box">
                <?php if ( has_post_thumbnail() ) { ?><?php mobile_repair_zone_post_thumbnail(); ?><?php }?>
                <div class="entry-summary p-3 m-0">
                  <h3 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php if( get_post_meta($post->ID, 'mobile_repair_zone_team_designation', true) ) {?>
                    <p class="mb-0"><?php echo esc_html(get_post_meta($post->ID,'mobile_repair_zone_team_designation',true)); ?></p>
                  <?php }?>
                </div>
              </div>
            <?php $i++; endwhile;
            wp_reset_postdata();?>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php endif;
            endif;?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
