<?php
/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 09:06
 */

namespace Efrogg\Briks\Core;


class BriksField
{

    /**
     * @var string
     */
    protected $name = 'fieldName';

    /**
     * @var
     */
    protected $content;

    /**
     * BriksField constructor.
     * @param string $name
     * @param $content
     */
    public function __construct($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function __toString()
    {
        return $this->content;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }


}