# silverstripe-signaturefield

A silverstripe signature form field based on https://github.com/szimek/signature_pad

![screenshot](images/signaturefield.png)

## Installation

```bash
composer require micschk/silverstripe-signaturefield
```

## Usage

A signaturefield will be scaffolded if field is set to 'Signature' (field holds base64 png image of signature)

```php
use Micschk\SignatureField\Signature;

class Contract extends DataObject {

	private static $db = array(
		'Signature' => Signature::class,
	);

}
```

Or explicitly add a SignatureField to a form (eg for non-scafolded formfields or front-end)

```php
use Micschk\SignatureField\SignatureField;

...

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main',
				SignatureField::create('Signature')
			);

		return $fields;
	}
```

### Front end use

If using this field on a front end form, outside of the CMS, jQuery is required. By default this module will load a packaged version of jQuery. This may conflict with existing versions if you have separately installed jQuery on your front end. To remove the included version of jQuery and make use of your own version, add the following to your yaml config

```yml
Micschk\SignatureField\SignatureField:
  include_jquery: false
```

## Known Issues

Scaling issues may occur on high DPI screens: https://github.com/szimek/signature_pad/issues/679

## Development

The js is bundled using parcel.js. To make javascript changes

1. run `yarn install` to install dependencies.
2. make requisite changes in `javascript/src/signature_pad.init.js`
3. run `yarn build` to compile changes
