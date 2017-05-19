<?php
/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 09:31
 */

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