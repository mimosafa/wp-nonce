<?php
namespace mimosafa\WP\Nonce;

class Factory {

	private $instances = [];

	public static function getInstance( $string ) {
		if ( ! $string || ! is_string( $string ) || $string !== esc_attr( $string ) ) {
			throw new \Exception( 'Invalid argument.' );
		}
		if ( ! isset( self::$instances[$string] ) ) {
			self::$instances[$string] = new Entity( $string, $this );
		}
		return self::$instances[$string];
	}

	private function __construct() { /* Singleton */ }

}
