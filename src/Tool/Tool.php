<?php

namespace Fropsas\LTI\Tool;

use Fropsas\LTI\OAuth\OAuthSignatureMethod_HMAC_SHA1;
use Fropsas\LTI\OAuth\OAuthConsumer;
use Fropsas\LTI\OAuth\OAuthRequest;

class Tool
{
    public static function signParameters(
        $parms,
        $endpoint,
        $method,
        $oauth_consumer_key,
        $oauth_consumer_secret
    )
    {
        $parms["lti_version"] = "LTI-1p0";
        $parms["lti_message_type"] = "basic-lti-launch-request";
        $parms["oauth_callback"] = "about:blank";

        $test_token = '';

        $hmac_method = new OAuthSignatureMethod_HMAC_SHA1();
        $test_consumer = new OAuthConsumer($oauth_consumer_key, $oauth_consumer_secret, NULL);

        $acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $test_token, $method, $endpoint, $parms);
        $acc_req->sign_request($hmac_method, $test_consumer, $test_token);


        $newparms = $acc_req->get_parameters();

        return $newparms;
    }
}