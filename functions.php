function dashboard_uptimerobot_stats_output() {
    echo '<div class="site-uptime">';
    /* Please note that as of May 2012, the UptimeRobot WP Widget will be getting a "face-lift". 
    *  Plans to implement a more solid foundation and utilization of the UptimeRobot API will be 
    *  committed as soon as possible */
    
    /* Note- You will need a GetMonitor API Key from UpTimeRobot. You can get that from here, http://uptimerobot.com/mySettings.asp */
    /* Then goto, http://api.uptimerobot.com/getMonitors?apiKey=YOURKEY, and get your $monitorID */
    $apiKey     = "YOUR-GETMONITOR-APIKEY"; // TODO: Replace with your actual API key
    $monitorID  = "MONITOR-ID"; // TODO: Replace with your actual Monitor ID
    $logs = 1; /* Change to 0 to disable logging feature */
    // In API v2, 'contacts' is not a parameter for getMonitors. 
    // To get uptime ratio, use 'custom_uptime_ratios' or 'all_time_uptime_ratio'
    // For simplicity, we'll request all_time_uptime_ratio by default.
    // $contacts = 1; /* Change to 0 to disable Alert Contact feature */ 
    $url = "https://api.uptimerobot.com/v2/getMonitors";

    $postFields = "api_key=" . $apiKey . "&monitors=" . $monitorID . "&logs=" . $logs . "&format=json&all_time_uptime_ratio=1";

    $c = curl_init($url);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    // It's good practice to set a timeout for cURL requests
    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($c, CURLOPT_TIMEOUT, 30);
    // It's good practice to set the User-Agent
    curl_setopt($c, CURLOPT_USERAGENT, 'WordPress UptimeRobot Widget/2.0');


    $responseJSON = curl_exec($c);
    curl_close($c);

    $responseData = json_decode($responseJSON);

    /* Any ideas, concepts, thoughts, questions or feature requests can be submitted to either support@icodeclarity.com or @CreativeBoulder */

    // Check if the API call was successful and monitors data is available
    if ($responseData && isset($responseData->stat) && $responseData->stat === 'ok' && isset($responseData->monitors) && is_array($responseData->monitors)) {
        foreach($responseData->monitors as $monitor) {
            echo '<div class="site-uptime-wrap" style="width: 100%; display: block; height: 235px;">';
            echo '<h2><strong style="font-size: 16px; float: left; width: 100%; margin: 0pt 0pt 5px;">Domain Uptime Statistics</strong></h2>';
            echo '<p style="font-size: 11px; float: left; width: 100%;">';
            echo 'Website being monitored is- <br/>';
            echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
            echo htmlspecialchars($monitor->url); // Sanitize output
            echo '</span>';
            echo '</p>';
            echo '<p style="font-size: 10px; float: left; width: 100%;">Your Website is currently- <br/>';
            // Status: 0 - Paused, 1 - Not Checked Yet, 2 - Up, 8 - Seems Down, 9 - Down
            if ( $monitor->status == 2 ) {
                echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
                echo 'Online';
                echo '</span>';
            } else {
                echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
                // Provide a more descriptive status based on API v2 docs
                $statusText = 'Offline or Unavailable';
                if ($monitor->status == 0) $statusText = 'Paused';
                else if ($monitor->status == 1) $statusText = 'Not Checked Yet';
                else if ($monitor->status == 8) $statusText = 'Seems Down';
                else if ($monitor->status == 9) $statusText = 'Down';
                echo $statusText;
                echo '</span>';
            }
            echo '</p>';
            echo '<p style="font-size: 11px; float: left; width: 100%;">Your all-time Website Uptime percent is- <br/>';
            echo '<span style="background: none repeat scroll 0% 0% rgb(255, 255, 221); border: 2px solid rgb(218, 218, 142);-webkit-border-radius: 4px 4px 4px 4px;-moz-border-radius: 4px 4px 4px 4px;border-radius: 4px 4px 4px 4px;text-align: center;padding: 0px 25px;float: left;margin-top: 10px;font-weight:bold;">';
            // API v2 uses all_time_uptime_ratio for the field name in the response
            echo htmlspecialchars($monitor->all_time_uptime_ratio); echo '%'; 
            echo '</span>';
            echo '</p>';
            echo '</div>';
        }
    } else {
        // Handle API error or unexpected response
        echo '<div class="site-uptime-wrap" style="width: 100%; display: block; padding: 10px; box-sizing: border-box;">';
        echo '<h2><strong style="font-size: 16px; float: left; width: 100%; margin: 0pt 0pt 5px;">Domain Uptime Statistics</strong></h2>';
        echo '<p style="font-size: 11px; float: left; width: 100%; color: red;">';
        echo 'Could not retrieve uptime statistics. Please check your API key and Monitor ID.<br/>';
        if ($responseData && isset($responseData->error)) {
            echo 'Error: ' . htmlspecialchars($responseData->error->message);
        }
        echo '</p>';
        echo '</div>';
    }
    echo '</div>';
}
wp_add_dashboard_widget( 'dashboard_uptimerobot_stats', 'Website Uptime and Downtown Stats', 'dashboard_uptimerobot_stats_output' );
