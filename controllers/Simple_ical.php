<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Simple_ical extends AdminController
{
    public function index()
    {
        if ($this->input->post()) {
            update_option('simple_ical_date_from', $this->input->post('date_from'));
            update_option('simple_ical_date_to', $this->input->post('date_to'));
            set_alert('success', _l('updated_successfully', 'Configuration iCal'));
        }

        // Sécurité : On récupère ou génère un token unique pour le flux
        $token = get_option('simple_ical_token');
        if (!$token) {
            $token = app_generate_hash();
            add_option('simple_ical_token', $token);
        }

        $data['ical_url'] = site_url('simple_ical/simple_ical_feed?token=' . $token);
        $data['date_from'] = get_option('simple_ical_date_from');
        $data['date_to'] = get_option('simple_ical_date_to');

        $this->load->view('simple_ical/settings', $data);
    }
}