<?php
    require_once "common.php";
    session_start();

    function escape($thing) {
        return htmlentities($thing);
    }

    function finish_auth(){
        $consumer = getConsumer();

        // Complete the authentication process using the server's
        // response.
        $return_to = getReturnTo();
        $response = $consumer->complete($return_to);

        // Check the response status.
        if ($response->status == Auth_OpenID_CANCEL) {
            // This means the authentication was cancelled.
            die ('Verification cancelled.');
        } else if ($response->status == Auth_OpenID_FAILURE) {
            // Authentication failed; display the error message.
            die ("OpenID authentication failed: " . $response->message);
        } else if ($response->status == Auth_OpenID_SUCCESS) {
            echo "Success";

            $sreg = $sreg_resp->contents();
            /*foreach ($sref as $line){
                echo "Line " . $line;
            }*/
        }
    }

    finish_auth();
?>
