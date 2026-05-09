<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Simple_ical_feed extends CI_Controller
{
    public function index()
    {
        // Chargement explicite de la base de données (nécessaire pour CI_Controller)
        $this->load->database();

        // Vérification du token de sécurité
        $token = $this->input->get('token');
        $stored_token = get_option('simple_ical_token');

        if (empty($token) || $token !== $stored_token) {
            header('HTTP/1.0 403 Forbidden');
            echo "Erreur : Token invalide ou manquant.";
            exit;
        }

        // Nettoyage des sorties précédentes
        while (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: inline; filename="calendar.ics"');
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

        if (!$this->db->table_exists('tblevents')) {
            $this->output_empty_calendar();
        }

        $this->db->select('eventid, title, description, start, end');

        $date_from = get_option('simple_ical_date_from');
        $date_to = get_option('simple_ical_date_to');

        if (!empty($date_from)) {
            $this->db->where('start >=', $date_from . ' 00:00:00');
        }
        if (!empty($date_to)) {
            $this->db->where('end <=', $date_to . ' 23:59:59');
        }

        $events = $this->db->get('tblevents')->result();

        $output = "BEGIN:VCALENDAR\r\n";
        $output .= "VERSION:2.0\r\n";
        $output .= "PRODID:-//Simple iCal Export//FR\r\n";
        $output .= "X-WR-CALNAME:Perfex CRM\r\n";
        $output .= "CALSCALE:GREGORIAN\r\n";
        $output .= "METHOD:PUBLISH\r\n";
        $output .= "X-PUBLISHED-TTL:PT5M\r\n";
        $output .= "REFRESH-INTERVAL;VALUE=DURATION:PT5M\r\n";

        foreach ($events as $event) {
            $title = $this->escape($event->title);
            $desc  = $this->escape($event->description ?? '');
            
            // Formatage date : Ymd\THis (Heure locale sans Z pour éviter les décalages UTC)
            $dtstart = date('Ymd\THis', strtotime($event->start));
            $dtend   = date('Ymd\THis', strtotime($event->end));

            $output .= "BEGIN:VEVENT\r\n";
            $output .= "UID:" . $event->eventid . "@thierrylaval.dev\r\n";
            $output .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
            $output .= "DTSTART:" . $dtstart . "\r\n";
            $output .= "DTEND:" . $dtend . "\r\n";
            $output .= "SUMMARY:" . $title . "\r\n";
            $output .= "DESCRIPTION:" . $desc . "\r\n";
            $output .= "END:VEVENT\r\n";
        }

        $output .= "END:VCALENDAR\r\n";
        echo $output;
        exit;
    }

    private function output_empty_calendar()
    {
        $output = "BEGIN:VCALENDAR\r\n";
        $output .= "VERSION:2.0\r\n";
        $output .= "PRODID:-//Simple iCal Export//FR\r\n";
        $output .= "X-WR-CALNAME:Perfex CRM\r\n";
        $output .= "METHOD:PUBLISH\r\n";
        $output .= "END:VCALENDAR\r\n";
        echo $output;
        exit;
    }

    private function escape($string)
    {
        $string = strip_tags($string ?? '');
        $string = str_replace('\\', '\\\\', $string);
        $string = str_replace(';', '\;', $string);
        $string = str_replace(',', '\,', $string);
        $string = str_replace(["\r", "\n"], " ", $string);
        return trim($string);
    }
}