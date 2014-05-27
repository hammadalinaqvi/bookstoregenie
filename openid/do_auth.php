<?php 

    session_start();
    require_once 'common.php';

    function getURL(){
        if (empty($_GET['openid_identifier']))
            die ("no url specified");
        return $_GET['openid_identifier'];
    }

    function doAuth(){
        $url = getURL();
        $consumer = getConsumer();

        $auth_request = $consumer->begin($url);

        // No request means we can't begin OpenID.
        if (!$auth_request) {
            die("Authentication error; not a valid OpenID.");
        }


        $sreg_request = Auth_OpenID_SRegRequest::build(
                                     // Required
                                     array('nickname'),
                                     // Optional
                                     array('fullname', 'email'));
        
        if ($sreg_request) {
            $auth_request->addExtension($sreg_request);
        }

        //redirect the user to the correct page
        // If the redirect URL can't be built, display an error
        // message.
        $redirect_url = $auth_request->redirectURL(getTrustRoot(),
                                                   getReturnTo());
        if (Auth_OpenID::isFailure($redirect_url)) {
            die("Could not redirect to server: " . $redirect_url->message);
        } else {
            // Send redirect.
            header("Location: ".$redirect_url);
        }
    }

    doAuth();

?>