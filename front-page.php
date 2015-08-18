<?php

 my_force_login();

//Dashboard Nav
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


//widget area
add_action( 'genesis_before_loop', 'home_widget_area' );
function home_widget_area() {
                genesis_widget_area( 'home-widget', array(
		'before' => '<div class="home-widget">',
		'after'  => '</div>',
    ) );

}


genesis();

?>