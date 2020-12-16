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
 * Winter elementor slider section widget.
 *
 * @since 1.0
 */
class Winter_Slider extends Widget_Base {

	public function get_name() {
		return 'winter-slider';
	}

	public function get_title() {
		return __( 'Hero Section', 'winter-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'winter-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'slider_content',
			[
				'label' => __( 'Hero content', 'winter-companion' ),
			]
		);
        $this->add_control(
            'hero_img',
            [
                'label' => __( 'Hero Image', 'winter-companion' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label'         => esc_html__( 'Sub Title', 'winter-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'Winter Fashion', 'winter-companion' )
            ]
        );
        $this->add_control(
            'big_title',
            [
                'label'         => esc_html__( 'Big Title', 'winter-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'Fashion Collection 2020', 'winter-companion' )
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label'         => esc_html__( 'Button Label', 'winter-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'Shop Now', 'winter-companion' )
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label'         => esc_html__( 'Button URL', 'winter-companion' ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'       => '#'
                ]
            ]
        );
		$this->end_controls_section(); // End slider content

        //------------------------------ Style title  ------------------------------
        $this->start_controls_section(
            'style_titletwo', [
                'label' => __( 'Style Title ', 'winter-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_titletwo', [
                'label' => __( 'Title Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .caption2-slide1.xl-text1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .caption2-slide1.xl-text1.bo14' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_titletwo',
                'selector' => '{{WRAPPER}} .caption2-slide1.xl-text1',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_titletwo',
                'selector' => '{{WRAPPER}} .caption2-slide1.xl-text1',
            ]
        );
        $this->end_controls_section();

        /**
         * Style Tab
         * ------------------------------ Style Sub Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Sub Title', 'winter-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Sub Title Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .caption1-slide1.m-text1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .caption1-slide1.m-text1',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '{{WRAPPER}} .caption1-slide1.m-text1',
            ]
        );
        $this->end_controls_section();

        //------------------------------ Style Button ------------------------------
        $this->start_controls_section(
            'style_btn', [
                'label' => __( 'Style Button', 'winter-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_btntext', [
                'label' => __( 'Button Text Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnhovtext', [
                'label' => __( 'Button Hover Text Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnbg', [
                'label' => __( 'Button background Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnhovbg', [
                'label' => __( 'Button Hover background Color', 'winter-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_btn',
                'selector' => '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1',
            ]
        );

        $this->end_controls_section();


	}



	protected function render() {
        $settings   = $this->get_settings();
        $hero_img   = !empty( $settings['hero_img']['url'] ) ? $settings['hero_img']['url'] : '';        
        $sub_title  = !empty( $settings['sub_title'] ) ? esc_html($settings['sub_title']) : '';        
        $big_title  = !empty( $settings['big_title'] ) ? esc_html($settings['big_title']) : '';        
        $btn_label  = !empty( $settings['btn_label'] ) ? esc_html($settings['btn_label']) : '';        
        $btn_url    = !empty( $settings['btn_url']['url'] ) ? esc_url($settings['btn_url']['url']) : '';        
        ?>


    <!-- banner part start-->
    <section class="banner_part" <?php echo winter_inline_bg_img( esc_url( $hero_img ) ); ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="banner_slider">
                        <div class="single_banner_slider">
                            <div class="banner_text">
                                <div class="banner_text_iner">
                                    <?php
                                        if ( $sub_title ) {
                                            echo "<h5>{$sub_title}</h5>";
                                        }
                                        if ( $big_title ) {
                                            echo "<h1>{$big_title}</h1>";
                                        }
                                        if ( $btn_label ) {
                                            echo "<a href='{$btn_url}' class='btn_1'>{$btn_label}</a>";
                                        }
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <?php
    }
	
}
