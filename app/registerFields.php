<?php

use Carbon_Fields\Carbon_Fields;
use App\Field\Room_Field;

Carbon_Fields::extend( Room_Field::class, function( $container ) {
	return new Room_Field(
		$container['arguments']['type'],
		$container['arguments']['name'],
		$container['arguments']['label']
	);
} );
