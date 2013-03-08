<?php
namespace JoacubBase\Gedmo\Sluggable;

class SluggableListener extends \Gedmo\Sluggable\SluggableListener
{

    public function __construct()
    {
        $this->setTransliterator(
            array(
                '\JoacubBase\Gedmo\Sluggable\Utils\Transliterator', 
                'transliterate'
            ));
    }
}