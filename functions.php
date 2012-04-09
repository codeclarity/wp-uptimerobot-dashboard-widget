function dashboard_uptimerobot_stats_output() {
    echo '<div class="site-uptime">';
    /* Note- You will need a GetMonitor API Key from UpTimeRobot. You can get that from here, http://uptimerobot.com/mySettings.asp */
    /* Then goto, http://api.uptimerobot.com/getMonitors?apiKey=YOURKEY, and get your $monitorID */
    $apiKey     = "YOUR-GETMONITOR-APIKEY";
    $monitorID  = MONITOR-ID;
    $logs = 1; /* Change to 0 to disable logging feature */ /* Logs will be implemented in version 0.2 */
    $contacts = 1; /* Change to 0 to disable Alert Contact feature */
    $url = "http://api.uptimerobot.com/getMonitors?apiKey=" . $apiKey . "&monitors=" . $monitorID . "&logs=" . $logs . "&contacts=" . $contacts . "&format=xml";

    $c = curl_init($url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $responseXML = curl_exec($c);
    curl_close($c);

    $xml = simplexml_load_string($responseXML); // Should SimpleXML be used here?

    /* Any ideas, concepts, thoughts, questions or feature requests can be submitted to either support@icodeclarity.com or @CreativeBoulder */

    foreach($xml->monitor as $monitor) {
        echo '<div class="site-uptime-wrap" style="width: 100%; display: block; height: 235px;">';
        echo '<h2><strong style="font-size: 16px; float: left; width: 100%; margin: 0pt 0pt 5px;">Domain Uptime Statistics</strong></h2>';
        echo '<p style="font-size: 11px; float: left; width: 100%;">';
        echo 'Website being monitored is- <br/>';
        echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
        echo $monitor['url'];
        echo '</span>';
        echo '</p>';
        echo '<p style="font-size: 10px; float: left; width: 100%;">Your Website is currently- <br/>';
        if ( $monitor['status'] == 2 ) {
            echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
            echo 'Online';
            echo '</span>';
        } else {
            echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
            echo 'Offline or Unavailable';
            echo '</span>';
        }
        echo '</p>';
        echo '<p style="font-size: 11px; float: left; width: 100%;">Your all-time Website Uptime percent is- <br/>';
        echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
        echo $monitor['alltimeuptimeratio']; echo '%';
        echo '</span>';
        echo '</p>';
        echo '</div>';
    }
    echo '</div>';
}
wp_add_dashboard_widget( 'dashboard_uptimerobot_stats', 'Website Uptime and Downtown Stats', 'dashboard_uptimerobot_stats_output' );
