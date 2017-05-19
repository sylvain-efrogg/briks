<?php
namespace Efrogg\Briks\Test;

use Efrogg\Briks\Converters\BriksArrayConverter;
use Efrogg\Briks\Core\BriksField;
use Efrogg\Briks\Core\BriksFieldNode;
use Efrogg\Briks\Core\BriksFieldNodeCollection;
use Efrogg\Briks\Core\BriksNode;
use Efrogg\Briks\Core\BriksNodeFactory;
use Efrogg\Briks\Core\BriksNodeType;
use Efrogg\Briks\Core\BriksRenderer;
use Efrogg\Briks\Renderers\BriksRendererTwig;
use Twig_Environment;
use Twig_Function;
use Twig_Loader_Filesystem;

/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 09:51
 */
class TestBriks
{


    public function gogogo() {
        $client = new \Contentful\Delivery\Client('d355de2098c98a7c3d920041a33d95e716af3c6b0b718f24b0397ed6bf2c374b', 'eeq34awp3bfq');
        $entries = $client->getEntries();
        $items=$entries->getIterator();
       var_dump($items);exit;

        $typeImage = new BriksNodeType("image");
        $typeImage->setTemplate("image.twig");

        $typeColonnes = new BriksNodeType("2colonnes");
        $typeColonnes->setTemplate("2colonnes.twig");

        $typeGalerie = new BriksNodeType("gallery");
        $typeGalerie ->setTemplate("gallery.twig");

        $nodeFactory = new BriksNodeFactory();
//        $nodeFactory->addType($typeImage);
        $nodeFactory->addType($typeColonnes);
        $nodeFactory->addType($typeGalerie);
        // si on demande un type non prédéfini
        $nodeFactory->setFactory(function($identifier) {
            $type = new BriksNodeType($identifier);
            $type ->setTemplate("blocks/".$identifier.".twig");
        });


        $data_array = [
            "titre" => "titre de ma galerie",
            "texte" => "le texte de ma galerie",
            "image1" => [
                "_type"=>"image",
                "content"=>["image" => "tutu.jpg","alt"=>"alt"]
            ],
            "images" => [
                [
                    "_type"=>"image",
                    "content"=>["image" => "tutu1.jpg","alt"=>"alt"]
                ],
                [
                    "_type"=>"image",
                    "content"=>["image" => "tutu2.jpg","alt"=>"alt"]
                ],
                [
                    "_type"=>"image",
                    "content"=>["image" => "tutu3.jpg","alt"=>"alt"]
                ],
            ]
        ];

        $converter = new BriksArrayConverter();
        $converter
            ->setFactory($nodeFactory)
            ->setData($data_array);
        $rootNode = $converter->convert();  // TODO



        $data = [
            "titre" => new BriksField("titre","titre de ma galerie"),
            "texte" => new BriksField("texte","le texte de ma galerie"),
            "image" => new BriksFieldNode("image",new BriksNode(["image" => "tutu.jpg","alt"=>"alt"],$typeImage)),
            "galerie" => new BriksFieldNodeCollection(
                "galerie",
                [
                    new BriksNode(["image" => "tutu1.jpg","alt"=>"alt1"],$typeImage),
                    new BriksNode(["image" => "tutu2.jpg","alt"=>"alt2"],$typeImage),
                    new BriksNode(["image" => "tutu3.jpg","alt"=>"alt3"],$typeImage)
                ])
        ];
        $rootNode = new BriksNode($data,$typeGalerie);


        $renderer = new BriksRendererTwig();
        $twig = new Twig_Environment(new Twig_Loader_Filesystem("../tests/templates"),["debug"=>true]);
        $twig->addExtension(new \Twig_Extension_Debug());
        $twig->enableDebug();
        $renderer->setTwigEnvironment($twig);

        return $renderer->render($rootNode);

    }
}