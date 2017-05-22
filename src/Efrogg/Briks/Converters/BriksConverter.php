<?php
namespace Efrogg\Briks\Converters;


use Efrogg\Briks\Core\BriksNode;
use Efrogg\Briks\Core\BriksNodeFactory;

abstract class BriksConverter
{

    /**
     * @var BriksNodeFactory
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
     * @return BriksNodeFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param BriksNodeFactory $factory
     * @return self
     */
    public function setFactory($factory)
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