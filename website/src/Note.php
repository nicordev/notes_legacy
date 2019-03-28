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
    private $status;
    private $title;
    private $content;

    /**
     * Note constructor.
     * @param array $data
     * @throws Exception
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            if (isset($data['n_id']))
                $this->id = (int) $data['n_id'];

            if (isset($data['n_creation_date']))
                $this->creationDate = htmlspecialchars($data['n_creation_date']);

            if (isset($data['n_modification_date']))
                $this->modificationDate = htmlspecialchars($data['n_modification_date']);

            if (isset($data['n_title']))
                $this->title = htmlspecialchars($data['n_title']);

            if (isset($data['n_content']))
                $this->content = htmlspecialchars($data['n_content']);

            if (isset($data['n_status']))
                $this->status = htmlspecialchars($data['n_status']);

        } else {
            throw new Exception('Le tableau $data est vide.');
        }
    }

    /**
     * @return string
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return string
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param string $modificationDate
     */
    public function setModificationDate(string $modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * @return string
     */
    public function getTitle()
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
    public function getContent()
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

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

}