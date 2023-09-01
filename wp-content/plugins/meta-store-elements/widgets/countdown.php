<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Meta_Store_Countdown_Widget extends Widget_Base {

    /** Widget Name * */
    public function get_name() {
        return 'ms-countdown';
    }

    /** Widget Title * */
    public function get_title() {
        return esc_html__('Countdown', 'meta-store-elements');
    }

    /** Widget Icon * */
    public function get_icon() {
        return 'eicon-countdown';
    }

    /** Categories * */
    public function get_categories() {
        return ['meta-store-elements'];
    }

    /** Widget Controls * */
    protected function register_controls() {

        $this->start_controls_section(
                'countdown_content_section', [
            'label' => __('Countdown', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'layout', [
            'label' => __('Layout', 'meta-store-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'calender',
            'options' => [
                'calender' => __('Calender', 'meta-store-elements'),
                'boxer' => __('Boxer', 'meta-store-elements'),
                'circle' => __('Circular', 'meta-store-elements'),
                'simple' => __('Simple', 'meta-store-elements'),
            ],
                ]
        );

        $this->add_control(
                'countdown_date', [
            'label' => __('Countdown Date', 'meta-store-elements'),
            'type' => Controls_Manager::DATE_TIME,
            'placeholder' => '2020-11-21 12:00'
                ]
        );

        $this->add_control(
                'countdown_align', [
            'label' => __('Alignment', 'meta-store-elements'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => __('Left', 'meta-store-elements'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'meta-store-elements'),
                    'icon' => 'eicon-text-align-center',
                ],
                'flex-end' => [
                    'title' => __('Right', 'meta-store-elements'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .ms-countdown' => 'justify-content: {{VALUE}}'
            ]
                ]
        );

        $this->add_control(
                'complete_msg', [
            'label' => __('Completion Message', 'meta-store-elements'),
            'description' => __('Message to display after countdown complettion', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Sale Offer Expired', 'meta-store-elements'),
            'separator' => 'before'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'countdown_additional_settings', [
            'label' => __('Countdown', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'show_year', [
            'label' => __('Show Year', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'no',
                ]
        );

        $this->add_control(
                'year_text', [
            'label' => __('Year Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Years', 'meta-store-elements'),
            'condition' => [
                'show_year' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'show_month', [
            'label' => __('Show Month', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'no',
                ]
        );

        $this->add_control(
                'month_text', [
            'label' => __('Month Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Months', 'meta-store-elements'),
            'condition' => [
                'show_month' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'show_week', [
            'label' => __('Show Week', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'no',
                ]
        );

        $this->add_control(
                'week_text', [
            'label' => __('Week Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Weeks', 'meta-store-elements'),
            'condition' => [
                'show_week' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'show_day', [
            'label' => __('Show Day', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'day_text', [
            'label' => __('Day Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Days', 'meta-store-elements'),
            'condition' => [
                'show_day' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'show_hours', [
            'label' => __('Show Hour', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'hour_text', [
            'label' => __('Hour Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Hours', 'meta-store-elements'),
            'condition' => [
                'show_hours' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'show_minutes', [
            'label' => __('Show Minutes', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'minute_text', [
            'label' => __('Minute Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Minutes', 'meta-store-elements'),
            'condition' => [
                'show_minutes' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'show_seconds', [
            'label' => __('Show Seconds', 'meta-store-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'meta-store-elements'),
            'label_off' => __('No', 'meta-store-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'second_text', [
            'label' => __('Seconds Text', 'meta-store-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Seconds', 'meta-store-elements'),
            'condition' => [
                'show_seconds' => 'yes'
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'label_style', [
            'label' => __('Label', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'label_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-countdown ul li .label' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'label_bgcolor', [
            'label' => __('Background Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-countdown ul li .label' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'layout!' => ['simple', 'circle']
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'label_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-countdown ul li .label',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'counter_style', [
            'label' => __('Counter', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'counter_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-countdown ul li .value' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_control(
                'counter_bgcolor', [
            'label' => __('Background Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-countdown ul li .value' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .ms-countdown.circle ul li .value:before' => 'border-color: {{VALUE}}'
            ],
            'condition' => [
                'layout!' => 'simple'
            ]
                ]
        );

        $this->add_control(
                'counter_bordercolor', [
            'label' => __('Border Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-countdown.calender ul li, {{WRAPPER}} .ms-countdown.boxer ul li, {{WRAPPER}} .ms-countdown.circle ul li .value' => 'border: 1px solid {{VALUE}}',
            ],
            'condition' => [
                'layout!' => 'simple'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'counter_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-countdown ul li .value',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'completion_msg_styles', [
            'label' => __('Completion Message', 'meta-store-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'completion_color', [
            'label' => __('Color', 'meta-store-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ms-countdown.complete' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'completion_typography',
            'label' => __('Typography', 'meta-store-elements'),
            'selector' => '{{WRAPPER}} .ms-countdown.complete',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout * */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $countdown_date = $settings['countdown_date'] ? $settings['countdown_date'] : '';
        $layout = $settings['layout'] ? $settings['layout'] : 'calender';
        $show_year = $settings['show_year'] == 'yes' ? true : false;
        $show_month = $settings['show_month'] == 'yes' ? true : false;
        $show_week = $settings['show_week'] == 'yes' ? true : false;
        $show_day = $settings['show_day'] == 'yes' ? true : false;
        $show_hours = $settings['show_hours'] == 'yes' ? true : false;
        $show_minutes = $settings['show_minutes'] == 'yes' ? true : false;
        $show_seconds = $settings['show_seconds'] == 'yes' ? true : false;

        $year_text = $settings['year_text'] ? $settings['year_text'] : esc_html__('Years', 'meta-store-elements');
        $month_text = $settings['month_text'] ? $settings['month_text'] : esc_html__('Months', 'meta-store-elements');
        $week_text = $settings['week_text'] ? $settings['week_text'] : esc_html__('Weeks', 'meta-store-elements');
        $day_text = $settings['day_text'] ? $settings['day_text'] : esc_html__('Days', 'meta-store-elements');
        $hour_text = $settings['hour_text'] ? $settings['hour_text'] : esc_html__('Hours', 'meta-store-elements');
        $minute_text = $settings['minute_text'] ? $settings['minute_text'] : esc_html__('Minutes', 'meta-store-elements');
        $second_text = $settings['second_text'] ? $settings['second_text'] : esc_html__('Seconds', 'meta-store-elements');
        $complete_msg = $settings['complete_msg'];

        $countdown_data = json_encode(array(
            'date' => $countdown_date,
            'layout' => esc_attr($layout),
            'complete_msg' => esc_html($complete_msg),
            'text' => array(
                'show_year' => $show_year,
                'show_month' => $show_month,
                'show_week' => $show_week,
                'show_day' => $show_day,
                'show_hours' => $show_hours,
                'show_minutes' => $show_minutes,
                'show_seconds' => $show_seconds,
                'year' => $year_text,
                'month' => $month_text,
                'week' => $week_text,
                'day' => $day_text,
                'hour' => $hour_text,
                'minute' => $minute_text,
                'second' => $second_text
            )
        ));
        if (!$countdown_date) {
            ?>
            <div class="ms-error"><?php esc_html_e('Set the valid countdown date', 'meta-store-elements'); ?></div>
            <?php
        }
        ?>
        <div
            class="ms-countdown <?php echo esc_attr($layout); ?>"
            id="ms-countdown-<?php echo esc_attr($this->get_id()); ?>"
            data-countdown="<?php echo esc_attr($countdown_data); ?>"
            ></div>
        <?php
    }

}
