#Magoo

[![Build Status](https://travis-ci.org/pachico/magoo.svg?branch=master)](https://travis-ci.org/pachico/magoo) [![codecov.io](https://codecov.io/github/pachico/magoo/coverage.svg?branch=master)](https://codecov.io/github/pachico/magoo?branch=master)

Magoo will mask sensitive data out of strings. This might be useful, for loging user input.
It comes with CreditCard and Email data masking, but you can inject custom classes as long as they implement a simple interface.

(If you have suggestions about built-in masks, **please let me know**!)

#Installation
Using composer:

	composer require pachico/magoo

#Simple usage

	namespace Pachico\Magoo;
	$magoo = new Magoo;

	$magoo->maskCreditCard()
		->maskEmail();

	$my_sensitive_string = 'My email is roy@trenneman.com and my credit card is 6011792594656742';
	
	echo $magoo->mask($my_sensitive_string);
	// 'My email is ***@trenneman.com and my credit card is ************6742'

### Credit card masking

Credit card masking accepts custom replacement

	$magoo = new Magoo;
	$magoo->maskCreditCard(['replacement' => '$']);
	...

### Email masking 
Email masking accepts replacements for *local* and *domain* part individually.
If you don't provide one, it will mask local part automatically.

	$magoo = new Magoo;
	$magoo->maskEmail(['local_replacement' => '*', 'domain_replacement' => '&']);
	...

###Custom masks
Additionally, you can add your own mask as long as it implements *Maskinterface*.

	$custom_mask = new Mask\Custommask(['replacement' => 'bar']);
	$magoo = new Magoo;
	$magoo->addCustomMask($custom_mask);
	...

#Help
Please report any bug you might find and/or collaborate with your own masks.

Cheers!

<p align="center">
  <img src="http://i.imgur.com/Cxi86gJ.png" alt="Magoo"/>
</p>
	