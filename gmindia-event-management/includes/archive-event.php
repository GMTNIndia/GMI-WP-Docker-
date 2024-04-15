<?php get_header(); ?>

<div class="container">
    <div id="content" class="site-content">

        <style>
            .event-grid {
                    display: flex;
                    flex-wrap: wrap;
                    margin: 0 auto;
                    max-width: 1260px;
                }

            .event-item {
                width: 100%;
                margin-bottom: 20px;
                padding: 15px;
                background: #fff;
                box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
                border-radius: 10px;
            }

                .event-item .event-thumbnail img {
                    width: 100%;
               		border-radius: 10px;
                   /* height: 200px;
                    object-fit: cover; */
                }
			
				.event-content {
                    padding: 30px 15px;
                }
                
                .entry-content-event {
                    padding: 15px 0px;
                }

                .event-date-tag {
                    font-size: 12px;
                    font-weight: 600;
                    margin: 25px 15px 15px 15px;
                    padding: 7px 9px 6px 9px;
                    width: fit-content;
                    background-color: #F5F5F5;
                    border-radius: 4px 4px 4px 4px;
                }
                
                .excerpt {
                    max-height: 3 * 1.2em; /* Adjust line height and number of lines as needed */
                    overflow: hidden;
                    line-height: 1.2em; /* Ensure proper line height */
                }
			
				.event-thumbnail .event-tags {
					position: absolute;
					right: 80px;
					margin-top: -60px;
					z-index: 10;
				}
			
				.custom-tag-links a {
					border-radius: 30px;
					color: #ffffff;
					background: #03228f;
					background: linear-gradient(to right, #03228f 0%, #03228f 0%, #03228f 26%, #4e95ed 100%, #2989d8 100%, #207cca 100%, #0b70e1 100%);
					transition: 0.4s;
					font-size: 14px;
					font-weight: 500;
					padding: 6px 20px;
					display: block;
				}
				.custom-tag-links a:hover {
					background: linear-gradient(to left, #03228f 0%, #03228f 0%, #03228f 26%, #4e95ed 100%, #2989d8 100%, #207cca 100%, #0b70e1 100%);
				}
			
                @media (max-width: 768px) {
                    .event-item {
                        width: 100%;
                    }
                    .event-item {
                        margin-bottom: 20px;
                        padding: 20px;
                        margin-right: 10px;
                        margin-left: 10px;
                    }
                }
        </style>

        <div style="padding: 30px 0px;" class="row padding-<?php echo esc_attr( $col_letf) ?>">
                <div class="col-lg-8">

        <div class="event-grid">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="event-item">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="event-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                <?php endif; ?>
								<div class="event-tags">
									<?php 
									// Retrieve tags for the post
									$post_tags = wp_get_post_terms(get_the_ID(), 'gmi_event_tag');

									// Check if there are any tags
									if ($post_tags) {
										// Sort tags by last modified date
										usort($post_tags, function($a, $b) {
											return strtotime($b->taxonomy_last_updated) - strtotime($a->taxonomy_last_updated);
										});

										// Display the most recently updated tag
										$latest_tag = reset($post_tags);
										echo '<p class="custom-tag-links"><a href="' . get_post_type_archive_link( 'gmi-event' ) . '?gmi_event_tag=' . $latest_tag->slug . '">' . $latest_tag->name . '</a></p>';
									}
									?>
								</div><!-- .event-tags -->
                            </div><!-- .event-thumbnail -->

                            <div class="event-content">
                                <header class="entry-header">
                                    <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                </header><!-- .entry-header -->
								<div class="blog-meta">
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
                                <?php
                                $excerpt = get_the_excerpt();
                                $excerpt = wp_trim_words($excerpt, 20, '...');
                                echo '<div class="excerpt">' . $excerpt . '</div>';
                                ?>

                            </div><!-- .event-content -->
                        </article><!-- #post-<?php the_ID(); ?> -->
                    </div><!-- .event-item -->
                <?php endwhile; ?>
            <?php endif; ?>
        </div><!-- .event-grid -->

        <?php the_posts_navigation(); ?>

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