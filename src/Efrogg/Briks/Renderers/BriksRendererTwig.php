<?php

namespace Efrogg\Briks\Renderers;

use Efrogg\Briks\Core\BriksField;
use Efrogg\Briks\Core\BriksFieldNode;
use Efrogg\Briks\Core\BriksFieldNodeCollection;
use Efrogg\Briks\Core\BriksFieldNodeInterface;
use Efrogg\Briks\Core\BriksNode;
use Twig_Function;

/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 11:30
 */
class BriksRendererTwig extends BriksRenderer
{
    /**
     * @var \Twig_Environment;
     */
    protected $twig_environment;

    public function setTwigEnvironment(\Twig_Environment $twig)
    {
        $renderer = $this;
        $twig -> addFunction(new Twig_Function("render",function($node) use ($renderer) {
            return $renderer->render($node);
        }));

        $this->twig_environment = $twig;

    }

    /**
     * @param BriksRenderableInterface $node
     * @return string
     */
    public function render($field)
    {

        if($field instanceof BriksFieldNodeCollection) {
            $content = "";
            foreach ($field as $node) {
                $content .= $this->render($node);
            }
            return $content;
        } elseif($field instanceof BriksFieldNode) {
            $node = $field->getContent();
            return $this->twig_environment->render(
                $node->getNodeType()->getTemplate(),
                $node->getFields()
            );
        } elseif($field instanceof BriksNode) {
            return $this->twig_environment->render(
                $field->getNodeType()->getTemplate(),
                $field->getFields()
            );
        }
        return "[null]";    //todo si debug
    }
}