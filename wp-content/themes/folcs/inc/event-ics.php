<?php

function add_calendar_feed(){
	add_feed('calendar', 'export_ics');
}
add_action('init', 'add_calendar_feed');


function export_ics(){

    /*  For a better understanding of ics requirements and time formats
        please check https://gist.github.com/jakebellacera/635416   */

    // Query the event
    $the_event = new WP_Query(array(
        'p' => $_REQUEST['id'],
        'post_type' => 'any',
    ));
    
    if($the_event->have_posts()) :
        
        function format_timestamp($timestamp) {
            $dt = new DateTime($timestamp);
            return $dt->format('Ymd\THis');
        }
        function escapeString($string) {
              return preg_replace('/([\,;])/','\\\$1', $string);
        }
    
        while($the_event->have_posts()) : $the_event->the_post();

            if( have_rows('event_episode_items') ):

                while ( have_rows('event_episode_items') ) : the_row();

                    if( get_row_layout() == 'event_episode_title' ):

        /*  The correct date format, for ALL dates is date_i18n('Ymd\THis\Z',time(), true)
            So if your date is not in this format, use that function    */

        $date = get_sub_field('episode_title_date', false, false);
        $date = new DateTime($date);
            
        $DTSTAMP = format_timestamp('now');
        $uid = get_the_ID();
        $start_date = format_timestamp($date->format('Y-n-j').' '.get_sub_field('episode_title_start_time', get_the_ID()));
        $end_date = format_timestamp($date->format('Y-n-j').' '.get_sub_field('episode_title_end_time', get_the_ID()));
        $organiser = get_bloginfo('name');
        $location = get_sub_field('episode_title_location', get_the_ID());
        $url = get_the_permalink();
        $title = get_sub_field('episode_title_detail', get_the_ID());

        //Give the iCal export a filename
        $filename = urlencode( 'FOLCS-' . $title . '.ics' );
        $eol = "\r\n";

        //Collect output
        ob_start();

        // Set the correct headers for this file
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$filename);
        header('Content-type: text/calendar; charset=utf-8');
        header("Pragma: 0");
        header("Expires: 0");

// The below ics structure MUST NOT have spaces before each line
// 'X-WR-TIMEZONE:America/New_York'
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
CALSCALE:GREGORIAN
BEGIN:VEVENT
LOCATION:<?php echo escapeString($location).$eol; ?>
DESCRIPTION:<?php echo escapeString($title); echo $eol; ?>
DTSTART:<?php echo $start_date.$eol; ?>
DTEND:<?php echo $end_date.$eol; ?>
SUMMARY:<?php echo escapeString($title); echo $eol; ?>
URL;VALUE=URI:<?php echo escapeString($url).$eol; ?>
DTSTAMP:<?php echo $DTSTAMP.$eol; ?>
UID:<?php echo $uid.$eol;?>
END:VEVENT
END:VCALENDAR
<?php
                    endif;
                endwhile;
            endif;
        endwhile;
?>
<?php
        //Collect output and echo
        $eventsical = ob_get_contents();
        ob_end_clean();
        echo $eventsical;
        exit();

    endif;
}
?>