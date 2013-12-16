<?php get_header(); ?>
	
	<!-- section -->
	<section class="row fullarticle">
	
	<?php 
		if (have_posts()): while (have_posts()) : the_post(); 

			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			$post_thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
			$post_thumbnail_url = $post_thumbnail[0];
			$post_thumbnail_height = $post_thumbnail[2] - 10;

	?>
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<div class="heroshot" style="background-image: url(<?php echo $post_thumbnail_url; ?>); height: <?php echo $post_thumbnail_height; ?>px;">
					<!-- post title -->
					<h1 class="article-title">
						<?php the_title(); ?>
					</h1>
					<!-- /post title -->
				</div>
			<?php endif; ?>
			<!-- /post thumbnail -->
			
			
			<section class="article-wrap">
				<!-- post details -->
				<div class="post-details">
					<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
					<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
					<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
				</div>
				<!-- /post details -->
				<?php the_content(); // Dynamic Content ?>
			</section>
			<?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
			
			<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>
			
			<p><?php _e( 'This post was written by ', 'html5blank' ); the_author(); ?></p>
			
			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
			
			<?php comments_template(); ?>
			
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
	
	</section>
	<!-- /section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>