# Partial Helper

## Installation

Download the repository into the the Plugin directory

	cd Plugin
	git clone git://github.com:joeytrapp/partials.git Partials
	
Add the `CakePlugin::load()` in the application `bootstrap.php`.

	echo "CakePlugin::load("Partials");" >> Config/bootstrap.php

Load the helper so it will be available in views

	public $helpers = array("Html", "Form", "Partials.Partial");

## Methods

### PartialHelper::render(string $name, array $data, array $options)

Renders an element relative to the View::viewPath instead of View/Elements. Assumes the element file begins with an underscore.

	<?php echo $this->Partial->render("form"); ?>

Will look for \_form.ctp in the View::viewPath (for /posts/add it would be View/Posts/\_form.ctp).

The $data and $options params are passed on to `View::element()` method. An additional option is "collection". If "collection" is an array, then the `View::element()` will be called for each iteration of the "collection" array. The value of the current iteration is merged in the data array under the element name (without the underscore) key.

	<?php echo $this->Partial->render("post", array(), array("collection" => $posts)); ?>

This will render the `_post.ctp` element for each value in $posts, and set a the value in $posts for this iteration to the "post" key in the data array.