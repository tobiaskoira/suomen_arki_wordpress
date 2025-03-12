<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_skin_monthly_view $this */
/** @var int $month */
/** @var int $year */

// table headings
$headings = $this->main->get_weekday_abbr_labels();
echo '<dl class="mec-calendar-table-head"><dt class="mec-calendar-day-head">'.MEC_kses::full(implode('</dt><dt class="mec-calendar-day-head">', $headings)).'</dt></dl>';

// Start day of week
$week_start = $this->main->get_first_day_of_week();

// Single Event Display Method
$target_set = false;
$target_url = 'target="_blank"';

$display_label = false;
$reason_for_cancellation = false;

// days and weeks vars
$running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
$days_in_previous_month = $this->main->get_days_in_previous_month($month, $year);

$days_in_this_week = 1;
$day_counter = 0;

if($week_start == 1) // Monday
{
    if($running_day != 0) $running_day = $running_day - 1;
    else $running_day = 6;
}
elseif($week_start == 6) // Saturday
{
    if($running_day != 6) $running_day = $running_day + 1;
    else $running_day = 0;
}
elseif($week_start == 5) // Friday
{
    if($running_day < 4) $running_day = $running_day + 2;
    elseif($running_day == 5) $running_day = 0;
    elseif($running_day == 6) $running_day = 1;
}
?>
<dl class="mec-calendar-row">
    <?php
        // print "blank" days until the first of the current week
        for($x = 0; $x < $running_day; $x++)
        {
            echo '<dt class="mec-table-nullday">'.($days_in_previous_month - ($running_day-1-$x)).'</dt>';
            $days_in_this_week++;
        }

        // keep going with days ....
        for($list_day = 1; $list_day <= $days_in_month; $list_day++)
        {
            $time = strtotime($year.'-'.$month.'-'.$list_day);

            $today = date('Y-m-d', $time);
            $day_id = date('Ymd', $time);
            $selected_day = (str_replace('-', '', $this->active_day) == $day_id) ? ' mec-selected-day' : '';
            $selected_day_date = (str_replace('-', '', $this->active_day) == $day_id) ? 'mec-color' : '';

            // Print events
            if(isset($events[$today]) and count($events[$today]))
            {
                echo '<dt class="mec-calendar-day '.esc_attr($selected_day).'" data-mec-cell="'.esc_attr($day_id).'" data-day="'.esc_attr($list_day).'" data-month="'.date('Ym', $time).'"><div class="'.esc_attr($selected_day_date).'">'.apply_filters('mec_filter_list_day_value', $list_day, $today, $this).'</div>';
                foreach($events[$today] as $event)
                {
                    $start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
                    $occurrence = strtotime($today.' '.$start_time);
                    $event_unique = (isset($event->data->time) ? $event->data->ID.$event->data->time['start_timestamp'] : $event->data->ID);

                    $attendees = $this->main->get_event_attendees($event->ID, $occurrence);
                    $attendees_count = count($attendees);

                    echo '<div class="'.($this->main->is_expired($event) ? 'mec-past-event ' : '').'ended-relative simple-skin-ended">';
                    echo '<a class="mec-monthly-tooltip event-single-link-simple" data-tooltip-content="#mec-tooltip-'.esc_attr($event_unique.'-'.$day_id).'" data-event-id="'.esc_attr($event->data->ID).'" href="'.esc_url(get_edit_post_link($event->ID)).'" '.$target_url.'>';
                    echo '<h4 class="mec-event-title">'.esc_html(apply_filters('mec_occurrence_event_title', $event->data->title, $event)).'</h4>'.MEC_kses::element($this->main->get_normal_labels($event, $display_label).$this->main->display_cancellation_reason($event, $reason_for_cancellation));
                    do_action('mec_shortcode_virtual_badge', $event->data->ID);
                    echo '</a>';
                    echo '<div id="mec_attendees_'.$event->ID.'_'.$occurrence.'_count" class="mec-admin-calendar-attendees-count">'.sprintf(esc_html__('%s attendees', 'modern-events-calendar-lite'), $attendees_count).'</div>';
                    echo '<div id="mec_attendees_'.$event->ID.'_'.$occurrence.'_table" class="mec-attendees-table lity-hide">'.$this->main->get_attendees_table($attendees, $event->ID, $occurrence, false).'</div>';
                    echo '</div>';

                    $this->getFactory()->params('footer', function() use($event, $occurrence)
                    {
                        ?>
                        <script>
                        jQuery(document).ready(function()
                        {
                            setTimeout(() => {
                                jQuery('#mec_attendees_<?php echo $event->ID.'_'.$occurrence; ?>_count').on('click', function(e)
                                {
                                    e.preventDefault();

                                    // Open Lightbox
                                    lity('#mec_attendees_<?php echo $event->ID.'_'.$occurrence; ?>_table');
                                });
                            }, 1000);

                            jQuery(document).on('lity:close', function(event, instance)
                            {
                                jQuery('body').css('overflow', 'auto');
                            });
                        });
                        </script>
                        <?php
                    });
                }

                echo '</dt>';
            }
            else
            {
                echo '<dt class="mec-calendar-day '.esc_attr($selected_day).'" data-mec-cell="'.esc_attr($day_id).'" data-day="'.esc_attr($list_day).'" data-month="'.date('Ym', $time).'">'.apply_filters('mec_filter_list_day_value', $list_day, $today, $this).'</dt>';
                echo '</dt>';
            }

            if($running_day == 6)
            {
                echo '</dl>';

                if((($day_counter+1) != $days_in_month) or (($day_counter+1) == $days_in_month and $days_in_this_week == 7))
                {
                    echo '<dl class="mec-calendar-row">';
                }

                $running_day = -1;
                $days_in_this_week = 0;
            }

            $days_in_this_week++; $running_day++; $day_counter++;
        }

        // finish the rest of the days in the week
        if($days_in_this_week > 1 && $days_in_this_week < 8)
        {
            for($x = 1; $x <= (8 - $days_in_this_week); $x++)
            {
                echo '<dt class="mec-table-nullday">'.esc_html($x).'</dt>';
            }
        }
    ?>
</dl>
