<?php
/**
 * This class allow us to know if equipment is lower, medium or heavy.
 * To be able to use it, the equipment entity class must extend this class
 * and declare "kind" key in protected $data array.
 * 
 * @author Bertrand Andres
 */
namespace M20Online\Entity;

abstract class EquipmentAbstract extends EntityAbstract
{
    
}