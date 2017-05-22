<?php
namespace Efrogg\Briks\Core;


class BriksFieldNodeCollection extends BriksField implements BriksRenderableInterface, BriksIterable
{
    use BriksNodeTrait;

    /**
     * @var int
     * index de l'iterateur
     */
    private $position = 0;


    /** @var BriksNode[] */
    protected $content = [];

    /**
     * BriksField constructor.
     * @param string $name
     * @param BriksNode[] $content
     */
    public function __construct($name, array $content)
    {
        //TODO : check children
        parent::__construct($name, []);
        foreach ($content as $oneContent) {
            $this->addNode($oneContent);
        }
    }


    public function addNode(BriksNode $node)
    {
        $this->content[] = $node;
    }


    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->content[$this->position];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
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
        return isset($this->content[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->position = 0;
    }
}