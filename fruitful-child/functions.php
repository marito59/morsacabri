<?php

	function my_theme_enqueue_styles() {

		$parent_style = 'fruitful-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style ),
			wp_get_theme()->get('Version')
		);
	}
	add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

	
	if (class_exists('Woocommerce')) { 	
		function cma_init_woo_actions() {
			function go_hooks() {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
			}
			
			go_hooks();
				
		}

		add_action( 'wp', 'cma_init_woo_actions' , 10);

		add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

		function woo_remove_product_tabs( $tabs ) {
			unset( $tabs['reviews'] ); 			// Remove the reviews tab
			return $tabs;
		}
	}
?>