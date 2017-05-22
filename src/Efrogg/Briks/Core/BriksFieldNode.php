<?php
namespace Efrogg\Briks\Core;


class BriksFieldNode extends BriksField implements BriksRenderableInterface, BriksIterable
{

    /** @var  BriksNode */
    protected $content;

    /**
     * BriksFieldNodeInterface constructor.
     * @param BriksNode $node
     */
    public function __construct($name, BriksNode $node)
    {
        parent::__construct($name, $node);
        $this->content = $node;
    }


    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->content;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return 0;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return !is_null($this->content);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
    }

    function __isset($fieldName)
    {
        dump($fieldName);
        return $this->content->hasField($fieldName);
    }

    function __get($fieldName)
    {
        // getImage => image
        return $this->content->getField($fieldName);
    }


}