<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Magazine Post Carousel Widget.
 */
class Meta_Store_Blog_Grid2_Widget extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'ms-blog-grid2-widget';
    }

    /** Widget Title */
    public function get_title() {
        return __('Blog Grid 2', 'meta-store-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-posts-grid';
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
                'display_setting', [
            'label' => __('Display Option', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'latest',
            'options' => [
                'latest' => __('Latest Posts', 'meta-store-elements'),
                'specific' => __('Specific Posts', 'meta-store-elements'),
            ]
                ]
        );

        $this->add_control(
                'no_of_posts', [
            'label' => __('No. of Posts', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['no'],
            'range' => [
                'no' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'no',
                'size' => 2,
            ],
            'condition' => [
                'display_setting' => 'latest',
            ],
                ]
        );

        $this->add_control(
                'posts', [
            'label' => __('Choose Posts', 'meta-store-elements'),
            'label_block' => true,
            'description' => __('Drag and Drop to Reorder', 'meta-store-elements'),
            'type' => \Selectize_Control::Selectize,
            'multiple' => true,
            'options' => meta_store_elements_post(),
            'condition' => [
                'display_setting' => 'specific',
            ],
                ]
        );

        $this->add_control(
                'orderby', [
            'label' => __('Order By', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => meta_store_elements_orderby_list(),
            'condition' => [
                'display_setting' => 'latest',
            ],
                ]
        );

        $this->add_control(
                'order', [
            'label' => __('Order', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'ASC',
            'options' => meta_store_elements_order_list(),
            'condition' => [
                'display_setting' => 'latest',
            ],
                ]
        );

        $this->add_control(
                'show_category', [
            'label' => __('Show Category', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'meta-store-elements'),
            'label_off' => __('Hide', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_author', [
            'label' => __('Show Author', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'meta-store-elements'),
            'label_off' => __('Hide', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_date', [
            'label' => __('Show Date', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'meta-store-elements'),
            'label_off' => __('Hide', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_excerpt', [
            'label' => __('Show Excerpt', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'meta-store-elements'),
            'label_off' => __('Hide', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => '',
                ]
        );

        $this->add_control(
                'excerpt_length', [
            'label' => __('Excerpt Length (Letters)', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 50,
            ],
            'condition' => [
                'show_excerpt' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'readmore_text', [
            'label' => __('Readmore Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Read More', 'meta-store-elements'),
            'placeholder' => __('Type your title here', 'meta-store-elements'),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'extra_section', [
            'label' => __('Additional Settings', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_responsive_control(
                'blog_columns', [
            'label' => esc_html__('Blog Columns', 'viral-pro'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 3,
                    'step' => 1
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'blog_spacing', [
            'label' => __('Blog Spacing', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 30,
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 li' => 'padding: 0 calc({{SIZE}}{{UNIT}}/2); margin-bottom:{{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .ms-blog-grid2' => 'margin: 0 calc(-{{SIZE}}{{UNIT}}/2);',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_height', [
            'label' => __('Image Height', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 5,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 360,
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 li .post-image' => 'height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'image_size', [
            'label' => __('Image Size', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'large',
            'options' => meta_store_elements_imagesizes_list(),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_style', [
            'label' => __('Content Box', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_padding', [
            'label' => __('Padding', 'meta-store-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'content_bg_color', [
            'label' => __('Background Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'category_style', [
            'label' => __('Category Text', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'category_bgcolor', [
            'label' => __('Background Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .categories a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'category_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .categories a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'category_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-blog-grid2 .categories a',
                ]
        );

        $this->add_control(
                'category_spacing', [
            'label' => __('Bottom Spacing', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .categories' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'author_style', [
            'label' => __('Author & Date', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'author_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .post-metas' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'author_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-blog-grid2 .post-content .post-metas',
                ]
        );

        $this->add_control(
                'author_spacing', [
            'label' => __('Bottom Spacing', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .post-metas' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => __('Title Text', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .post-title a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_hover_color', [
            'label' => __('Hover Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .post-title a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-blog-grid2 .post-content .post-title',
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
                    'max' => 50,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'excerpt_style', [
            'label' => __('Excerpt', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'excerpt_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-blog-grid2 .post-content .excerpt',
                ]
        );

        $this->add_control(
                'excerpt_spacing', [
            'label' => __('Bottom Spacing', 'meta-store-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'readmore_style', [
            'label' => __('Readmore', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'readmore_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-blog-grid2 .post-content .readmore-btn' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'readmore_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-blog-grid2 .post-content .readmore-btn',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $display_setting = $settings['display_setting'];
        $no_of_posts = isset($settings['no_of_posts']['size']) ? $settings['no_of_posts']['size'] : 2;
        $orderby = isset($settings['orderby']) ? $settings['orderby'] : 'date';
        $order = isset($settings['order']) ? $settings['order'] : 'ASC';
        $posts = isset($settings['posts']) ? $settings['posts'] : array();
        $readmore_text = isset($settings['readmore_text']) ? $settings['readmore_text'] : esc_html('Read More', 'meta-store-elements');
        $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'large';
        $show_category = ( $settings['show_category'] == 'yes' ) ? true : false;
        $show_date = ( $settings['show_date'] == 'yes' ) ? true : false;
        $show_author = ( $settings['show_author'] == 'yes' ) ? true : false;
        $show_excerpt = ( $settings['show_excerpt'] == 'yes' ) ? true : false;

        $args = array();

        if ($display_setting == 'latest') {
            $args['post_type'] = 'post';
            $args['posts_per_page'] = $no_of_posts;
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        } else {
            if (!empty($posts)) {
                $args['post_type'] = 'post';
                $args['post_name__in'] = $posts;
                $args['orderby'] = 'post_name__in';
            }
        }

        $this->add_render_attribute('ms-blog-class', 'class', [
            'ms-blog-grid2',
            'ms-desktop-col-' . $settings['blog_columns']['size'],
            'ms-tablet-col-' . (isset($settings['blog_columns_tablet']['size']) ? $settings['blog_columns_tablet']['size'] : 1),
            'ms-mobile-col-' . (isset($settings['blog_columns_mobile']['size']) ? $settings['blog_columns_mobile']['size'] : 1)
                ]
        );

        $post_query = new WP_Query($args);
        ?>
        <?php if ($post_query->have_posts()) : ?>
            <ul <?php echo $this->get_render_attribute_string('ms-blog-class'); ?>>
                <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                    <?php if (has_post_thumbnail()) : ?>
                        <li>
                            <?php
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
                            ?>
                            <div class="post-image">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(meta_store_elements_get_altofimage(absint(get_post_thumbnail_id()))) ?>" />
                                </a>
                            </div>
                            <div class="post-content">
                                <?php if ($show_category) : ?>
                                    <div class="categories">
                                        <?php echo $this->get_post_categories(); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($show_author || $show_date) : ?>
                                    <div class="post-metas">
                                        <?php if ($show_author) : ?>
                                            <span><?php echo esc_html(get_the_author_meta('nickname')); ?></span>
                                        <?php endif; ?>
                                        <?php if ($show_date) : ?>
                                            <span><?php echo get_the_date(); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <?php if ($show_excerpt) : ?>
                                    <p class="excerpt">
                                        <?php echo esc_html($this->get_excerpt()); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($readmore_text) : ?>
                                    <a href="<?php the_permalink(); ?>" class="readmore-btn"><?php echo esc_html($readmore_text); ?></a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
            <?php
            wp_reset_postdata();
        endif;
        ?>
        <?php
    }

    /** Post Excerpt */
    protected function get_excerpt() {
        $settings = $this->get_settings_for_display();

        $excerpt_length = isset($settings['excerpt_length']['size']) ? $settings['excerpt_length']['size'] : 50;

        return substr(strip_tags(strip_shortcodes(get_the_content())), 0, $excerpt_length) . '...';
    }

    /** Post Categories */
    protected function get_post_categories() {
        $categories = get_the_category();
        $categories_html = '';

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $categories_html .= "<a href='" . esc_url(get_category_link($category->term_id)) . "'>" . esc_html($category->name) . "</a>";
            }
        }

        return $categories_html;
    }

}
