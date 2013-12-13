<?php get_header(); ?>

<section class="banner-rotator row">
  <div class="rotator col-xs-12">
      <ul class="img-list">
        <li class="img-wrap">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/banner-img.jpeg" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?> Banner Image" />
          <div class="caption">
          	<h1><?php bloginfo('name'); ?></h1>
          	<h2><?php bloginfo('description'); ?></h2>
          </div>
        </li>
      </ul>
    </div>

</section>

<div class="row home-content">
	<section class="col-xs-12 col-sm-6 col-lg-4 latest-news">
		<h2>Latest News</h2>
        <?php 
			// the query
			$news_query = new WP_Query( array ( 'category_name' => 'news', 'posts_per_page' => 3 ) ); ?>

			<?php if ( $news_query->have_posts() ) : ?>
				<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
		            <article class="home-reviews">
		                <h4>
		                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> - post by txGarage">
		                        <?php the_title(); ?>
		                    </a>
		                </h4>
		                <time>
		                    <span class="date"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></span>
		                    <span class="author"><?php _e( 'Published by', 'ampnetmedia' ); ?> <?php the_author_posts_link(); ?></span>
		                </time>
		                <p>
		                    <?php echo limit_words(get_the_excerpt(), '23'); ?> <a href="<?php the_permalink(); ?>">read more</a>
		                </p>
		            </article>
	           	<?php endwhile; ?>
        	<a href="/category/news/">More News &raquo;</a>
        <?php else:  ?>
  			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</section>
	<section class="col-xs-12 col-sm-6 col-lg-4 latest-reviews">
		<h2>Reviews</h2>
		<?php 
			// the query
			$review_query = new WP_Query( array ( 'category_name' => 'reviews', 'posts_per_page' => 3 ) ); ?>

			<?php if ( $review_query->have_posts() ) : ?>
				<?php while ( $review_query->have_posts() ) : $review_query->the_post(); ?>
		            <article class="home-reviews">
		                <h4>
		                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> - post by txGarage">
		                        <?php the_title(); ?>
		                    </a>
		                </h4>
		                <time>
		                    <span class="date"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></span>
		                    <span class="author"><?php _e( 'Published by', 'ampnetmedia' ); ?> <?php the_author_posts_link(); ?></span>
		                </time>
		                <p>
		                    <?php echo limit_words(get_the_excerpt(), '23'); ?> <a href="<?php the_permalink(); ?>">read more</a>
		                </p>
		            </article>
	           	<?php endwhile; ?>
        	<a href="/category/news/">More Reviews &raquo;</a>
        <?php else:  ?>
  			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</section>

	<section class="col-xs-12 col-sm-12 col-lg-4 more-stuff">
		<h2>Our Friends</h2>
		<div class="row">
            <?php wp_nav_menu( array('theme_location' => 'our-friends') ); ?>
        </div>
	</section>
</div>

<?php get_footer(); ?>