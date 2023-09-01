<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Border;

/**
 * Meta Store Slider Widget.
 */
class Meta_Store_Slider_Widget extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'ms-slider-widget';
    }

    /** Widget Title */
    public function get_title() {
        return __('Slider', 'meta-store-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-slider-full-screen';
    }

    /** Category */
    public function get_categories() {
        return ['meta-store-elements'];
    }

    /** Dependencies */
    public function get_script_depends() {
        return ['owl-carousel'];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
                'content', [
            'label' => __('Slider', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'image', [
            'label' => __('Choose Image', 'meta-store-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'subtitle', [
            'label' => __('Sub Title', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Slider Sub Title', 'meta-store-elements'),
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'title', [
            'label' => __('Title', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Slider Title', 'meta-store-elements'),
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'content', [
            'label' => __('Description', 'meta-store-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => __('Donec pharetra malesuada leo. Aliquam risus lorem, volutpat eu interdum in', 'meta-store-elements'),
            'placeholder' => __('Type your description here', 'meta-store-elements'),
                ]
        );

        $repeater->add_control(
                'btn_text', [
            'label' => __('Button Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Read More', 'meta-store-elements'),
            'placeholder' => __('Set Button Label text.', 'meta-store-elements'),
            'label_block' => true
                ]
        );

        $repeater->add_control(
                'btn_link', [
            'label' => __('Link', 'meta-store-elements'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('https://your-link.com', 'meta-store-elements'),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
                ]
        );

        $this->add_control(
                'slides', [
            'label' => __('Slides', 'meta-store-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'subtitle' => __('Slider Sub Title 1', 'meta-store-elements'),
                    'title' => __('Slider Title 1', 'meta-store-elements'),
                    'content' => __('Donec pharetra malesuada leo. Aliquam risus lorem, volutpat eu interdum in', 'meta-store-elements'),
                ],
                [
                    'subtitle' => __('Slider Sub Title 2', 'meta-store-elements'),
                    'title' => __('Slider Title 2', 'meta-store-elements'),
                    'content' => __('Donec pharetra malesuada leo. Aliquam risus lorem, volutpat eu interdum in', 'meta-store-elements'),
                ],
            ],
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'slider_settings_section', [
            'label' => __('Slider Settings', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'slide_height', [
            'label' => __('Slide Height ', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'auto',
            'options' => [
                'auto' => __('Auto', 'meta-store-elements'),
                'full' => __('Full', 'meta-store-elements'),
                'custom' => __('Custom', 'meta-store-elements')
            ]
                ]
        );

        $this->add_responsive_control(
                'custom_slide_height', [
            'label' => __('Height', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'condition' => [
                'slide_height' => 'custom',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 550,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 450,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 420,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider.ms-slider-height-custom .ms-slide' => 'height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => esc_html__('Autoplay', 'viral-pro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'viral-pro'),
            'label_off' => esc_html__('No', 'viral-pro'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_duration', [
            'label' => esc_html__('Pause Duration(Sec)', 'viral-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 's',
                'size' => 5,
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_responsive_control(
                'slides_margin', [
            'label' => esc_html__('Spacing Between Slides', 'viral-pro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'nav', [
            'label' => esc_html__('Nav Arrow', 'viral-pro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'viral-pro'),
            'label_off' => esc_html__('Hide', 'viral-pro'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'dots', [
            'label' => esc_html__('Nav Dots', 'viral-pro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'viral-pro'),
            'label_off' => esc_html__('Hide', 'viral-pro'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'slide_style', [
            'label' => __('General', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'image_styles_heading', [
            'label' => __('Slider Image', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'slider_image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->add_control(
                'slide_img_position', [
            'label' => __('Image Position', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'center center',
            'options' => [
                'top left' => __('Top Left', 'meta-store-elements'),
                'top center' => __('Top Center', 'meta-store-elements'),
                'top right' => __('Top Right', 'meta-store-elements'),
                'center left' => __('Center Left', 'meta-store-elements'),
                'center center' => __('Center Center', 'meta-store-elements'),
                'center right' => __('Center Right', 'meta-store-elements'),
                'bottom left' => __('Bottom Left', 'meta-store-elements'),
                'bottom center' => __('Bottom Center', 'meta-store-elements'),
                'bottom right' => __('Bottom Right', 'meta-store-elements'),
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider.ms-slider-height-full .ms-slide .ms-img-wrap img,{{WRAPPER}} .ms-slider.ms-slider-height-custom .ms-slide .ms-img-wrap img' => 'object-position: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'overlay_styles_heading', [
            'label' => __('Overlay', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'enable_overlay', [
            'label' => __('Enable Overlay', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'overlay_color', [
            'label' => __('Overlay Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider.ms-enable-overlay .ms-slide:before' => 'background: {{VALUE}}',
            ],
            'default' => 'rgba(0,0,0,0.3)',
            'condition' => [
                'enable_overlay' => 'yes'
            ],
            'separator' => 'after',
                ]
        );

        $this->add_control(
                'caption_styles_heading', [
            'label' => __('Caption', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
                ]
        );

        $this->add_responsive_control(
                'caption_width', [
            'label' => __('Caption Width', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1200,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 490,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 80,
                'unit' => '%',
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide .ms-slide-content' => 'width: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'caption_vertical_postion', [
            'label' => __('Caption Vertical Position', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'middle',
            'label_block' => true,
            'options' => [
                'top' => __('Top', 'meta-store-elements'),
                'middle' => __('Middle', 'meta-store-elements'),
                'bottom' => __('Bottom', 'meta-store-elements')
            ],
                ]
        );

        $this->add_control(
                'caption_horizontal_postion', [
            'label' => __('Caption Horizontal Position', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'center',
            'label_block' => true,
            'options' => [
                'left' => __('Left', 'meta-store-elements'),
                'center' => __('Center', 'meta-store-elements'),
                'right' => __('Right', 'meta-store-elements')
            ],
                ]
        );

        $this->add_control(
                'caption_text_align', [
            'label' => __('Caption Text Alignment', 'meta-store-elements'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'meta-store-elements'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'meta-store-elements'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'meta-store-elements'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide .ms-slide-content' => 'text-align: {{VALUE}};',
            ],
                ]
        );

        $this->add_control(
                'caption_position', [
            'label' => __('Caption Offset', 'meta-store-elements'),
            'description' => __('Move caption horizontally and vertically from current position', 'meta-store-elements'),
            'type' => Controls_Manager::POPOVER_TOGGLE,
            'label_off' => __('None', 'meta-store-elements'),
            'label_on' => __('Custom', 'meta-store-elements'),
            'return_value' => 'yes',
                ]
        );

        $this->start_popover();

        $this->add_responsive_control(
                'caption_offset_y', [
            'label' => __('Vertical', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 200,
                    'step' => 1
                ],
            ],
            'default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide .ms-slide-content' => 'transform: translate({{caption_offset_x.SIZE}}{{caption_offset_x.UNIT}}, {{SIZE}}{{UNIT}});',
            ],
            'condition' => [
                'caption_position' => 'yes',
            ]
                ]
        );

        $this->add_responsive_control(
                'caption_offset_x', [
            'label' => __('Horizontal', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 200,
                    'step' => 1
                ],
            ],
            'default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide .ms-slide-content' => 'transform: translate({{SIZE}}{{caption_offset_x.UNIT}}, {{caption_offset_y.SIZE}}{{UNIT}});'
            ],
            'condition' => [
                'caption_position' => 'yes',
            ]
                ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section(
                'caption_content_styles', [
            'label' => __('Caption Content', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'slide_subtitle_heading', [
            'label' => __('SubTitle', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'subtitle_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-subtitle' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'subtitle_spacing', [
            'label' => __('Bottom Spacing', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 150,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'subtitle_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-subtitle',
                ]
        );

        $this->add_control(
                'slide_title_heading', [
            'label' => __('Title', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-title',
                ]
        );

        $this->add_control(
                'title_spacing', [
            'label' => __('Bottom Spacing', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 150,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'slide_content_heading', [
            'label' => __('Content', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-description' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-description',
                ]
        );

        $this->add_control(
                'content_spacing', [
            'label' => __('Bottom Spacing', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 150,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'readmore_style', [
            'label' => __('Read More', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'readmore_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn',
                ]
        );

        $this->add_control(
                'readmore_padding', [
            'label' => __('Padding', 'meta-store-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'separator' => 'after',
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'readmore_border',
            'label' => __('Border', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn',
                ]
        );

        $this->add_control(
                'readmore_border_radius', [
            'label' => __('Border Radius', 'meta-store-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ]
                ]
        );

        $this->add_control(
                'readmore_heading', [
            'label' => __('Button Hover', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
                ]
        );

        $this->start_controls_tabs(
                'readmore_style_tabs'
        );

        $this->start_controls_tab(
                'readmore_normal_tab', [
            'label' => __('Normal', 'meta-store-elements-pro'),
                ]
        );

        $this->add_control(
                'readmore_bgcolor', [
            'label' => __('Background Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'readmore_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'readmore_hover_tab', [
            'label' => __('Hover/Active', 'meta-store-elements-pro'),
                ]
        );

        $this->add_control(
                'readmore_bgcolor_hover', [
            'label' => __('Background Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'readmore_color_hover', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .ms-slide-content .ms-slide-btn:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'slider_styles', [
            'label' => __('Slider Navigation', 'meta-store-elements-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'arrow_styles_heading', [
            'label' => __('Arrow', 'meta-store-elements-pro'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'arrow_button_size', [
            'label' => __('Button Size', 'meta-store-elements-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 40,
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-prev, {{WRAPPER}} .ms-slider .owl-nav button.owl-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'arrow_size', [
            'label' => __('Icon Size', 'meta-store-elements-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 24,
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-prev i, {{WRAPPER}} .ms-slider .owl-nav button.owl-next i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'arrow_offset_horizontal', [
            'label' => __('Arrow Offset (Horizontal)', 'meta-store-elements-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'arrow_style_tabs'
        );

        $this->start_controls_tab(
                'arrow_normal_tab', [
            'label' => __('Normal', 'meta-store-elements-pro'),
                ]
        );

        $this->add_control(
                'arrow_bg_normal_color', [
            'label' => __('Background Color', 'meta-store-elements-pro'),
            'type' => Controls_Manager::COLOR,
            'alpha' => true,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-prev,{{WRAPPER}} .ms-slider .owl-nav button.owl-next' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_normal_color', [
            'label' => __('Color', 'meta-store-elements-pro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-prev,{{WRAPPER}} .ms-slider .owl-nav button.owl-next' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'arrow_hover_tab', [
            'label' => __('Hover/Active', 'meta-store-elements-pro'),
                ]
        );

        $this->add_control(
                'arrow_bg_hover_color', [
            'label' => __('Background Color', 'meta-store-elements-pro'),
            'type' => Controls_Manager::COLOR,
            'alpha' => true,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-prev:hover,{{WRAPPER}} .ms-slider .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_hover_color', [
            'label' => __('Color', 'meta-store-elements-pro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-nav button.owl-prev:hover,{{WRAPPER}} .ms-slider .owl-nav button.owl-next:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
                'dots_styles_heading', [
            'label' => __('Dots', 'meta-store-elements-pro'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'after',
                ]
        );

        $this->add_control(
                'dots_bottom_offset', [
            'label' => __('Bottom Offset', 'meta-store-elements-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 40,
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'dots_size', [
            'label' => __('Size', 'meta-store-elements-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 30,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 16,
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-dots button.owl-dot' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'dots_style_tabs'
        );

        $this->start_controls_tab(
                'dots_normal_tab', [
            'label' => __('Normal', 'meta-store-elements-pro'),
                ]
        );

        $this->add_control(
                'dot_border_color_normal', [
            'label' => __('Normal Color', 'meta-store-elements-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => '#DDD',
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-dots button.owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'dots_hover_tab', [
            'label' => __('Active', 'meta-store-elements-pro'),
                ]
        );

        $this->add_control(
                'dot_border_color_hover', [
            'label' => __('Hover/Active color', 'meta-store-elements-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .ms-slider .owl-dots button.owl-dot:hover, {{WRAPPER}} .ms-slider .owl-dots button.owl-dot.active' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $slides = isset($settings['slides']) ? $settings['slides'] : array();
        $overlay = $settings['enable_overlay'] ? 'ms-enable-overlay' : '';
        $image_size = isset($settings['slider_image_size']) ? $settings['slider_image_size'] : 'large';
        $slide_height = isset($settings['slide_height']) && !is_array($settings['slide_height']) ? 'ms-slider-height-' . $settings['slide_height'] : 'ms-slider-height-auto';
        $caption_vertical_postion = 'ms-vertical-' . $settings['caption_vertical_postion'];
        $caption_horizontal_postion = 'ms-horizontal-' . $settings['caption_horizontal_postion'];
        $slider_class = array(
            'owl-carousel',
            'ms-slider',
            $slide_height,
            $overlay,
            $caption_vertical_postion,
            $caption_horizontal_postion
        );

        if (!empty($slides)) :
            ?>
            <div
                class="<?php echo esc_attr(implode(' ', $slider_class)); ?>"
                id="ms-slider-<?php echo esc_attr($this->get_id()) ?>"
                data-slider="<?php echo esc_attr($this->get_slider_datas()); ?>"
                >
                    <?php foreach ($slides as $slide) : ?>
                        <?php if (isset($slide['image']['url'])) : ?>
                            <?php
                            $image_url = $slide['image']['url'];
                            if ($slide['image']['id']) {
                                $image = wp_get_attachment_image_src($slide['image']['id'], $image_size);
                                $image_url = $image[0];
                            }
                            ?>
                        <div class="ms-slide">
                            <div class="ms-img-wrap">
                                <img src="<?php echo esc_url($image_url); ?>" />
                            </div>

                            <div class="ms-slide-content-wrap">
                                <div class="ms-slide-content">
                                    <?php if ($slide['subtitle']) : ?>
                                        <span class="ms-slide-subtitle"><?php echo esc_html($slide['subtitle']); ?></span>
                                    <?php endif; ?>

                                    <?php if ($slide['title']) : ?>
                                        <span class="ms-slide-title">
                                            <?php
                                            echo wp_kses($slide['title'], array(
                                                'strong' => array(),
                                                'br' => array()
                                            ));
                                            ?>
                                        </span>
                                    <?php endif; ?>

                                    <p class="ms-slide-description"><?php echo wp_kses($slide['content'], array('br' => array())); ?></p>

                                    <?php if ($slide['btn_text'] && $slide['btn_link']['url']) : ?>
                                        <a class="ms-slide-btn" href="<?php echo esc_url($slide['btn_link']['url']); ?>"><?php echo esc_html($slide['btn_text']); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php
        endif;
    }

    /** Slider Datas * */
    protected function get_slider_datas() {
        $settings = $this->get_settings_for_display();
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $settings['pause_duration']['size'] * 1000,
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) (isset($settings['slides_margin_tablet']['size']) ? $settings['slides_margin_tablet']['size'] : 0),
            'margin_mobile' => (int) (isset($settings['slides_margin_mobile']['size']) ? $settings['slides_margin_mobile']['size'] : 0),
            'nav' => $settings['nav'] == 'yes' ? true : false,
            'dots' => $settings['dots'] == 'yes' ? true : false
        );
        $params = json_encode($params);

        return $params;
    }

}
