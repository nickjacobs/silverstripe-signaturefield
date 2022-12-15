<?php

namespace Micschk\SignatureField;

use SilverStripe\Forms\TextField;

/**
 * ExternalURLField
 *
 * Form field for entering, saving, validating external urls.
 */
class SignatureField extends TextField
{

    // check for Chrome mobile: https://github.com/szimek/signature_pad/issues/89
    // check for vector data: https://github.com/szimek/signature_pad/issues/44

    public function __construct($name, $title = null, $value = null)
    {
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-entwine/dist/jquery.entwine-dist.js');
        Requirements::javascript(SIGNATURE_MODULE_DIR . "/bower_components/signature_pad/signature_pad.js");
        Requirements::javascript(SIGNATURE_MODULE_DIR . "/javascript/signature_pad.init.js");
        Requirements::css(SIGNATURE_MODULE_DIR . "/css/signature.css");

        $this->addExtraClass('signature no-sigpad');

        parent::__construct($name, $title, $value);
    }

//	public function Type() {
//		return 'url text';
//	}
//
//	/**
//	 * @param string $name
//	 * @param mixed $val
//	 */
//	public function setConfig($name, $val = null) {
//		if(is_array($name) && $val == null){
//			foreach($name as $n => $value){
//				$this->setConfig($n, $value);
//			}
//
//			return $this;
//		}
//		if(is_array($this->config[$name])){
//			if(!is_array($val)){
//				user_error("The value for $name must be an array");
//			}
//			$this->config[$name] = array_merge($this->config[$name], $val);
//		}elseif(isset($this->config[$name])){
//			$this->config[$name] = $val;
//		}
//
//		return $this;
//	}
//
//	/**
//	 * @param String $name Optional, returns the whole configuration array if empty
//	 * @return mixed|array
//	 */
//	public function getConfig($name = null) {
//		if($name) {
//			return isset($this->config[$name]) ? $this->config[$name] : null;
//		} else {
//			return $this->config;
//		}
//	}

    /**
     * Set additional attributes
     * @return array Attributes
     */
//	public function getAttributes() {
//		$attributes = array(
//			'placeholder' => $this->config['defaultparts']['scheme']."://example.com" //example url
//		);
//		if($this->config['html5validation']){
//			$attributes += array(
//				'type' => 'url', //html5 field type
//				'pattern' => 'https?://.+', //valid urls only
//			);
//		}
//
//		return array_merge(
//			parent::getAttributes(),
//			$attributes
//		);
//	}

    /**
     * Rebuild url on save
     * @param string $url
     */
//	public function setValue($url) {
//		if($url){
//			$url = $this->rebuildURL($url);
//		}
//		parent::setValue($url);
//	}

    /**
     * Add config scheme, if missing.
     * Remove the parts of the url we don't want.
     * Set any defaults, if missing.
     * Remove any trailing slash, and rebuild.
     * @return string
     */
//	protected function rebuildURL($url) {
//		$defaults = $this->config['defaultparts'];
//		if(!preg_match('#^[a-zA-Z]+://#', $url)){
//			$url = $defaults['scheme']."://".$url;
//		}
//		$parts = parse_url($url);
//		if(!$parts){
//			//can't parse url, abort
//			return "";
//		}
//		foreach($parts as $part => $value) {
//			if($this->config['removeparts'][$part] === true){
//				unset($parts[$part]);
//			}
//		}
//		//set defaults, if missing
//		foreach($defaults as $part => $default){
//			if(!isset($parts[$part])){
//				$parts[$part] = $default;
//			}
//		}
//
//		return rtrim(http_build_url($defaults, $parts), "/");
//	}

    /**
     * Server side validation, using a regular expression.
     */
//	public function validate($validator) {
//		$this->value = trim($this->value);
//		$regex = $this->config['validregex'];
//		if($this->value && $regex && !preg_match($regex, $this->value)){
//			$validator->validationError(
//				$this->name,
//				_t('ExternalURLField.VALIDATION', "Please enter a valid URL"),
//				"validation"
//			);
//			return false;
//		}
//		return true;
//	}
}
