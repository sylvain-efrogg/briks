<?php
namespace Efrogg\Briks\Converters;


use Efrogg\Briks\Core\BriksNode;
use Efrogg\Briks\Core\BriksNodeTypeFactory;

abstract class BriksConverter
{

    /**
     * @var BriksNodeTypeFactory
     */
    protected $factory;


    /**
     * @param $data
     * @return BriksNode
     */
    abstract public function convert($data);

    /**
     * @return BriksNodeTypeFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param BriksNodeTypeFactory $factory
     * @return self
     */
    public function setFactory(BriksNodeTypeFactory $factory)
    {
        $this->factory = $factory;

        return $this;
    }

}