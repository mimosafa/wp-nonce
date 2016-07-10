<?php
namespace mimosafa\WP\Nonce;

class Entity {

	private $context = '';

	public function __construct( $context, Factory $factory ) {
		if ( ! $context || ! is_string( $context ) || $context !== esc_attr( $context ) ) {
			throw new \Exception( 'Invalid argument.' );
		}
		$this->context = $context;
	}

	public function nonce_field( $field = '', $referer = true, $echo = true ) {
		$nonce_field = wp_nonce_field( $this->action_str( $field ), $this->name_str( $field ), $referer, false );
		if ( $echo ) {
			echo $nonce_field;
		}
		return $nonce_field;
	}	

	private function name_str( $field = '' ) {
		return $this->create_str( '_', $field, 'nonce' );
	}

	private function action_str( $field = '' ) {
		return $this->create_str( '-', $field, 'action' );
	}

	private function create_str( $strings ) {
		$array = func_get_args();
		$glue = array_shift( $array );
		$pieces = [ $this->context ] + array_filter( $array );
		return implode( $glue, $pieces );
	}

}
