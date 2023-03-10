<?php

namespace Micschk\SignatureField;

use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Forms\TextField;
use SilverStripe\View\Requirements;

class SignatureField extends TextField
{
    use Configurable;

    /**
     * @config
     */
    private static $include_jquery = true;

    public function __construct($name, $title = null, $value = null)
    {
        if (Controller::has_curr() && !Controller::curr() instanceof LeftAndMain) {
            if ($this->config()->include_jquery) {
                Requirements::javascript('micschk/silverstripe-signaturefield: /javascript/dist/jquery.js');
            }
            Requirements::javascript('silverstripe/admin: thirdparty/jquery-entwine/jquery.entwine.js');
        }
        Requirements::javascript('micschk/silverstripe-signaturefield: /javascript/dist/signature_pad.init.js');
        Requirements::css('micschk/silverstripe-signaturefield: /css/signature.css');

        $this->addExtraClass('signature no-sigpad');

        parent::__construct($name, $title, $value);
    }
}
