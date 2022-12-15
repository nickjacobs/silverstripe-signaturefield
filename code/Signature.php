<?php

namespace Micschk\SignatureField;

use SilverStripe\Forms\FormField;
class Signature extends FormField
{

    /**
     * (non-PHPdoc)
     * @see DBField::requireField()
     */
    public function requireField()
    {
        $parts = array(
            'datatype' => 'text', //64k chars
            'character set' => 'utf8',
            'collate' => 'utf8_general_ci',
            'arrayValue' => $this->arrayValue
        );

        $values= array(
            'type' => 'text',
            'parts' => $parts
        );

        DB::requireField($this->tableName, $this->name, $values, $this->default);
    }

    /**
     * Scaffold the ExternalURLField for this ExternalURL
     */
    public function scaffoldFormField($title = null, $params = null)
    {
        $field = SignatureField::create($this->name, $title);
        //$field->setMaxLength($this->getSize());

        return $field;
    }

    // just return an image with the data-URI
    public function forTemplate()
    {
        if ($this->value) {
            return '<img src="'.$this->value.'" />';
            //return $this->URL();
        }
    }

    // output/write to file ($output = absolute output path or 'browser' for output to browser)
    public function toFile($output = 'tobrowser')
    {
        if ($this->value) {
            $data_pieces = explode(",", $this->value);
            $encoded_image = $data_pieces[1];
            $decoded_image = base64_decode($encoded_image);
            // output
            if ($output=='tobrowser') {
                header('Content-Type: image/png');
                header('Content-Length: '.strlen($decoded_image));
                echo $decoded_image;
            } else {
                file_put_contents($output, $decoded_image);
            }
        }
    }
}
