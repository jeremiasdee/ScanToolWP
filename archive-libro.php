<div class="wp-site-blocks">
	<header class="wp-block-template-part">
			<?php get_header(); ?>
		</header>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			           <a href="<?php the_permalink(); ?>"><h2><?php the_title() ;?></h2></a>
			           <?php the_author(); ?> <?php the_time('F j, Y'); ?> <?php the_category(); ?><br/>
			           <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a><br/>
			           <?php the_content(); ?>
								 	<br/><strong>Genero</strong>
							 		<?php echo get_post_meta(get_the_ID(),"_book_genre_key",true);?>
									<br/>
									<strong>Autor</strong>
									<?php echo get_post_meta(get_the_ID(),"_book_author_key",true);?>
									<br/>
									<strong>Año de publicación</strong>
									<?php echo get_post_meta(get_the_ID(),"_book_publishing_key",true);?>


			<?php endwhile; else : ?>
			             <p><?php _e( 'No hay posts para mostrar.' ); ?></p>
			<?php endif; ?>

<footer class="wp-block-template-part">
<?php get_footer(); ?>
</footer>


</div>
