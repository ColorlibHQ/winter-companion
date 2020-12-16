<?php 
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Winter Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
    
    // Woo products category list
    function winter_product_cat( $provide_id = '' ){
        
        $product_cat = get_terms( array( 'taxonomy' => 'product_cat' ,'hide_empty' => true ) );
        $productCat = [];
        if( is_array( $product_cat ) && count( $product_cat ) > 0 ){
            foreach( $product_cat as $cat ){
                if ( $provide_id == 'yes' ) {
                    $productCat[$cat->id]= $cat->name;
                } else {
                    $productCat[$cat->slug]= $cat->name;
                }
            }
        }
        return $productCat;
    }
    
    
    function winter_get_cat_name_by_product_id( $proudct_id, $provide_slugs = '' ){
        $terms = get_the_terms( $proudct_id, 'product_cat' );
        $slugs = '';
        if ( $terms && ! is_wp_error( $terms ) ) {
            if ( ! empty( $terms ) ) {
                if ( $provide_slugs == 'yes' ) {
                    for ( $i = 0; $i < count($terms); $i++ ) {
                        $slugs .= $terms[$i]->slug.' ';
                    }
                } else {
                    $slugs = $terms[0]->name;
                }
            }
        }

        return trim($slugs);
    }
    // New Arrival Product 
    function winter_new_arrival_products( $product_cats, $product_limit = '6' ){
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => absint( $product_limit ),
            'tax_query'         => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'name',
                    'terms'    => $product_cats,
                ),
            ),
        );
        $i = 1;
        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) {            
            while ( $loop->have_posts() ) : $loop->the_post();
                global $product;
                switch ($i) {
                    case ($i == 1 || $i == 6):
                        $dynamic_class = 'weidth_1';
                        $product_img_size = 'winter_new_arrival_product_thumb_755x560';
                        break;
                    case ($i == 2 || $i == 5):
                        $dynamic_class = 'weidth_2';
                        $product_img_size = 'winter_new_arrival_product_thumb_540x560';
                        break;
                    
                    default:
                        $dynamic_class = 'weidth_3';
                        $product_img_size = 'winter_new_arrival_product_thumb_565x560';
                        break;
                }
                ?>
                <div class="single_arrivel_item <?php echo esc_attr( $dynamic_class )?> mix <?php echo winter_get_cat_name_by_product_id( get_the_ID(), 'yes' )?>">
                    <?php
                    echo woocommerce_get_product_thumbnail( $product_img_size );
                    ?>
                    <div class="hover_text">
                        <p><?php echo winter_get_cat_name_by_product_id( get_the_ID() )?></p>
                        <a href="<?php the_permalink()?>"><h3><?php the_title()?></h3></a>
                        <?php
                            $rating_count = $product->get_rating_count();
                            $review_count = $product->get_review_count();
                            $average      = $product->get_average_rating();
                            if ( $rating_count >= 0 ) {
                                echo wc_get_rating_html($average, $rating_count);
                            }
                        ?>
                        <h5><?php echo $product->get_price_html(); ?></h5>
                        <div class="social_icon">
                            <!-- <a href="#"><i class="ti-heart"></i></a> -->
                            <a href="<?php echo esc_url( $product->add_to_cart_url() )?>"><i class="ti-bag"></i></a>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            endwhile;
        } else {
            echo esc_html__( 'No New Arrival Product Found!', 'winter-companion' );
        }
        wp_reset_postdata();
    }

    // Featured Product 
    function winter_featured_products( $postnumber = '6' ){
        ?>
            <div class="wrap-slick2 rs1-slick2">
                <div class="slick2">
                <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => esc_html( $postnumber ),
                        'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                ),
                            ),
                        );
                    $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        
                        global $set_place;
                            $set_place['set_place'] = 'item-slick2 p-l-15 p-r-15';
                        
                        while ( $loop->have_posts() ) : $loop->the_post();
                            wc_get_template_part( 'content', 'product' );
                        endwhile;
                    } else {
                        echo esc_html__( 'No feature product found', 'winter-companion' );
                    }
                    wp_reset_postdata();
                ?>
                </div>
            </div>
        <?php
    }

    // Blog Section
    function winter_blog_section( $postnumber ){
        
        ?>
            <div class="row">
                <?php   
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => esc_html( $postnumber ),
                );
                
                $query = new WP_Query( $args );
                
                if( $query->have_posts() ):
                while( $query->have_posts() ):
                    $query->the_post();
                ?>
                <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                    <!-- Block3 -->
                    <div class="block3">
                        <a href="<?php the_permalink() ?>" class="block3-img dis-block hov-img-zoom">
                            <?php 
                            the_post_thumbnail('winter_widget_post_thumb');
                            ?>
                        </a>

                        <div class="block3-txt p-t-14">
                            <h4 class="p-b-7">
                                <a href="<?php the_permalink() ?>" class="m-text11">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <span class="s-text6"><?php esc_html_e( 'By', 'winter-companion' ); ?></span> <span class="s-text7"><?php the_author(); ?></span>
                            <span class="s-text6"><?php esc_html_e( 'on', 'winter-companion' ); ?></span> <span class="s-text7"><?php echo esc_html( get_the_date() ); ?></span>
                            <div class="post-excerpt s-text8">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                endwhile;
                wp_reset_postdata();
                endif;
                ?>
            </div>
        <?php
    }

    // Our Product section
    function winter_our_product( $postnumber ){
       
        if( !winter_is_wc_activated() ){
            return;
        }

        global $set_place, $woocommerce;
        $set_place['set_place'] = 'col-sm-6 col-md-4 col-lg-3 p-b-50';
        ?>
            <!-- Tab panes -->
            <div class="tab-content woocommerce p-t-35">
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <div class="row">
                        <?php 
                        // setup query
                        $args = array(
                            'post_type'             => 'product',
                            'post_status'           => 'publish',
                            'ignore_sticky_posts'   => 1,
                            'posts_per_page'        => esc_html( $postnumber ),         
                            'meta_key'              => 'total_sales',
                            'orderby'               => 'meta_value_num',
                        );
                        
                        $loop = new WP_Query( $args );
                        if ( $loop->have_posts() ) {
                            
                            while ( $loop->have_posts() ) : $loop->the_post();
                            
                                wc_get_template_part( 'content', 'product' );
                                
                            endwhile;
                            wp_reset_postdata();
                        } else {
                            echo esc_html__( 'No feature product found', 'winter-companion' );
                        }
                        
                        ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="featured" role="tabpanel">
                    <div class="row">
                        <?php
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => esc_html( $postnumber ),
                                'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_visibility',
                                            'field'    => 'name',
                                            'terms'    => 'featured',
                                        ),
                                    ),
                                );
                            $loop = new WP_Query( $args );
                            if ( $loop->have_posts() ) {
                                
                                while ( $loop->have_posts() ) : $loop->the_post();
                                
                                    wc_get_template_part( 'content', 'product' );
                                    
                                endwhile;
                                wp_reset_postdata();
                            } else {
                                echo esc_html__( 'No feature product found', 'winter-companion' );
                            }
                            
                        ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="sale" role="tabpanel">
                    <div class="row">
                        <?php 
                        // Get products on sale
                        $product_ids_on_sale = wc_get_product_ids_on_sale();
                        $meta_query = array();
                        $meta_query[] = $woocommerce->query->visibility_meta_query();
                        $meta_query[] = $woocommerce->query->stock_status_meta_query();
                        $args = array(
                            'posts_per_page'=> esc_html( $postnumber ),
                            'orderby'       => 'title',
                            'order'         => 'asc',
                            'no_found_rows' => 1,
                            'post_status'   => 'publish',
                            'post_type'     => 'product',
                            'orderby'       => 'date',
                            'order'         => 'ASC',
                            'meta_query'    => $meta_query,
                            'post__in'      => $product_ids_on_sale
                        );
                            
                        $loop = new WP_Query( $args );
                        if ( $loop->have_posts() ) {
                            
                            while ( $loop->have_posts() ) : $loop->the_post();
                            
                                wc_get_template_part( 'content', 'product' );
                                
                            endwhile;
                            wp_reset_postdata();
                        } else {
                            echo esc_html__( 'No feature product found', 'winter-companion' );
                        }
                        ?>

                    </div>
                </div>

                <div class="tab-pane fade" id="top-rate" role="tabpanel">
                    <div class="row">
                        <?php 

                        $query_args = array(
                            'posts_per_page' => esc_html( $postnumber ),
                            'no_found_rows'  => 1,
                            'post_status'    => 'publish',
                            'post_type'      => 'product',
                            'meta_key'       => '_wc_average_rating',
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC',
                            'meta_query'     => WC()->query->get_meta_query(),
                            'tax_query'      => WC()->query->get_tax_query(),
                        ); // WPCS: slow query ok.
                        $loop = new WP_Query( $query_args );
                        if ( $loop->have_posts() ) {
                            while ( $loop->have_posts() ) : $loop->the_post();
                            
                                wc_get_template_part( 'content', 'product' );
                                
                            endwhile;
                            wp_reset_postdata();
                        } else {
                            echo esc_html__( 'No feature product found', 'winter-companion' );
                        }
                        
                        ?>
                    </div>
                </div>
            </div>

        <?php

    }

    // Set contact form 7 default form template
    function winter_contact7_form_content( $template, $prop ) {
      if ( 'form' == $prop ) {

            $template =
                '<div class="bo4 of-hidden size15 m-b-20">
                [text* winter-name class:sizefull class:s-text7 class:p-l-22 class:p-r-22 placeholder "Full Name"]
                </div>
                <div class="bo4 of-hidden size15 m-b-20">
                [text* phone-number class:sizefull class:s-text7 class:p-l-22 class:p-r-22 placeholder "Phone Number"]
                </div>
                <div class="bo4 of-hidden size15 m-b-20">
                [email* winter-email class:sizefull class:s-text7 class:p-l-22 class:p-r-22 placeholder "Email Address"]
                </div>
                [textarea message class:dis-block class:s-text7 class:size20 class:bo4 class:p-l-22 rows:4 class:p-r-22 class:p-t-13 class:m-b-20 placeholder "Message"]
                <div class="w-size25">
                [submit class:flex-c-m class:size2 class:bg1 class:bo-rad-23 class:hov1 class:m-text3 class:trans-0-4 "Send"]
                </div>';
            return $template;

      } else {
        return $template;
      } 
    }
    add_filter( 'wpcf7_default_template', 'winter_contact7_form_content', 10, 2 );

?>