<?php
namespace Efrogg\Briks\Renderers;


use Efrogg\Briks\Core\BriksRenderableInterface;

class BriksRenderer
{

    /**
     * @param BriksRenderableInterface $node
     * @return string
     */
    public function render($node)
    {
        return "coucou";
    }

}