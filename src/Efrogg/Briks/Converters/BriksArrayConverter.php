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
            foreach ($values as $field => $content) {
                //TODO : tous les types depuis la factory

                $type= $this->factory->getType($key);
//                $type = new BriksNodeType($key);
//                $type->setTemplate($key . ".twig");

                // si c'est un groupe d'image alors je parse chaque image
                if ($field == 'images') {
                    $contentField=$this->parseImage($content);
                    $tab[$field] = $contentField;
                    $brik = new BriksNode($tab, $type);
                    return $brik;
                }

                // si le noeud est de type elements je dois reconstruire les briks qui le compose
                if ($field == 'elements') {
                        return $this->imbricatedNode($content,$field);
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




    /**
     * @param $content
     * @param null $namePage
     * @param bool $recurcif
     * @return BriksNode
     */
    public function imbricatedNode($content,$namePage=null,$recurcif=false){
        foreach ($content as $key=>$childField ) {
            if(count($childField)>1){
                $arrayGetName = explode('|', $key);
                $NewName = $arrayGetName[0];
                $brik[]=$this->imbricatedNode($childField,$NewName,true);
            }else {
                foreach ($childField as $idChildValue => $childValues) {
                    foreach ($childValues as $field => $contentChild) {
                        if (substr($idChildValue, 0, 5) == 'image') {
                            $type = new BriksNodeType('image');
                            $type->setTemplate("image.twig");
                        } else {
                            $type = new BriksNodeType($field);
                            $type->setTemplate(substr($idChildValue, 0, strlen($idChildValue)) . ".twig");
                        }
                        $contentField = $contentChild;

                        // si c'est un groupe d'image alors je parse chaque image
                        if ($field == 'images') {
                            $contentField = $this->parseImage($contentChild);
                        }
                        $oldField[] = $field;
                        $tab[$field] = $contentField;
                    }
                    $brik[] = new BriksNode($tab, $type);
                    // clear du tableau pour eviter de cummuler les champs dans les nodes
                    foreach ($oldField as $ToDeleteField) {
                        unset($tab[$ToDeleteField]);
                    }
                }
            }
        }

        // reconstitution de l'arbo
        $page = new BriksFieldNodeCollection($namePage, $brik);

        // si c'est le premier appel a cette fonction alors je cree le noeud page
        if($recurcif==false){
            $typePage = new BriksNodeType('page');
            $typePage->setTemplate('page' . ".twig");
        }
        // sinon je cree les noeuds enfants de page
        else{

            $typePage = new BriksNodeType($namePage);
            $typePage->setTemplate($namePage . ".twig");
        }
        $returnBrik = new BriksNode([$page], $typePage);
        return $returnBrik;
    }

}
