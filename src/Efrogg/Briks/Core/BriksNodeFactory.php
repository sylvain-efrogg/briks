<?php
/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 11:04
 */

namespace Efrogg\Briks\Core;


use Efrogg\Briks\Core\Exceptions\TypeNotFoundException;

class BriksNodeFactory
{
    /**
     * @var BriksNodeType[]
     */
    protected $types;

    /**
     * @var callable
     */
    protected $factory;

    /**
     * BriksNodeFactory constructor.
     */
    public function __construct()
    {
    }

    public function addType(BriksNodeType $nodeType)
    {
        $this->types[$nodeType->getIdentifier()] = $nodeType;
    }

    public function getType($identifier) {
        if(!isset($this->types[$identifier]) && !is_null($this->factory)) {
            $this->types[$identifier] = call_user_func($this->factory,$identifier);
        }

        if(isset($this->types[$identifier])) {
            return $this->types[$identifier];
        }

        throw new TypeNotFoundException();
    }

    /**
     * @param callable $factory
     * @return BriksNodeFactory
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
        return $this;
    }
}