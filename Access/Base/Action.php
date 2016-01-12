<?php

namespace Phine\Framework\Access\Base;
use Phine\Framework\System;

class Action extends System\Enum
{
    static function Read()
    {
        return new static('Read');
    }
    
    static function Create()
    {
        return new static('Create');
    }
    static function Edit()
    {
        return new static('Edit');
    }
    
    static function Delete()
    {
        return new static('Delete');
    }
    
    static function UseIt()
    {
        return new static('UseIt');
    }
}

