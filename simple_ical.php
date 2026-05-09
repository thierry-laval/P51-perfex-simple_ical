<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Simple iCal Export
Description: Export calendrier Perfex en flux iCal (.ics)
Version: 1.0.0
Author: Thierry Laval
*/

hooks()->add_action('admin_init', function () {

    $CI = &get_instance();

    $CI->app_menu->add_sidebar_menu_item('simple_ical', [
        'name'     => 'iCal Export',
        'href'     => admin_url('simple_ical'),
        'icon'     => 'fa fa-calendar',
        'position' => 35,
    ]);
});