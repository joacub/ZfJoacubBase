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
);