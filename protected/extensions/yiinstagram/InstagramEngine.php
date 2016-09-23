<?php
/**
 * The InstagramEngine CApplicationComponent class
 *
 * This is the extension launcher, it just initialize the InstagramEngine
 * based on your main.php component's settings and returns it
 *
 * @author Giuliano Iacobelli <me@giulianoiacobelli.com>
 * @package application.extensions.yiinstagram
 * @version 1.0
 */

class InstagramEngine extends CApplicationComponent
{


    // set the consumer key and secret
    public $config = array();

    /**
     * Returns services settings declared in the authorization classes.
     * For perfomance reasons it uses Yii::app()->cache to store settings array.
     * @return array services settings.
     */
    public function getConfig()
    {
        if (Yii::app()->hasComponent('cache'))
            $config = Yii::app()->cache->get('Instagram.config');
        if (!isset($config) || !is_array($config)) {
            $config = array();
            foreach ($this->config as $configElem => $value) {
                $config[$configElem] = $value;
            }
            if (Yii::app()->hasComponent('cache'))
                Yii::app()->cache->set('Instagram.config', $config);
        }
        return $config;
    }


    /**
     * Returns services settings declared in the authorization classes.
     * For perfomance reasons it uses Yii::app()->cache to store settings array.
     * @return array services settings.
     */
    public function getInstagramApp()
    {

        /**
         * This is how a wrong response looks like
         * array(1) { ["InstagramOAuthToken"]=> string(89) "{"code": 400, "error_type": "OAuthException", "error_message": "No        matching code found."}" }
         */

        $config = $this->getConfig();
        $instagram = new Instagram($config);
        return $instagram;

    }
}


/**
 * The InstagramAppException exception class.
 *
 * @author Giuliano Iacobelli <me@giulianoiacobelli.com>
 * @package application.extensions.yiinstagram
 * @version 1.0
 */
class InstagramAppException extends CException
{
}