<?php 
get_header();
 ?>

<div class="rs-breadcrumbs">
	<style>
		.custom-background {
    background-image: url('http://www.bimatech.io/wp-content/uploads/2020/12/inner-blog.jpg');
}
	</style>
        <div class="breadcrumbs-single lazy custom-background" data-was-processed="true">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="breadcrumbs-inner bread-">
                <h1 class="page-title"> <?php the_title(); ?> </h1>             
                 <div class="breadcrumbs-title"> 
<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to BimaTech." href="https://www.bimatech.io" class="home"><span property="name">BimaTech</span></a><meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="post post-page current-item">Événement</span><meta property="url" content="https://www.bimatech.io/evenements/"><meta property="position" content="2"></span></div>
                                    
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

<div class="container">
    <div id="content" class="site-content">

        <style>
			.event-date-tag {
				margin: 25px 0px;
			}
            .event-date-tag {
                font-size: 12px;
                font-weight: 600;
                padding: 7px 9px 6px 9px;
                width: fit-content;
                background-color: #F5F5F5;
                border-radius: 4px 4px 4px 4px;
            }
            .featured-image {
                width: 100%;
                height: auto;
                display: block;
            }
        </style>

        <div style="padding: 30px 0px;" class="row padding-<?php echo esc_attr( $col_letf) ?>">
                <div class="col-lg-8" style="background: #fff; padding: 22px 20px 20px; box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08); border-radius: 10px;">

        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
                    </div><!-- .post-thumbnail -->
                <?php endif; ?>

                <div class="entry-content-wrapper">
                    <div class="entry-content">
                        
                        <div class="blog-meta" style="padding-top:30px;">
									<ul class="btm-cate">
										<li>
											<div class="event-date">
												<span class="date"><i class="fa fa-calendar" style="color: #0B70E1;"></i>
													&nbsp;
													<?php
													$event_date = get_post_meta(get_the_ID(), 'event_date', true);
													$formatted_date = date("j F Y", strtotime($event_date));
													echo esc_html($formatted_date);
													?>
												</span>
											</div>
										</li>
										<li>
											<div class="event-time">
												<p style="margin:0"><i class="far fa-clock" style="color: #0B70E1;"></i>
													&nbsp;
													<?php 
													$event_time = get_post_meta(get_the_ID(), 'event_time', true);
													if (!empty($event_time)) {
														echo esc_html($event_time);
													}
													?>
												</p>
											</div>
										</li>
										<li>
											<div class="event-location">
												<p style="margin:0"><i class="fas fa-map-marker-alt" style="color: #0B70E1;"></i>
													&nbsp;
													<?php 
													$event_venue = get_post_meta(get_the_ID(), 'event_venue', true);
													if (!empty($event_venue)) {
														echo esc_html($event_venue);
													}
													?>
												</p>
											</div>
										</li> 
									</ul>
								</div>

                        <?php the_content(); ?>
                    </div><!-- .entry-content -->
                </div><!-- .entry-content-wrapper -->
				
                <footer class="entry-footer">
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'textdomain'),
                        'after'  => '</div>',
                    ));
                    ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-## -->
					
        <?php endwhile; // End of the loop. ?>

    </div>
			<div class="col-lg-4">
		<aside id="secondary" class="widget-area">
		    <div class="bs-sidebar dynamic-sidebar">
        		<?php dynamic_sidebar( 'event-sidebar' ); ?>
			</div>
		</aside>
    </div>
    </div>

    </div>

</div>

<?php get_footer(); ?>