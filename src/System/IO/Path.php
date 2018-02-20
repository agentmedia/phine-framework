<?php

namespace Phine\Framework\System\IO;

use Phine\Framework\System;

class Path
{
    /**
     * Returns file extension without leading dot.
     * @param string $path
     * @return string
     */ 
    static function Extension($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
   
   /**
    * Returns filename without extension
    * @param string $path
    * @return string Returns the filename with stripped extension
    */
    static function FilenameNoExtension($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }
   
   /**
    * Returns filename with extension.
    * @param string $path
    * @return string
    */
    static function Filename($path)
    {
        return pathinfo($path, PATHINFO_BASENAME);
    }
    
    /**
     * Returns directory name 
     * @param $path
     * @return string
     */
    static function Directory($path)
    {
        return pathinfo($path, PATHINFO_DIRNAME);
    }
    /**
     * Returns canonical, absolute path if file (or directory) exists, false otherwise.
     * @param string $path
     * @return string|bool
     */
    static function Absolute($path)
    {
        return realpath($path);
    }
    
    /**
     * Combines the paths. 
     * @param string $path1
     * @param string $path2
     * @return string
     */
    static function Combine($path1, $path2)
    {
        $trimChars = '/';
        if (PATH_SEPARATOR != $trimChars)
            $trimChars .= PATH_SEPARATOR;
        
        $clean1 = System\Str::TrimRight($path1, $trimChars);
        $clean2 = System\Str::TrimLeft($path2, $trimChars);
        return join('/', array($clean1, $clean2));
    }
    /**
     * Removes extension from path.
     * @param string $path
     * @return string
     */
    static function RemoveExtension($path)
    {
        $ext = self::Extension($path);
        if ($ext)
        {
            $newLength = System\Str::Length($path) - 
                System\Str::Length($ext) - 1; //dot length = 1!

            return System\Str::Start($path, $newLength);
        }
        return $path;
    }
    /**
     * Adds given extension, leading dot is optional.
     * @param string $path
     * @param string $extension
     * @param bool $replaceExisting If true and extension exists, it is replaced. 
     * @return string
     */
    static function AddExtension($path, $extension, $replaceExisting = false)
    {
        $result = $path;
        if ($replaceExisting)
        {
            $result = self::RemoveExtension($path);
        }
        if (!$extension) {
            return $result;
        }
        return join('.', array($result, System\Str::TrimLeft($extension, '.')));
    }
}
