<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_skin_single $this */

$styling = $this->main->get_styling();
$event = $this->events[0];
$event_colorskin = isset($styling['mec_colorskin']) || isset($styling['color']) ? 'colorskin-custom' : '';
$settings = $this->main->get_settings();

$occurrence = ($event->date['start']['date'] ?? (isset($_GET['occurrence']) ? sanitize_text_field($_GET['occurrence']) : ''));
$occurrence_end_date = ($event->date['end']['date'] ?? (trim($occurrence) ? $this->main->get_end_date_by_occurrence($event->data->ID, ($event->date['start']['date'] ?? $occurrence)) : ''));

$occurrence_full = (isset($event->date['start']) and is_array($event->date['start'])) ? $event->date['start'] : [];
if(!count($occurrence_full) and isset($_GET['occurrence'])) $occurrence_full = array('date' => sanitize_text_field($_GET['occurrence']));

$occurrence_end_full = (isset($event->date['end']) and is_array($event->date['end'])) ? $event->date['end'] : [];
if(!count($occurrence_end_full) and trim($occurrence)) $occurrence_end_full = array('date' => $this->main->get_end_date_by_occurrence($event->data->ID, $occurrence));

// Event Object
$GLOBALS['mec-event'] = $event;

$show_event_details_page = apply_filters('mec_show_event_details_page', true, $event->data->ID);
if($show_event_details_page !== true)
{
    echo MEC_kses::full($show_event_details_page);
    return;
}

if(post_password_required($event->data->post))
{
    echo get_the_password_form($event->data->post);
    return;
}

// Created by FES?
$fes = ($event and isset($event->data, $event->data->meta, $event->data->meta['mec_created_by_fes']));

// Style Per Event
$style_per_event = '';
if(isset($this->settings['style_per_event']) and $this->settings['style_per_event'])
{
    $style_per_event = get_post_meta($event->data->ID, 'mec_style_per_event', true);
    if($style_per_event === 'global') $style_per_event = '';
}

if(isset($this->layout) and trim($this->layout)) $layout = $this->layout;
elseif(trim($style_per_event)) $layout = $style_per_event;
elseif($fes && isset($settings['fes_single_event_style']) && trim($settings['fes_single_event_style'])) $layout = $settings['fes_single_event_style'];
elseif(!isset($settings['single_single_style']) || $settings['single_single_style'] == 'default') $layout = 'default';
elseif($settings['single_single_style'] == 'builder') $layout = 'builder';
elseif($settings['single_single_style'] == 'divi-builder') $layout = 'divi-builder';
else $layout = 'modern';

$filename = MEC::import('app.skins.single.'.$layout, true, true);
if(!file_exists($filename)) $filename = MEC::import('app.skins.single.default', true, true);

include $filename;
echo $this->display_credit_url();
