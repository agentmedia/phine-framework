<?php
namespace Phine\Framework\Database\Interfaces;

interface IDatabaseFieldInfo
{
    /**
     * The field name
     * @return string Returns the field name
     */
    public function Name();
    
    /**
     * Returns the key info, if key given
     * @return IDatabaseKeyInfo
     */
    public function KeyInfo();
    
    /**
     * The foreign key
     * @return IDatabaseForeignKey
     */
    public function ForeignKey();
    
    
    /**
     * The foreign key constraint
     * @return IDatabaseConstraint
     */
    public function ForeignKeyConstraint();
    
    
    /**
     * Is the field nullable?
     * @return bool
     */
    public function IsNullable();
    
   
    /**
     * Returns database type definition.
     * @return IDatabaseTypeDef
     */
    function  GetTypeDef();
    
    /**
     * Gets the default value
     * @return string
     */
    function DefaultValue();
}