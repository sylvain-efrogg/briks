<?php
/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 11:27
 */

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