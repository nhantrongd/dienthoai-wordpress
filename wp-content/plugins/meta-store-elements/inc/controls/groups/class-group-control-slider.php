<?php
namespace MSEP\Controls\Groups;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Group_Control_Carousel extends Group_Control_Base {

    protected static $fields;

    public static function get_type() {
        return 'msep-carousel';
    }

    protected function init_fields() {
        $fields = [];

        $fields['autoplay-speed'] = [
            'label' => __( 'Autoplay Speed (In Seconds)', 'meta-store-elements-pro' ),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 10,
            'step' => 0.1,
            'default' => 2,
        ];

        $fields['nav-speed'] = [
            'label' => __( 'Navigation Speed (In Seconds)', 'meta-store-elements-pro' ),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 10,
            'step' => 0.1,
            'default' => 2,
        ];
        
        $fields['hr'] = [
            'type' => Controls_Manager::DIVIDER,
        ];

        $fields['loop'] = [
            'label' => __( 'Loop', 'meta-store-elements-pro' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'meta-store-elements-pro' ),
            'label_off' => __( 'No', 'meta-store-elements-pro' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ];

        $fields['nav'] = [
            'label' => __( 'Arrow', 'meta-store-elements-pro' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'meta-store-elements-pro' ),
            'label_off' => __( 'No', 'meta-store-elements-pro' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ];

        $fields['dots'] = [
            'label' => __( 'Dots', 'meta-store-elements-pro' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'meta-store-elements-pro' ),
            'label_off' => __( 'No', 'meta-store-elements-pro' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ];

        $fields['autoplay'] = [
            'label' => __( 'Autoplay', 'meta-store-elements-pro' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'meta-store-elements-pro' ),
            'label_off' => __( 'No', 'meta-store-elements-pro' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ];

        return $fields;
    }

    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }

}
