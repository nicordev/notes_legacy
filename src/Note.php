<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 21/01/2019
 * Time: 09:03
 */

namespace MyNotes;

use \Exception;

class Note
{
    private $id;
    private $creationDate;
    private $modificationDate;
    private $title = '';
    private $content = '';

    /**
     * Note constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            if (isset($data['n_id']))
                $this->id = htmlspecialchars($data['n_id']);

            if (isset($data['n_creation_date']))
                $this->creationDate = htmlspecialchars($data['n_creation_date']);

            if (isset($data['n_modification_date']))
                $this->modificationDate = htmlspecialchars($data['n_modification_date']);

            if (isset($data['n_title']))
                $this->title = htmlspecialchars($data['n_title']);

            if (isset($data['n_content']))
                $this->content = htmlspecialchars($data['n_content']);
        } else {
            throw new Exception('Le tableau $data est vide.');
        }
    }

    /**
     * @return string
     */
    public function getCreationDate(): ?string
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return string
     */
    public function getModificationDate(): ?string
    {
        return $this->modificationDate;
    }

    /**
     * @param string $modificationDate
     */
    public function setModificationDate(string $modificationDate): void
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * @return string
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent() : ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}