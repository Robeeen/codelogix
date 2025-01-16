<?php
/**
 * The header for CodeLogix Theme
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
		<div class="top_section">
			<div class="inner_top_section">
				<div class="top_left">
					<i class="fa fa-envelope"></i> 
					<?php echo get_option('theme_fields');?>			
				</div>

				<div class="top_middle">
					<i class="fa fa-phone"></i> 
					<?php echo get_option('theme_fields1');?>
				</div>

				<div class="top_right">
					<i class="fab fa-whatsapp"></i> 
					<?php echo get_option('theme_fields2');?>
				</div>

				<div class="top_social"> 
					<a href="https://<?php echo get_option('linkedin_link');?>" target="_new" class="link_show"><i class="fab fa-linkedin-in"></i></a>
					<a href="https://<?php echo get_option('tube_link');?>" target="_new" class="tube_show"><i class="fab fa-youtube"></i></a> 
					<a href="https://<?php echo get_option('fb_link');?>" target="_new" class="fb_show"><i class="fab fa-facebook-f"></i></a> 
					<a href="https://<?php echo get_option('twiter_link');?>" target="_new" class="twiter_show"><i class="fab fa-twitter"></i></a>
					<a href="https://<?php echo get_option('skype_link');?>" target="_new" class="skype_show"><i class="fab fa-skype"></i></a>             
				</div>
				<?php
					if ( strlen(get_option('linkedin_link')) > 0){
						echo '<style>
								.link_show{
									display: inline;
								}		
						      </style>';
					}else{
						echo '<style>
								.link_show{
									display: none;
								}		
						      </style>';
					}
					if( strlen(get_option('fb_link')) > 0){
						echo '<style>
								.fb_show{
									display: inline;
								}		
						      </style>';
					}else{
						echo '<style>
								.fb_show{
									display: none;
								}		
						      </style>';
					}
					if(strlen(get_option('tube_link')) > 0){
						echo '<style>
								.tube_show{
									display: inline;
								}		
						      </style>';
					}else{
						echo '<style>
								.tube_show{
									display: none;
								}		
						      </style>';
					}
					if(get_option('twiter_link')){
						echo '<style>
								.twiter_show{
									display: inline;
								}		
						      </style>';
					}else{
						echo '<style>
								.twiter_show{
									display: none;
								}		
						      </style>';
					}
					if(get_option('skype_link')){
						echo '<style>
								.skype_show{
									display: inline;
								}		
						      </style>';
					}else{
						echo '<style>
								.skype_show{
									display: none;
								}		
						      </style>';
					}
				?>
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
				<button><?php echo get_option('button_text');?></button>
			 </div>
		</div>
	</header><!-- #masthead -->
