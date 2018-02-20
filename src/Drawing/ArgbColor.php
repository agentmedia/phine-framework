<?php

namespace Phine\Framework\Drawing;

/**
 * An argb color
 */
class ArgbColor
{
    /**
     * Alpha channel
     * @var int
     */
    private $a;

    /**
     * Red color part
     * @var int
     */
    private $r;

    /**
     * Green color part
     * @var int
     */
    private $g;

    /**
     * Blue color part
     * @var int
     */
    private $b;

    /**
     * 
     * @param int $a Opacity part
     * @param int $r Red part
     * @param int $g Green part
     * @param int $b Blue part
     */
    function __construct($a, $r, $g, $b)
    {
        $this->SetAlpha($a);
        $this->SetRed($r);
        $this->SetGreen($g);
        $this->SetBlue($b);
    }

    
    /**
     * Creates color from either short hand like #ff0 or long hex values like #001122
     * with or without leading hash
     * @param string $hex The alpha rgb color hex value
     * @return ArgbColor returns an instance with the defined colors
     */
    static function FromRgbHex($hex)
    {
        $cleanHex = ltrim($hex, '#');
        if (strlen($cleanHex) == 3) {
            $r = hexdec(substr($cleanHex, 0, 1) . substr($cleanHex, 0, 1));
            $g = hexdec(substr($cleanHex, 1, 1) . substr($cleanHex, 1, 1));
            $b = hexdec(substr($cleanHex, 2, 1) . substr($cleanHex, 2, 1));
        }
        else {
            $r = hexdec(substr($cleanHex, 0, 2));
            $g = hexdec(substr($cleanHex, 2, 2));
            $b = hexdec(substr($cleanHex, 4, 2));
        }
        return self::FromRgb($r, $g, $b);
    }
    
    /**
     * Creates color from strings like #00112233 with or without leading hash
     * @param string $hex The rgb color hex calue
     * @return ArgbColor returns the parsed ARGB color
     */
    static function FromArgbHex($hex)
    {
        $cleanHex = ltrim($hex, '#');
        $a = hexdec(substr($cleanHex, 0, 2));
        $r = hexdec(substr($cleanHex, 2, 2));
        $g = hexdec(substr($cleanHex, 4, 2));
        $b = hexdec(substr($cleanHex, 6, 2));
        return new self($a, $r, $g, $b);
    }

    /**
     * Gets full opacity argb color from RGB
     * @param int $r
     * @param int $g
     * @param int $b
     * @return ArgbColor
     */
    static function FromRgb($r, $g, $b)
    {
        return new self(0xff, $r, $g, $b);
    }

    /**
     * Checks color part to be between 0 and 255
     */
    private function CheckColorValue($value)
    {
        if ($value < 0 || $value > 255) {
            throw new \InvalidArgumentException("$value is not a valid color integer between 0 and 255");
        }
    }
    /**
     * Sets opacity
     * @param int $a Alpha channel
     */
    function SetAlpha($a)
    {
        $this->CheckColorValue($a);
        $this->a = $a;
    }

    /**
     * Gets opacity
     * @return int
     */
    function GetAlpha()
    {
        return $this->a;
    }

    /**
     * Sets red color part
     * @param int $r
     */
    function SetRed($r)
    {
        $this->CheckColorValue($r);
        $this->r = $r;
    }

    /**
     * Gets red color part
     * @return int
     */
    function GetRed()
    {
        return $this->r;
    }

    /**
     * Sets green color part
     * @param int $g
     */
    function SetGreen($g)
    {
        $this->CheckColorValue($g);
        $this->g = $g;
    }
    /**
     * Gets green color part
     * @return int
     */
    function GetGreen()
    {
        return $this->g;
    }

    /**
     * Sets blue color part
     * @param int $b The blue color part
     */
    function SetBlue($b)
    {
        $this->CheckColorValue($b);
        $this->b = $b;
    }

    /**
     * Gets blue color part
     * @return int
     */
    function GetBlue()
    {
        return $this->b;
    }

    /**
     * Returns white color
     * @return ArgbColor
     */
    static function White()
    {
        return self::FromRgb(0xff, 0xff, 0xff);
    }
    /**
     * Gets an rgb hex value
     * @param boolean $noHash True if no hash shall be prepended
     * @return string Returns the rgb hex value line #001122
     */
    function ToRgbHex($noHash = false) {
        $result = join('', array($this->IntToHex($this->r), $this->IntToHex($this->g),
            $this->IntToHex($this->b)));
        return $noHash ? $result : '#' . $result;
    }
    
    
    /**
     * Gets an rgb hex value
     * @param boolean $noHash True if no hash shall be prepended
     * @return string Returns the rgb hex value line #001122
     */
    function ToArgbHex($noHash = false) {
        $result = join('', array($this->IntToHex($this->a), $this->IntToHex($this->r),
            $this->IntToHex($this->g), $this->IntToHex($this->b)));
        return $noHash ? $result : '#' . $result;
    }
    
    /**
     * 
     * @param int $color
     * @return string
     */
    private function IntToHex($color)
    {
        $result = dechex($color);
        if (strlen($result) == 1) {
            $result = '0' . $result;
        }
        
        return $result;
    }
    /**
     * Returns black color
     * @return ArgbColor
     */
    static function Black()
    {
        return self::FromRgb(0x00, 0x00, 0x00);
    }
    
    /**
     * Clones this instance, lightens the clone and returns it
     * @param float $amount A value between 0 and 1 defining the amount of lightening
     * @return ArgbColor Returns the lightened color, leaving this instance untouched
     */
    function GetLightened($amount)
    {
        $lightened = clone($this);
        $lightened->Lighten($amount);
        return $lightened;
    }
    
