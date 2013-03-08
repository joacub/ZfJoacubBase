<?php

namespace JoacubBase\Gedmo\Sluggable\Utils;

/**
 * This is the part taken from Doctrine 1.2.3
 * Doctrine inflector has static methods for inflecting text
 *
 * The methods in these classes are from several different sources collected
 * across several different php projects and several different authors. The
 * original author names and emails are not known
 *
 * Uses 3rd party libraries and functions:
 *         http://sourceforge.net/projects/phputf8
 *
 * @package     Gedmo.Sluggable.Util
 * @subpackage  Urlizer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision: 3189 $
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @author      Jonathan H. Wage <jonwage@gmail.com>
 * @author         <hsivonen@iki.fi>
 */
class Transliterator
{
    

    /**
     * Uses transliteration tables to convert any kind of utf8 character
     *
     * @param string $text
     * @param string $separator
     * @return string $text
     */
    public static function transliterate($text, $separator = '-')
    {
        return strip_tags(str_replace(array('<br>', '<br/>'), array($separator, $separator), $text));
    }

    
}
