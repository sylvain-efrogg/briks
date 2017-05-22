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
     * @var array;
     */
    protected $data;


    /**
     * @param $source
     * @return BriksNode
     */
    abstract public function convert();

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

    /**
     * @param array $data
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }


}