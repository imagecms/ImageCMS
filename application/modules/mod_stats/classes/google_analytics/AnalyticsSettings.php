<?php

namespace mod_stats\classes\ga;

require_once './src/Google_Client.php';
require_once './src/contrib/Google_AnalyticsService.php';

/**
 * 
 *
 * @author kolia
 */
class AnalyticsSettings {

    public function __construct() {

        $client = new Google_Client();
        $client->setApplicationName("Tralialia");

        // Visit https://code.google.com/apis/console?api=analytics to generate your
        // client id, client secret, and to register your redirect uri.
        $client->setClientId('402521038185.apps.googleusercontent.com');
        $client->setClientSecret('oOsDxhg5IYAX2KiiRQiRd3SI');
        $client->setRedirectUri('http://localhost/workplace4.loc/google-api-php-client/examples/analytics/simple.php');
        $client->setDeveloperKey('AIzaSyBfakbI6VzX9ziv1s0CwE-tdYIdAQaIWKc');
        $service = new Google_AnalyticsService($client);

        if (isset($_GET['logout'])) {
            unset($_SESSION['token']);
        }

        if (isset($_GET['code'])) {
            $client->authenticate();
            $_SESSION['token'] = $client->getAccessToken();
            $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['token'])) {
            $client->setAccessToken($_SESSION['token']);
        }

        if ($client->getAccessToken()) {
            echo '<pre>';
            var_dump(
                    $service->data_ga->get(
                            'ga:62253337', '2013-09-03', '2013-09-04', 'ga:visits', array(
                        'dimensions' => 'ga:source,ga:keyword',
                        'sort' => '-ga:visits,ga:keyword',
                        'filters' => 'ga:medium==organic',
                        'max-results' => '25')
                    )
            );
            echo '</pre>';
        } else {
            $authUrl = $client->createAuthUrl();
            print "<a class='login' href='$authUrl'>Connect Me!</a>";
        }
    }

}

?>
