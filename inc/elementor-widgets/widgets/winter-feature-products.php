<?php
namespace Winterelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Winter elementor counter section widget.
 *
 * @since 1.0
 */
class Winter_Feature_Products extends Widget_Base {

	public function get_name() {
		return 'winter-featured-products';
	}

	public function get_title() {
		return __( 'Featured Products', 'winter-companion' );
	}

	public function get_icon() {
		return 'eicon-product-images';
	}

	public function get_categories() {
		return [ 'winter-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  Counter content ------------------------------
		$this->start_controls_section(
			'featured_products',
			[
				'label' => __( 'Featured Products Settings', 'winter-companion' ),
			]
		);
        $this->add_control(
            'feature_items', [
                'label' => __( 'Create New Item', 'winter-companion' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ btn_label }}}',
                'fields' => [
                    [
                        'name'  => 'fet_img',
                        'label' => __( 'Feature Image', 'winter-companion' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'btn_label',
                        'label' => __( 'Button Label', 'winter-companion' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'shop for male', 'winter-companion' )
                    ],
                    [
                        'name'  => 'btn_url',
                        'label' => __( 'Button URL', 'winter-companion' ),
                        'type'  => Controls_Manager::URL,
                        'label_block' => true,
                        'default' => [
                            'url' => '#'
                        ]
                    ]
                ],
                'default' => [
                    [
                        'fet_img'   => Utils::get_placeholder_image_src(),
                        'btn_label' => __( 'shop for male', 'winter-companion' ),
                        'btn_url'   => [
                            'url' => '#'
                        ]
                    ],
                    [
                        'fet_img'   => Utils::get_placeholder_image_src(),
                        'btn_label' => __( 'shop for male', 'winter-companion' ),
                        'btn_url'   => [
                            'url' => '#'
                        ]
                    ],
                    [
                        'fet_img'   => Utils::get_placeholder_image_src(),
                        'btn_label' => __( 'shop for male', 'winter-companion' ),
                        'btn_url'   => [
                            'url' => '#'
                        ]
                    ],
                ]
            ]
        );
		$this->end_controls_section(); // End counter content


        //------------------------------ Style title ------------------------------
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Section Title', 'winter-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_title', [
                'label'  => __( 'Title Color', 'winter-companion' ),
                'type'   => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .newproduct h3.m-text5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'      => 'typography_title',
                'selector'  => '{{WRAPPER}} .newproduct h3.m-text5',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'      => 'text_shadow_title',
                'selector'  => '{{WRAPPER}} .newproduct h3.m-text5',
            ]
        );
        $this->add_control(
            'color_productprice', [
                'label'  => __( 'Product title and price color', 'winter-companion' ),
                'type'   => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .newproduct .block2 .s-text3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .newproduct .block2 .m-text6' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_producttitlehov', [
                'label'  => __( 'Product title hover color', 'winter-companion' ),
                'type'   => Controls_Manager::COLOR,
                'default' => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .newproduct .block2 .s-text3:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings();
        $feature_items = !empty( $settings['feature_items'] ) ? $settings['feature_items'] : '';
    ?>

    <!-- feature_part start-->
    <section class="feature_part pt-4">
        <div class="container-fluid p-lg-0 overflow-hidden">
            <div class="row align-items-center justify-content-between">
                <?php
                if( is_array( $feature_items ) && count( $feature_items ) > 0 ){
                    $count = 0;
                    foreach ( $feature_items as $feature ) {
                        $btn_label = !empty( $feature['btn_label'] ) ? esc_html($feature['btn_label']) : '';
                        $feature_img = !empty( $feature['fet_img']['id'] ) ? wp_get_attachment_image($feature['fet_img']['id'], 'winter_featured_img_thumb_630x700', false, ['alt' => $btn_label.' image']) : '';
                        $btn_url = !empty( $feature['btn_url']['url'] ) ? esc_url($feature['btn_url']['url']) : '';
                        ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_feature_post_text">
                                <?php
                                    if ( $feature_img ) {
                                        echo $feature_img;
                                    }
                                    if ( $btn_label ) {
                                        echo "<div class='hover_text'><a href='{$btn_url}' class='btn_2'>{$btn_label}</a></div>";
                                    }
                                
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <?php
    }
}