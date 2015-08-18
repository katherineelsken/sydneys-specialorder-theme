<?php

//Dashboard Nav
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );


//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_action ('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_loop', 'child_do_custom_loop' );

function child_do_custom_loop() {?>

<table class="orders">
 
 
 
    <tr>
        <th>Order Date</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Product</th>
        <th>Brand</th>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <tr>
         <td>
            <?php	if ( get_field( 'order_date' ) ) {
		echo '<p>' . get_field( 'order_date' )  . '</p>';
	}?>
        </td>
        <td>
            <?php	if ( get_field( 'first_name' ) ) {
		echo '<p>' . get_field( 'first_name' )  . '</p>';
	}?>
        </td>
            <td>
            <?php	if ( get_field( 'last_name' ) ) {
		echo '<p>' . get_field( 'last_name' )  . '</p>';
	}?>
        </td>
  
         <td>
            <?php	if ( get_field( 'product' ) ) {
		echo '<p>' . get_field( 'product' )  . '</p>';
	}?>
        </td>
        
          <td>
            <?php	if ( get_field( 'brand' ) ) {
		echo '<p>' . get_field( 'brand' )  . '</p>';
	}?>
        </td>
        
  
        
        <td>
           <a class="button" href="<?php the_permalink();?>">View</a>
        </td>
        
    </tr>


<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

</table>

  
 
<?php }



genesis();

?>