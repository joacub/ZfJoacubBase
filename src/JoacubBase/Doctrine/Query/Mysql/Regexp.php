<?php

/**
 * DoctrineExtensions Mysql Function Pack
*
* LICENSE
*
* This source file is subject to the new BSD license that is bundled
* with this package in the file LICENSE.txt.
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to kontakt@beberlei.de so I can send you a copy immediately.
*/

namespace JoacubBase\Doctrine\Query\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
Doctrine\ORM\Query\Lexer;

class Regexp extends FunctionNode
{

 	public $regexpExpression = null;
    public $valueExpression = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); 
        $parser->match(Lexer::T_OPEN_PARENTHESIS); 
        $this->regexpExpression = $parser->StringPrimary(); 
        $parser->match(Lexer::T_COMMA); 
        $this->valueExpression = $parser->StringExpression(); 
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); 
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
    	exit;
        return '(' . $this->valueExpression->dispatch($sqlWalker) . ' REGEXP ' . 
            $sqlWalker->walkStringPrimary($this->regexpExpression) . ')'; 
    }

}