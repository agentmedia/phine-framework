<?php
namespace Phine\Framework\FormElements\Interfaces;

interface IFormFieldRenderer
{
    function Render($name, $value = '');
}