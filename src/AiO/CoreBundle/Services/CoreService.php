<?php

namespace AiO\CoreBundle\Services;


use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManager;
use MainBundle\Entity\Translate;
use Sonata\MediaBundle\Twig\Extension\MediaExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Parser;


class CoreService
{
    private $em;
    private $extension;
    private $container;

    public function __construct(EntityManager $entityManager, MediaExtension $extension, Container $container)
    {
        $this->em        = $entityManager;
        $this->extension = $extension;
        $this->container = $container;
    }


    public function slug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $cyr = array(
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','ң','о','ө','п',
            'р','с','т','у','ү','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','Ө','П',
            'Р','С','Т','У','Ү','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
        );
        $lat = array(
            'a','b','v','g','d','e','io','zh','z','i','i','k','l','m','n','n','o','o','p',
            'r','s','t','u','u','f','h','ts','ch','sh','sht','','y','','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','I','K','L','M','N','O','O','P',
            'R','S','T','U','U','F','H','Ts','Ch','Sh','Sht','','Y','','E','Yu','Ya'
        );
        $text = str_replace($cyr, $lat, $text);
        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);
        // lowercase
        $text = strtolower($text);

        if (empty($text))
        {
            $datetime = new \DateTime();
            return $datetime->format('Y') . '.html';
        }
        return $text;
    }

    public function merge($entities, $format)
    {
        for ($i = 0; $i < count($entities); $i++) {
            $photos = ['photo_url'];
            foreach ($photos as $photo) {
                $media = $this->em->getRepository('ApplicationSonataMediaBundle:Media')->find($entities[$i][$photo]);
                if ($media) {
                    $url          = $this->extension->path($media, $format);
                    $entities[$i] = array_merge($entities[$i], [$photo => $url]);
                }
            }
        }

        return $entities;
    }

    public function saveFile(File $file, $context)
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');
        $media        = new Media();
        $media->setBinaryContent($file);
        $media->setContext($context);
        $ImagemimeTypes = array('image/jpeg', 'image/png', 'image/jpg');
        if (in_array($file->getMimeType(), $ImagemimeTypes)) {
            $media->setProviderName('sonata.media.provider.image');
        }
        $mediaManager->save($media);

        return $media;
    }


    public function getWord($locale, $attribute, $word = '')
    {

        $text = $this->em->getRepository('MainBundle:Translate')
            ->findOneBy(array('attribute' => $attribute));

        if(!$text){
            $text = new Translate();
            $text->setAttribute($attribute);
            $text->setRu($word);
            $text->setAttribute($attribute);

            $this->em->persist($text);
            $this->em->flush();
        }


        if ($locale == 'ru'){
            return $text->getRu();
        }

        return $text->getKy();
    }
}
