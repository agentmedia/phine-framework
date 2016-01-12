<?php

namespace Phine\Framework\FormElements\RichTextEditor;

use Phine\Framework\System\IO;
use Phine\Framework\FormElements\Interfaces as FormInterfaces;
use Phine\Framework\Access\Base\Guard;
use Phine\Framework\Access\Base\Action;
use Phine\Framework\Access\Base\GrantResult;

class CKEditorRenderer implements FormInterfaces\IFormFieldRenderer
{

    /**
     * The folder of the ck editor
     * @var string
     */
    private $baseUrl;
    


    /**
     *
     * @var string
     */
    private $uploadDir;

    /**
     *
     * @var string
     */
    private $uploadUrl;

    /**
     *
     * @var Guard
     */
    private $guard;

    /**
     * Various CK editor settings
     * @var array
     */
    private $config;

   
    /**
     * 
     * @param stirng $basePath The base (parent) server path of both ckeditor and kcfinder folders
     * @param string $baseUrl The base (parent) url of both ckeditor and kcfinder folders
     * @param string $uploadDir The server directory of the upload folder
     * @param string $uploadUrl The url of the upload folder
     * @param Guard $guard
     * @param array $config
     */
    function __construct($basePath, $baseUrl, $uploadDir, $uploadUrl, Guard $guard, array $config = array())
    {
        //Load CKEditor class
        require_once IO\Path::Combine($basePath, 'ckeditor/ckeditor.php');
        $this->baseUrl = $baseUrl;
        $this->uploadDir = $uploadDir;
        $this->uploadUrl = $uploadUrl;
        $this->guard = $guard;
        $this->config = $config;
    }

    /**
     * Renders the rich text editor.
     * @param string $name
     * @param string $value
     */
    function Render($name, $value = '')
    {
        $baseUrl = $this->baseUrl;

        $grantResult = $this->guard->Grant(Action::UseIt(), $this);
        $disabled = ((string) $grantResult != (string) GrantResult::Allowed());

        $_SESSION['KCFINDER']['disabled'] = $disabled;
        $_SESSION['KCFINDER']['uploadURL'] = $this->uploadUrl;
        $_SESSION['KCFINDER']['uploadDir'] = $this->uploadDir;
        
        $oCKeditor = new \CKEditor();
        $oCKeditor->basePath = IO\Path::Combine($baseUrl, 'ckeditor/');
        $oCKeditor->config['skin'] = 'v2';
        $oCKeditor->config['filebrowserBrowseUrl'] = IO\Path::Combine($baseUrl, 'kcfinder/browse.php?type=files');
        $oCKeditor->config['filebrowserImageBrowseUrl'] = IO\Path::Combine($baseUrl, 'kcfinder/browse.php?type=images');
        $oCKeditor->config['filebrowserFlashBrowseUrl'] = IO\Path::Combine($baseUrl, 'kcfinder/browse.php?type=flash');
        $oCKeditor->config['filebrowserUploadUrl'] = IO\Path::Combine($baseUrl, 'kcfinder/upload.php?type=files');
        $oCKeditor->config['filebrowserImageUploadUrl'] = IO\Path::Combine($baseUrl, 'kcfinder/upload.php?type=images');
        $oCKeditor->config['filebrowserFlashUploadUrl'] = IO\Path::Combine($baseUrl, 'kcfinder/upload.php?type=flash');
        foreach ($this->config as $key => $val)
        {
            $oCKeditor->config[$key] = $val;
        }
        ob_start();
        echo '<div class="phine-cke">';
        $oCKeditor->editor($name, $value);
        echo '</div>';
        return ob_get_clean();
    }

}
