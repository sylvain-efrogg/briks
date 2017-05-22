<?php
namespace Efrogg\Briks\Core;


class BriksNodeType
{
    /**
     * @var
     */
    protected $template;

    /**
     * @var
     */
    protected $identifier;

    /**
     * BriksNodeType constructor.
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }


    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }


}