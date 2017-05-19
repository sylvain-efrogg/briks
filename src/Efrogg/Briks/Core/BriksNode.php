<?php

namespace Efrogg\Briks\Core;
/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 09:04
 */
class BriksNode
{
    /**
     * @var BriksField[]
     */
    protected $fields = [];

    /**
     * @var BriksNodeType
     */
    protected $nodeType;



    /**
     * BriksNode constructor.
     * @param array $fields
     */
    public function __construct(array $data = [],BriksNodeType $nodeType)
    {
        $this->nodeType = $nodeType;
        foreach ($data as $fieldName => $content) {
            if($content instanceof BriksField) {
                $this->addField($content);
            } else {
                $this->addField(new BriksField($fieldName,$content));
            }
        }
    }



    /**
     * @param BriksField $field
     */
    public function addField(BriksField $field) {
        $this->fields[$field->getName()] = $field;
    }


    /**
     * @return BriksNodeType
     */
    public function getNodeType()
    {
        return $this->nodeType;
    }

    /**
     * @param BriksNodeType $nodeType
     */
    public function setNodeType($nodeType)
    {
        $this->nodeType = $nodeType;
    }

    /**
     * @return BriksField[]
     */
    public function getFields()
    {
        return $this->fields;
    }
}