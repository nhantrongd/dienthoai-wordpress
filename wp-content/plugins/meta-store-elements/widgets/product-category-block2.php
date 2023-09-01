<?php

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

/**
 * Magazine Post Carousel Widget.
 */
class Meta_Store_Product_Category_Block2_Widget extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'ms-product-category-block2-widget';
    }

    /** Widget Title */
    public function get_title() {
        return __('Product Category Grid 2', 'meta-store-elements');
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
            'separator' => 'after',
                ]
        );

        $this->add_control(
                'category_5_heading', [
            'label' => __('Category 5', 'meta-store-pro'),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'product_category5', [
            'label' => __('Select Category', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 0,
            'options' => meta_store_elements_get_woo_categories_list(),
                ]
        );
        $this->add_control(
                'category_image5', [
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
            'alpha' => true,
            'selectors' => [
                '{{WRAPPER}} .ms-product-category-block2.overlay .product-cat:before' => 'background: {{VALUE}}',
            ],
            'condition' => [
                'enable_overlay' => 'yes'
            ],
            'separator' => 'after',
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
                'cat_text_style', [
            'label' => __('Category Text', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'cat_text_color', [
            'label' => __('Text Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-product-category-block2 .cat-btn .ct-name' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'cat_text_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-product-category-block2 .cat-btn .ct-name',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'product_count_style', [
            'label' => __('Product Count', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'product_count_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-product-category-block2 .cat-btn .ct-pcount' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'product_count_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-product-category-block2 .cat-btn .ct-pcount',
                ]
        );

        $this->add_control(
                'product_count_margin', [
            'label' => __('Margin', 'meta-store-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'allowed_dimensions' => 'vertical',
            'selectors' => [
                '{{WRAPPER}} .ms-product-category-block2 .cat-btn .ct-pcount' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
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
        $category5 = $settings['product_category5'] ? get_term($settings['product_category5']) : 0;

        $enable_overlay = $settings['product_category5'] ? true : false;
        $overlay_class = '';
        if ($enable_overlay) {
            $overlay_class = 'overlay';
        }

        if (!$category1 && !$category2 && !$category3 && !$category4 && !$category5) {
            ?>
            <div class="ms-error"><?php echo esc_html__('Select Woocommerce Category', 'meta-store-elements'); ?></div>
            <?php
        } else {
            ?>
            <div class="ms-product-category-block2 <?php echo esc_attr($overlay_class); ?>" id="ms-product-category-block2-<?php echo esc_attr($this->get_id()); ?>" >
                <?php if ($category1) : ?>
                    <div class="product-cat product-cat1">
                        <?php $this->get_product_category_content($category1, 'category_image1'); ?>
                    </div>
                <?php endif; ?>


                <?php if ($category2) : ?>
                    <div class="product-cat product-cat2">
                        <?php $this->get_product_category_content($category2, 'category_image2'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($category3) : ?>
                    <div class="product-cat product-cat3">
                        <?php $this->get_product_category_content($category3, 'category_image3'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($category4) : ?>
                    <div class="product-cat product-cat4">
                        <?php $this->get_product_category_content($category4, 'category_image4'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($category5) : ?>
                    <div class="product-cat product-cat5">
                        <?php $this->get_product_category_content($category5, 'category_image5'); ?>
                    </div>
                <?php endif; ?>

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
            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="cat-btn">
                <span class="ct-name" ><?php echo esc_html($category->name); ?></span>
                <span class="ct-pcount"><?php echo esc_html($category->count); ?> <?php echo esc_html__('Products', 'meta-store-elements'); ?></span>
            </a>
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
