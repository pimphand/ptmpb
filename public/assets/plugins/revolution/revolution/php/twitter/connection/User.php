<?php

namespace TwitterPhp\Connection;

class User extends Base
{
    /**
     * @var string
     */
    private $_consumerKey;

    /**
     * @var string
     */
    private $_consumerSecret;

    /**
     * @var string
     */
    private $_accessToken;

    /**
     * @var string
     */
    private $_accessTokenSecret;

    /**
     * @param  string  $consumerKey
     * @param  string  $consumerSecret
     * @param  string  $accessToken
     * @param  string  $accessTokenSecret
     */
    public function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret)
    {
        $this->_consumerKey = $consumerKey;
        $this->_consumerSecret = $consumerSecret;
        $this->_accessToken = $accessToken;
        $this->_accessTokenSecret = $accessTokenSecret;
    }

    /**
     * @param  string  $url
     * @return array
     */
    protected function _buildHeaders($url, ?array $parameters, $method)
    {
        $oauthHeaders = [
            'oauth_version' => '1.0',
            'oauth_consumer_key' => $this->_consumerKey,
            'oauth_nonce' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => $this->_accessToken,
            'oauth_timestamp' => time(),
        ];

        $data = $oauthHeaders;
        if ($method == self::METHOD_GET) {
            $data = array_merge($oauthHeaders, $parameters);
        }
        $oauthHeaders['oauth_signature'] = $this->_buildOauthSignature($url, $data, $method);
        ksort($oauthHeaders);
        $oauthHeader = [];

        foreach ($oauthHeaders as $key => $value) {
            $oauthHeader[] = $key.'="'.rawurlencode($value).'"';
        }

        $headers[] = 'Authorization: OAuth '.implode(', ', $oauthHeader);

        return $headers;
    }

    /**
     * @return string
     */
    private function _buildOauthSignature($url, array $params, $method)
    {
        ksort($params);
        $sortedParams = [];

        foreach ($params as $key => $value) {
            $sortedParams[] = $key.'='.$value;
        }

        $signatureBaseString = $method.'&'.rawurlencode($url).'&'.rawurlencode(implode('&', $sortedParams));
        $compositeKey = rawurlencode($this->_consumerSecret).'&'.rawurlencode($this->_accessTokenSecret);

        return base64_encode(hash_hmac('sha1', $signatureBaseString, $compositeKey, true));
    }
}
