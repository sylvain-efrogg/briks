<?php
namespace Efrogg\Briks\Converters;


use Efrogg\Briks\Core\BriksField;
use Efrogg\Briks\Core\BriksFieldNodeCollection;
use Efrogg\Briks\Core\BriksNode;
use Efrogg\Briks\Core\BriksNodeType;

class BriksArrayConverter extends BriksConverter
{


    /**
     * @param $data
     * @return BriksNode
     */
    public function convert($data)
    {
        foreach ($data['root'] as $key => $values) {
            $type = new BriksNodeType($key);
            $type->setTemplate($key . ".twig");
            foreach ($values as $field => $content) {

                // si c'est un groupe d'image alors je parse chaque image
                if ($field == 'images') {

                    $contentField=$this->parseImage($content);
                    $tab[$field] = $contentField;
                    $brik = new BriksNode($tab, $type);
                    return $brik;

                }

                // si le noeud est de type element je dois reconstruire les briks qui le compose
                if ($field == 'elements') {
                    foreach ($content as $childField ) {

                        foreach ($childField as $idChildValue => $childValues) {
                            $type = new BriksNodeType($idChildValue);
                            $type->setTemplate($idChildValue . ".twig");

                            foreach ( $childValues as $field => $contentChild) {
                                $contentField = $contentChild;

                                // si c'est un groupe d'image alors je parse chaque image
                                if ($field == 'images') {
                                    $contentField = $this->parseImage($contentChild);
                                }
                                $tab[$field] = $contentField;
                            }
                            $brik[] = new BriksNode($tab, $type);
                        }
                    }

                    // reconstitution de l'arbo
                    $page = new BriksFieldNodeCollection('elements', $brik);
                    $typePage = new BriksNodeType('page');
                    $typePage->setTemplate('page' . ".twig");
                    $brik = new BriksNode([$page], $typePage);

                    return $brik;
                }
                $tab[$field] = $content;
            }
            $brik = new BriksNode($tab, $type);
        }

        return $brik;
    }


    /**
     * @param $content
     * @return BriksFieldNodeCollection
     */
    public  function parseImage($content){
        foreach ($content as $image) {
            foreach ($image as $id => $item) {
                $fieldImage = new BriksField($id, $item);
                $imgFields[] = $fieldImage;
            }
            $typeImage = new BriksNodeType('image');
            $typeImage->setTemplate('image' . ".twig");
            $images[] = new BriksNode($imgFields, $typeImage);
        }
        return new BriksFieldNodeCollection('images', $images);
    }

}