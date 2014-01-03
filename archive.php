<?php get_header(); 
	$name = get_bloginfo('name');
	$title = "";
	if (is_category('news')) {
		$title = $name." Automotive News";
	} elseif (is_category('reviews')) {
		$title = $name." Automotive Reviews";
	} elseif (is_category('podcasts')) {
		$title = $name." Automotive Podcasts";
	} elseif( is_tag() ) {
		$title =  "&#8216;".single_tag_title("", false)."&#8217; Tagged on ".$name;
	} elseif (is_day() OR is_month() OR is_year()) { 
		$title = "Posts from ".get_the_time('F, Y');
	} elseif (is_author()) {
		$title = "Posted by ".get_the_author();
	} else {
		$title = "More from ".$name;
	}
?>
	
	<!-- section -->
	<section role="main" class="content-wrap">
		<h1><?php echo $title; ?></h1>
	
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120,120)); ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->
			
			<!-- post title -->
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /post title -->
			
			<!-- post details -->
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
			<!-- /post details -->
			
			<?php echo limit_words(get_the_excerpt(), '23'); ?> <a href="<?php the_permalink(); ?>">read more</a>
			
			<?php edit_post_link(); ?>
			
		</article>
		<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

		<!-- article -->
		<article>
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
		</article>
		<!-- /article -->

		<?php endif; ?>
		
		<?php get_template_part('pagination'); ?>
		
	</section>
	<!-- /section -->

<?php get_footer(); ?>