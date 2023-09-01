<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

/**
 * Magazine Post Carousel Widget.
 */
class Meta_Store_Product_Category_Block1_Widget extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'ms-product-category-block1-widget';
    }

    /** Widget Title */
    public function get_title() {
        return __('Product Category Grid 1', 'meta-store-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-inner-section';
    }

    /** Category */
    public function get_categories() {
        return ['meta-store-elements'];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
                'content_section', [
            'label' => __('Content', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'category_1_heading', [
            'label' => __('Category 1', 'meta-store-pro'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'product_category1', [
            'label' => __('Select Category', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 0,
            'options' => meta_store_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
                'category_image1', [
            'label' => __('Upload Image', 'meta-store-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'separator' => 'after',
                ]
        );

        $this->add_control(
                'category_2_heading', [
            'label' => __('Category 2', 'meta-store-pro'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'product_category2', [
            'label' => __('Select Category', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 0,
            'options' => meta_store_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
                'category_image2', [
            'label' => __('Upload Image', 'meta-store-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'separator' => 'after',
                ]
        );

        $this->add_control(
                'category_3_heading', [
            'label' => __('Category 3', 'meta-store-pro'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'product_category3', [
            'label' => __('Select Category', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 0,
            'options' => meta_store_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
                'category_image3', [
            'label' => __('Upload Image', 'meta-store-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'separator' => 'after',
                ]
        );

        $this->add_control(
                'category_4_heading', [
            'label' => __('Category 4', 'meta-store-pro'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'product_category4', [
            'label' => __('Select Category', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 0,
            'options' => meta_store_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
                'category_image4', [
            'label' => __('Upload Image', 'meta-store-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'additional_settings', [
            'label' => __('Additional Settings', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'image_size_label', [
            'label' => __('Image Size', 'meta-store-elements'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumbnail',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'cat_btn_style', [
            'label' => __('Category Button', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'cat_btn_bgcolor', [
            'label' => __('Background', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-product-category-block1 .cat-btn' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'cat_btn_color', [
            'label' => __('Text Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-product-category-block1 .cat-btn' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'cat_btn_color_hov', [
            'label' => __('Color(Hover)', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-product-category-block1 .cat-btn:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'cat_btn_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-product-category-block1 .cat-btn',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $category1 = $settings['product_category1'] ? get_term($settings['product_category1']) : 0;
        $category2 = $settings['product_category2'] ? get_term($settings['product_category2']) : 0;
        $category3 = $settings['product_category3'] ? get_term($settings['product_category3']) : 0;
        $category4 = $settings['product_category4'] ? get_term($settings['product_category4']) : 0;

        if (!$category1 && !$category2 && !$category3 && !$category4) {
            ?>
            <div class="ms-error"><?php echo esc_html__('Select Woocommerce Category', 'meta-store-elements'); ?></div>
            <?php
        } else {
            ?>
            <div class="ms-product-category-block1" id="ms-product-category-block1-<?php echo esc_attr($this->get_id()); ?>" >
                <?php
                if ($category1) {
                    ?>
                    <div class="product-cat product-cat1"><?php $this->get_product_category_content($category1, 'category_image1'); ?></div>
                    <?php
                }
                ?>

                <?php
                if ($category2) {
                    ?>
                    <div class="product-cat product-cat2"><?php $this->get_product_category_content($category2, 'category_image2'); ?></div>
                    <?php
                }
                ?>

                <?php
                if ($category3) {
                    ?>
                    <div class="product-cat product-cat3"><?php $this->get_product_category_content($category3, 'category_image3'); ?></div>
                    <?php
                }
                ?>

                <?php
                if ($category4) {
                    ?>
                    <div class="product-cat product-cat4"><?php $this->get_product_category_content($category4, 'category_image4'); ?></div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }

    /** Procut Category Content */
    protected function get_product_category_content($category, $category_image) {
        $settings = $this->get_settings_for_display();
        $image = $this->get_image_url($category_image);
        if ($image['url']) {
            ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="cat-btn"><?php echo esc_html($category->name); ?></a>
            <?php
        }
    }

    protected function get_image_url($category_image) {
        $settings = $this->get_settings_for_display();

        $image = $settings[$category_image] ? $settings[$category_image] : '';
        $image_size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'large';
        $imggg = array(
            'url' => '',
            'alt' => ''
        );
        if (!empty($image)) {
            if (isset($image['id']) && $image['id']) {
                $img = wp_get_attachment_image_src($image['id'], $image_size);
                if ($img) {
                    $imggg['url'] = $img[0];
                }
                $imggg['alt'] = get_post_meta($image['id'], '_wp_attachment_image_alt', TRUE);
            } else {
                $imggg['url'] = isset($image['url']) ? $image['url'] : '';
                $imggg['alt'] = '';
            }
        }

        return $imggg;
    }

}
