<?php
namespace Efrogg\Briks\Core;

class BriksNode implements BriksRenderableInterface
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
    public function __construct(array $data = [], BriksNodeType $nodeType)
    {
        $this->nodeType = $nodeType;
        foreach ($data as $fieldName => $content) {
            if ($content instanceof BriksField) {
                $this->addField($content);
            } else {
                $this->addField(new BriksField($fieldName, $content));
            }
        }
    }


    /**
     * @param BriksField $field
     */
    public function addField(BriksField $field)
    {
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

    /**
     * @return BriksField
     */
    public function getField($Field_name)
    {
        return $this->fields[$Field_name];
    }

    /**
     * @return bool
     */
    public function hasField($Field_name)
    {
        return array_key_exists($Field_name,$this->fields);
    }

    function __get($name)
    {
        return $this->getField($name);
    }

    function __isset($name)
    {
        return $this->hasField($name);
    }


}