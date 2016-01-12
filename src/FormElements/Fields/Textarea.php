<?php

namespace Phine\Framework\FormElements\Fields;

/** 
 * 
 * Represents a textarea field
 */
class Textarea extends FormField
{
    /**
     * Shortcut to set the rows attribute
     * @param int $rows The amount of reserved rows in the textarea
     */
    public function SetRows($rows)
    {
        $this->SetHtmlAttribute('rows', $rows);
    }
    
    /**
     * Sets the cols attribute
     * @param int $cols The amount of reserved columns in the textarea
     */
    public function SetCols($cols)
    {
        $this->SetHtmlAttribute('cols', $cols);
    }
}
