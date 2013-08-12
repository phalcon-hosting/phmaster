<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
*/
namespace PH\Master;
use Phalcon\Exception;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Translate\Adapter\NativeArray;

/**
@package Hosting
*/
class Translate extends Module {

    /**
     * @var NativeArray
     */
    protected $_translations;

    /**
     * @var Translate
     */
    static $_instance;

    /**
     * @param string $language
     * @param array $manualTranslations
     * @return mixed
     */
    public function __construct($language = 'nl', array $manualTranslations = array()) {
        parent::__construct();
        /**
         * Initialize multiLingual support
         */

        $languagePath = $this->_config->application->locales;

        $translationCacheKey = "translations_$language";
        if($this->_cache->exists($translationCacheKey)){
            $this->_translations = $this->_cache->get($translationCacheKey);
        } else {

            $messages = array();

            // manual translations can also be passed and will overwrite the language files
            if(count($manualTranslations) > 0) {
                $messages = $manualTranslations;
            } else {
                //Check if we have a translation file for that lang
                if (file_exists($languagePath. "$language.php")) {
                    require $languagePath . "nl.php";
                } else {
                    // fallback to some default
                    require $languagePath. "en.php";
                }
            }

            /*
             * Get a unique hash value for this (we use crc32 because of performance reasons)
             * The reason of doing caching like this is because we will add database translations in the future
             * for content management reasons.
             *
             * The maximum lifetime for translated messages is 1 hour
             */
            $translations = new NativeArray(array(
                "content" => $messages
            ));

            // save the translations in the cache
            $this->_cache->save($translationCacheKey, $translations, 3600);

            //Return a translation object
            $this->_translations = $translations;

        }


        // save the instance
        self::$_instance = $this;

    }

    /**
     * @return NativeArray
     */
    public function getTranslations() {
        return $this->_translations;
    }

    /**
     *
     * Translation method primarily used on the frontend
     *
     * @param $key
     * @param array $params
     * @throws \Phalcon\Exception
     * @return mixed
     */
    public static function translate($key, array $params = array()) {
        if(!self::$_instance instanceof self) {
            throw new Exception('Translations need to be set first, initialize the object');
        }

        return vsprintf(self::$_instance->_translations[$key], $params);
    }

    /**
     * @param $key
     * @param array $params
     * @return mixed
     */
    public static function _($key, array $params = array()) {
        return static::translate($key, $params);
    }
}


