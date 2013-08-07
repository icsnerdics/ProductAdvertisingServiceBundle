<?php
/**
 *
 * Author: Roberto Lombi
 * Date: 02/08/13
 * Time: 17.48
 * License:
 *
 *         DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 * Version 2, December 2004
 *
 * Copyright (C) 2004 Sam Hocevar <sam@hocevar.net>
 *
 * Everyone is permitted to copy and distribute verbatim or modified
 * copies of this license document, and changing it is allowed as long
 * as the name is changed.
 *
 * DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 * TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
 *
 * 0. You just DO WHAT THE FUCK YOU WANT TO.
 *
 */

namespace RobertoDormePoco\ProductAdvertisingServiceBundle\AWSECommerceService;

class ServiceManager {

    const ACCESS_KEY_ID = 'My_Access_Key_Id';
    const ASSOCIATE_TAG = 'My_Associate_Tag';
    const SECRET_KEY = 'My_Secret_Key';

    /**
     *	Italy endopoint
     **/
    const IT_ENDPOINT = 'webservices.amazon.it';
    
    /**
     *	Current API version
     **/
    const CURRENT_VERSION = '2011-08-01';

    protected $params;

    /**
     * @param $responseGroup array Gruppo tipologie contenuto risposta
     */
    function __construct($responseGroup)
    {
        $this->params['Service'] = 'AWSECommerceService';
        $this->params['AssociateTag'] = self::ASSOCIATE_TAG;
        $this->params['AWSAccessKeyId'] = self::ACCESS_KEY_ID;
        $this->params['Version'] = self::CURRENT_VERSION;
        $this->params['ResponseGroup'] = $responseGroup;
    }

    /**
     *
     * Funzione per la richiesta di Item tramite operazione ItemSearch dato un Indice e delle particolari Keywords
     *
     * Method dealing with the request of Item(s) via ItemSearch operation given an Index and an array of Keywords
     *
     * @param $searchIndex string Indice della ricerca [e.g. Books, Music, Movies]
     * @param $keywords array Array delle keywords associate alla ricerca
     */
    public function ItemSearch($searchIndex, $keywords)
    {
        $this->params['Operation'] = 'ItemSearch';
        $this->params['SearchIndex'] = $searchIndex;
        $this->params['Keywords'] = $keywords;

        $endpoint = 'http://' . self::IT_ENDPOINT . '/onca/xml';

        return $endpoint . '?' . $this->canonicalize($this->sign($this->params));
    }

    public function itemLookUp()
    {
        $this->params['Operation'] = 'ItemSearch';
        $this->params['SearchIndex'] = $searchIndex;
        $this->params['Keywords'] = $keywords;

        $endpoint = 'http://' . self::IT_ENDPOINT . '/onca/xml';

        return $endpoint . '?' . $this->canonicalize($this->sign($this->params));
    }

    private function sign( $params ) {

        if( !array_key_exists('Timestamp', $params )){
            $params['Timestamp'] = date("Y-m-d\TH:i:s.000Z");
        }
        ksort($params);
        $canonical = $this->canonicalize($params);
        $stringToSign = 'GET' . "\n" .
            self::IT_ENDPOINT . "\n" .
            '/onca/xml' . "\n" .
            $canonical;
        $params['Signature'] = base64_encode(hash_hmac("sha256", $stringToSign, self::SECRET_KEY, true));

        return $params;
    }

    private function canonicalize($params) {
        $parts = array();
        foreach( $params as $k => $v){

            if($k == 'Keywords') {
                $v = $this->canonicalizeKeywords($v);
            }

            $x = rawurlencode($k) . '=' . rawurlencode($v);
            array_push($parts, $x );
        }
        return implode('&',$parts);
    }


    private function canonicalizeKeywords($keywords) {

        $n_keywords = '';

        for($i = 0; $i < count($keywords)-1; $i++){
            $n_keywords .= $keywords[$i].'+';
        }

        if(!empty($keywords))
            $n_keywords .= $keywords[count($keywords)-1];


        return $n_keywords;
    }

}