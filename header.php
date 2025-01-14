<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package codelogix 
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">
		<!---Top Section has controll from Dashboard admin panel. ----->
		<div class="top_section" 
		style="display:flex; 
		background:<?php echo get_option('custom_bg_color');?>; 
		color:<?php echo get_option('custom_font_color');?>;
		font-size:<?php echo get_option('custom_font_size');?>px">
			<div class="inner_top_section">
				<div class="top_left"><i class="fa fa-envelope"></i> <?php echo get_option('theme_fields');?></div>
				<div class="top_middle"><i class="fa fa-phone"></i> <?php echo get_option('theme_fields1');?></div>
				<div class="top_right"><i class="fab fa-whatsapp"></i> <?php echo get_option('theme_fields2');?></div>
				<div class="top_social"> 
					<i class="fab fa-github"></i>
					<i class="fab fa-wordpress"></i>
					<i class="fab fa-youtube"></i>
					<i class="fab fa-facebook"></i>
                    <i class="fab fa-linkedin"></i>
					<i class="fab fa-whatsapp"></i>   

				</div>
			</div>
		</div>	
		<div class="the_header">
			<!-- .site-branding -->
			<div class="site-branding">
				<?php
				//Custom Logo - 01.07.2025 - https://developer.wordpress.org/themes/functionality/custom-logo/
				if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}

				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$codelogix_description = get_bloginfo( 'description', 'display' );
				if ( $codelogix_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $codelogix_description;  ?></p>
				<?php endif; ?>
				
			</div>
			<!-- #site-navigation -->
			<div class="site-navigation">
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'codelogix' ); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);

					?>
				</nav>
			</div>
			<!-- .site-buttons -->
			 <div class="site-button">
				<button>Call Me</button>
			 </div>
		</div>
	</header><!-- #masthead -->
