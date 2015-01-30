<?php
return array(
	'doctrine' => array(
		'configuration' => array(
			'orm_default' => array(
				'string_functions' => array(
					'REGEXP' =>  'JoacubBase\Doctrine\Query\Mysql\Regexp'
				)
			)
		),
	),
	'joacub-base' => array(
		'doctrine' => array(
			'table_prefix' => null
		)
	)
);


