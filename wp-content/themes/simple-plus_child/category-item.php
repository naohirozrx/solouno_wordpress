<?php
/**
 * Category
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();

$welcart_simpleplus_grid_class  = welcart_simpleplus_get_article_class( get_the_ID() );
$welcart_simpleplus_grid_class .= ' ' . welcart_simpleplus_get_round_class( 'image_settings_grid_image_radius_setting' );
$welcart_simpleplus_grid_class .= welcart_simpleplus_get_overlay_image_class( 'image_settings_grid_overlay_image_setting' );
$welcart_simpleplus_grid_class .= welcart_simpleplus_get_text_shadow_class( 'image_settings_grid_text_shadow_setting' );
?>




	<section id="primary" class="item-archive">
		<?php
			$args = array( 'category_name' => 'disney', 'posts_per_page'=> 100 );
			$myposts = get_posts( $args );
			if ( count( $myposts ) > 0 ):
		?>
		<h3>ディズニーランドセル</h3>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot">
		<ul class="item-list">
			<?php
			foreach ( $myposts as $post ) :
					setup_postdata( $post );
			?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<figure><?php
						the_post_thumbnail(
							'thumb-rect',
							array(
								'class' => 'img-fluid grid-image-rounded',
							)
						);
						?></figure>
					<span class="item-title"><?php the_title();?></span>
					<span class="price"><?php usces_the_firstPrice(); ?>円</span>
				</a>
			</li>
			<?php
			endforeach; 
			wp_reset_postdata();
			?>
		</ul>
		<a href="/category/item/disney" class="category-more-link">すべての商品を見る</a>
		<?php endif; ?>
		<?php
			$args = array( 'category_name' => 'sports', 'posts_per_page'=> 100 );
			$myposts = get_posts( $args );
			if ( count( $myposts ) > 0 ):
		?>
		<h3>スポーツブランドランドセル</h3>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot">
		<ul class="item-list">
			<?php
			foreach ( $myposts as $post ) :
					setup_postdata( $post );
			?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<figure><?php
						the_post_thumbnail(
							'thumb-rect',
							array(
								'class' => 'img-fluid grid-image-rounded',
							)
						);
						?></figure>
					<span class="item-title"><?php the_title();?></span>
					<span class="price"><?php usces_the_firstPrice(); ?>円</span>
				</a>
			</li>
			<?php
			endforeach; 
			wp_reset_postdata();
			?>
		</ul>
		<a href="/category/item/sports" class="category-more-link">すべての商品を見る</a>
		<?php endif; ?>
		
		<?php
			$args = array( 'category_name' => 'totebag', 'posts_per_page'=> 6 );
			$myposts = get_posts( $args );
			if ( count( $myposts ) > 0 ):
		?>
		<h3>トートバッグ</h3>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot">

		<ul class="item-list">
			<?php
			foreach ( $myposts as $post ) :
					setup_postdata( $post );
			?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<figure><?php
						the_post_thumbnail(
							'thumb-rect',
							array(
								'class' => 'img-fluid grid-image-rounded',
							)
						);
						?></figure>
					<span class="item-title"><?php the_title();?></span>
					<span class="price"><?php usces_the_firstPrice(); ?>円</span>
				</a>
			</li>
			<?php
			endforeach; 
			wp_reset_postdata();
			?>
		</ul>
		<a href="/category/item/totebag" class="category-more-link">すべての商品を見る</a>
		<?php endif; ?>
		
		<?php
			$args = array( 'category_name' => 'accessories', 'posts_per_page'=> 6);
			$myposts = get_posts( $args );
			if ( count( $myposts ) > 0 ):
		?>
		<h3>ランドセル付属品</h3>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot">

		<ul class="item-list">
			<?php
			foreach ( $myposts as $post ) :
					setup_postdata( $post );
			?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<figure><?php
						the_post_thumbnail(
							'thumb-rect',
							array(
								'class' => 'img-fluid grid-image-rounded',
							)
						);
						?></figure>
					<span class="item-title"><?php the_title();?></span>
					<span class="price"><?php usces_the_firstPrice(); ?>円</span>
				</a>
			</li>
			<?php
			endforeach; 
			wp_reset_postdata();
			?>
		</ul>
		<a href="/category/item/accessories" class="category-more-link">すべての商品を見る</a>
		<?php endif; ?>
		
		<?php
			$args = array( 'category_name' => 'etc', 'posts_per_page'=> 6 );
			$myposts = get_posts( $args );
			if ( count( $myposts ) > 0 ):
		?>
		<h3>その他</h3>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot">

		<ul class="item-list">
			<?php
			foreach ( $myposts as $post ) :
					setup_postdata( $post );
			?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<figure><?php
						the_post_thumbnail(
							'thumb-rect',
							array(
								'class' => 'img-fluid grid-image-rounded',
							)
						);
						?></figure>
					<span class="item-title"><?php the_title();?></span>
					<span class="price"><?php usces_the_firstPrice(); ?>円</span>
				</a>
			</li>
			<?php
			endforeach; 
			wp_reset_postdata();
			?>
		</ul>
		<a href="/category/item/etc" class="category-more-link">すべての商品を見る</a>
		<?php endif; ?>
	</section>
<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