    /**
     * Clones this instance, darkens the clone and returns it
     * @param float $amount A value between 0 and 1 defining the amount of darkening
     * @return ArgbColor Returns the darkened color, leaving this instance untouched
     */
    function GetDarkened($amount)
    {
        $darkened = clone($this);
        $darkened->Darken($amount);
        return $darkened;
    }
    
    /**
     * Lightens up the color by an amount between 0 and 1
     * @param float $amount A value between 0 and 1
     */
    function Lighten($amount)
    {
        $floatAmount = (float)$amount;
        if ($floatAmount < 0 || $floatAmount > 1) {
            throw new \InvalidArgumentException('Colors can be only lightened with amounts between 0 and 1');
        }
        $this->r = $this->LightenColor($this->r, $floatAmount);
        $this->g = $this->LightenColor($this->g, $floatAmount);
        $this->b = $this->LightenColor($this->b, $floatAmount);
    }
    
    /**
     * Lightens up the color by an amount between 0 and 1
     * @param float $amount A value between 0 and 1
     */
    function Darken($amount)
    {
        $floatAmount = (float)$amount;
        if ($floatAmount < 0 || $floatAmount > 1) {
            throw new \InvalidArgumentException('Colors can be only lightened with amounts between 0 and 1');
        }
        $this->r = $this->DarkenColor($this->r, $floatAmount);
        $this->g = $this->DarkenColor($this->g, $floatAmount);
        $this->b = $this->DarkenColor($this->b, $floatAmount);
    }
    
    /**
     * Clones this instance to get an inverted color
     * @return ArgbColor Returns the inverted color, leaving this instance untouched
     */
    function GetInverse()
    {
        $inverse = clone($this);
        $inverse->Invert();
        return $inverse;
    }
    
    /**
     * Inverts the color
     */
    function Invert()
    {
        $this->r = 0xff - $this->r;
        $this->g = 0xff - $this->g;
        $this->b = 0xff - $this->b;
    }
    
    /**
     * Lightens a single color part
     * @param int $color The color part (range 0-255)
     * @param float $amount The amount of lightening (range 0-1)
     * @return int Returns the lightened color
     */
    private function LightenColor($color, $amount)
    {
        $newColor = $color + (0xff - $color) * $amount;
        return min(max(round($newColor), 0x00), 0xff);
    }
    
    /**
     * Adds some red to the color
     * @param float $amount A number between 0 and 1
     */
    function AddRed($amount)
    {
        $this->r = $this->LightenColor($this->r, $amount);
    }
    
    /**
     * Gets a color with more red, leaving this instance untouched
     * @param float $amount A number between 0 and 1
     * @return ArgbColor Returns the changed color
     */
    function GetReder($amount) {
        $added = clone($this);
        $added->AddRed($amount);
        return $added;
    }
    
    
    /**
     * Adds somee green to the color
     * @param float $amount A number between 0 and 1
     */
    function AddGreen($amount)
    {
        $this->g = $this->LightenColor($this->g, $amount);
    }
    
    /**
     * Gets a color with more green, leaving this instance untouched
     * @param float $amount A number between 
     * @return ArgbColor Returns the changed color
     */
    function GetGreener($amount) {
        $added = clone($this);
        $added->AddGreen($amount);
        return $added;
    }
    
    /**
     * Adds somee blue to the color
     * @param float $amount A number between 0 and 1
     */
    function AddBlue($amount)
    {
        $this->b = $this->LightenColor($this->b, $amount);
    }
    
    /**
     * Gets a color with more blue, leaving this instance untouched
     * @param float $amount A number between 0 and 1
     * @return ArgbColor Returns the changed color
     */
    function GetBluer($amount) {
        $added = clone($this);
        $added->AddBlue($amount);
        return $added;
    }
    
    
    /**
     * Removes some red from the color
     * @param float $amount A number between 0 and 1
     */
    function RemoveRed($amount)
    {
        $this->r = $this->DarkenColor($this->r, $amount);
    }
    
    /**
     * Gets a color with less red, leaving this instance untouched
     * @param float $amount A number between 0 and 1
     * @return ArgbColor Returns the changed color
     */
    function GetLessRed($amount) {
        $removed = clone($this);
        $removed->RemoveBlue($amount);
        return $removed;
    }
    
    /**
     * Removes some green from the color
     * @param float $amount A number between 0 and 1
     */
    function RemoveGreen($amount)
    {
        $this->g = $this->DarkenColor($this->g, $amount);
    }
    
    /**
     * Gets a color with less green, leaving this instance untouched
     * @param float $amount A number between 0 and 1
     * @return ArgbColor Returns the changed color
     */
    function GetLessGreen($amount) {
        $removed = clone($this);
        $removed->RemoveGreen($amount);
        return $removed;
    }
    
     /**
     * Removes some blue from the color
     * @param float $amount A number between 0 and 1
     */
    function RemoveBlue($amount)
    {
        $this->b = $this->DarkenColor($this->b, $amount);
    }
    
    /**
     * Gets a color with less blue, leaving this instance untouched
     * @param float $amount A number between 0 and 1
     * @return ArgbColor Returns the changed color
     */
    function GetLessBlue($amount) {
        $removed = clone($this);
        $removed->RemoveBlue($amount);
        return $removed;
    }
    
    
    
    
     /**
     * Darkens a single color part
     * @param int $color The color part (range 0-255)
     * @param float $amount The amount of darkening (range 0-1)
     * @return int Returns the darkened color
     */
    private function DarkenColor($color, $amount)
    {
        $newColor = $color * (1 - $amount);
        return min(max(round($newColor), 0x00), 0xff);
    }
    /**
     * Magic clone method overwritten explicitly
     * @return ArgbColor
     */
    public function __clone()
    {
        return new self($this->a, $this->r, $this->g, $this->b);
    }
}
