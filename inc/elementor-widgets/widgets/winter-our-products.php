<?php
namespace Winterelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 *
 * Winter elementor our product section widget.
 *
 * @since 1.0
 */
class Winter_Our_Products extends Widget_Base {

    public function get_name() {
        return 'winter-ourproduct';
    }

    public function get_title() {
        return __( 'Our Product', 'winter-companion' );
    }

    public function get_icon() {
        return 'eicon-product-tabs';
    }

    public function get_categories() {
        return [ 'winter-elements' ];
    }

    protected function _register_controls() {

        $repeater = new \Elementor\Repeater();

        // ----------------------------------------  Our Product content ------------------------------
        $this->start_controls_section(
            'ourproduct_content',
            [
                'label' => __( 'Our Product', 'winter-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'winter-companion' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'New Arrival', 'winter-companion' ),
            ]
        );
        $this->add_control(
            'product_limit',
            [
                'label' => esc_html__( 'Product Limit', 'winter-companion' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6
            ]
        );
        $this->add_control(
            'product_cats',
            [
                'label' => esc_html__( 'Select Categories', 'winter-companion' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['tshirts', 'hoodies', 'music'],
                'options' => winter_product_cat()
            ]
        );

        $this->end_controls_section(); // End Features content

    /**
     * Style Tab
     * ------------------------------ Style section title ------------------------------
     *
     */
        $this->start_controls_section(
            'style_sectiontitle', [
                'label' => __( 'Style Section Title', 'winter-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Title Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .sec-title .m-text5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .sec-title .m-text5',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '{{WRAPPER}} .sec-title .m-text5',
            ]
        );
        $this->end_controls_section();

    /**
     * Style Tab
     * ------------------------------ Style Filter ------------------------------
     *
     */
        $this->start_controls_section(
            'style_filter', [
                'label' => __( 'Style Filter', 'winter-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_filter', [
                'label' => __( 'Filter Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .tab01 .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_filterhov', [
                'label' => __( 'Filter Hover Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .tab01 .nav-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_filter',
                'selector' => '{{WRAPPER}} .tab01 .nav-link',
            ]
        );

        $this->end_controls_section();



    }

    protected function render() {

    $settings       = $this->get_settings();
    $sec_title      = !empty( $settings['sec_title'] ) ? esc_html($settings['sec_title']) : '';
    $product_limit  = !empty( $settings['product_limit'] ) ? $settings['product_limit'] : '';
    $product_cats   = !empty( $settings['product_cats'] ) ? $settings['product_cats'] : ''; 
    ?>

    <!-- new arrival part here -->
    <section class="new_arrival section_padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="arrival_tittle">
                        <?php
                            if ( $sec_title ) {
                                echo "<h2>{$sec_title}</h2>";
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="arrival_filter_item filters text-right">
                        <ul>
                            <li class="active controls" data-filter="*">all</li>
                            <?php
                                foreach( $product_cats as $product_cat_slug ) {
                                    $product_cat_name = get_term_by( 'slug', $product_cat_slug, 'product_cat' );
                                    echo "<li class='controls' data-toggle='.{$product_cat_slug}'>{$product_cat_name->name}</li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="new_arrival_iner filter-container">
                        <?php winter_new_arrival_products( $product_cats, $product_limit )?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- new arrival part end here -->

    <?php

    }
    
}
