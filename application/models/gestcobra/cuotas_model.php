<?php
namespace gestcobra;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cuotas_model extends \Orm_model {

	public static $table = 'cuotas';

	public static $fields = array(
		array('name' => 'id', 'type' => 'int'),
		array('name' => 'Column1', 'type' => 'string'),
		array('name' => 'Column2', 'type' => 'string'),
		array('name' => 'Column3', 'type' => 'string'),
		array('name' => 'Column4', 'type' => 'string'),
		array('name' => 'Column5', 'type' => 'string'),
		array('name' => 'Column6', 'type' => 'string'),
		array('name' => 'Column7', 'type' => 'string'),
		array('name' => 'Column8', 'type' => 'string'),
		array('name' => 'Column9', 'type' => 'string'),
		array('name' => 'Column10', 'type' => 'string'),
		array('name' => 'Column11', 'type' => 'string'),
		array('name' => 'Column12', 'type' => 'string'),
		
	);

	public static $primary_key = 'id';

	
}

