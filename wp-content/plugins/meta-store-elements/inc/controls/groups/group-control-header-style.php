<?php
    use Elementor\Controls_Manager;
    use Elementor\Group_Control_Base;

    if (!defined('ABSPATH'))
        exit;

    class Group_Control_Header_Style extends Group_Control_Base {

        protected static $fields;

        public static function get_type() {
            return 'meta-store-header-style';
        }

        protected function init_fields() {
            $fields = [];

            // $fields['color'] = [
            //     'label' => __('Color', 'meta-store-elements'),
            //     'type' => Controls_Manager::TEXT,
            // ];

            $fields['header_color'] = [
                'label' => __( 'Color', 'meta-store-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-header, {{WRAPPER}} .ms-header a' => 'color: {{VALUE}}',
                ],
            ];

            $fields['header_margin'] = [
                'label' => __( 'Margin', 'meta-store-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'allowed_dimensions' => 'vertical',
                'selectors' => [
                    '{{WRAPPER}} .ms-header' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ];

            return $fields;
        }

        protected function get_default_options() {
            return [
                'popover' => false,
            ];
        }

    }
