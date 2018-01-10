<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 26/10/2017
 * Time: 09:55
 */

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Image")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{

    use Id;

    /**
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var UploadedFile file
     */
    private $file;

    private $tempFileName;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Offer", inversedBy="image")
     */
    private $offer;

    public function __construct(Offer $offer = null)
    {
        if ($offer !== null) {
            $this->setOffer($offer);
        }
    }
    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        //On vérifie si il existe déja un fichier pour cette entité
        if (null !== $this->url) {
            //on sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->tempFileName = $this->url;

            //on réinitialise les valeurs d'url et alt
            $this->url = null;
            $this->alt = null;
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */

    public function preUpload()
    {
        // Si jamais il n'y a pas de fichier, on ne fait rien
        if (null === $this->file) {
            $this->url = 'url';
            $this->alt = 'alt';

            return;
        }

        // Le nom du fichier est son id, on doit juste stocker également son extension
        // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
        $this->url = $this->file->guessExtension();

        //Et on génére l'attribut alt de la balise <img>, à la valeur du nom du fichier  pour les autre visiteurs du site
        $this->alt = $this->file->getClientOriginalName();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */

    public function upload()
    {
        //Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
            return;
        }

        //Si on a un ancien fichier, on le supprime
        if (null !== $this->tempFileName) {
            $oldfile = $this->getUploadDir() . '/' . $this->id . '.' . $this->tempFileName;
            if (file_exists($oldfile)) {
                unlink($oldfile);
            }
        }

        //On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move(
            $this->getUploadRootDir(), // le répertoire de destination
            $this->id.'.'.$this->url   // le nom du fichier à créer, ici << id.extension >>
        );
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload(){
        //on sauvegarde temporairement le nom du fichier, car il dépend de l'id
        $this->tempFileName = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload(){
        //En PostRemove, on n'a pas accés à l'id, on utilise notre nom sauvegardé
        if (file_exists($this->tempFileName)){
            unlink($this->tempFileName);
        }
    }

    public function getUploadDir()
    {
        //on retourne le chemin relatif vers l'image pour un navigateur
        return 'img/upload/offer';
    }

    protected function getUploadRootDir()
    {
        //on retourne le chemin relatif vers l'image
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    public function getWebPath(){
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
    }

    /**
     * Set offer
     *
     * @param \AppBundle\Entity\Offer $offer
     *
     * @return Image
     */
    public function setOffer(\AppBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \AppBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
