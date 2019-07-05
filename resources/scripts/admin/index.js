// eslint-disable-next-line no-unused-vars
import config from '@config';
//import { createHooks } from '@wordpress/hooks';
import '@styles/admin';
// import 'airbnb-browser-shims'; // Uncomment if needed
/**
 * External dependencies.
 */
//import { registerFieldType } from '@carbon-fields/core';
import 'react';
import RoomField from './roomField';

registerFieldType( 'room', RoomField );
