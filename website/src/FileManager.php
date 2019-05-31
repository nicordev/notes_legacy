<?php

namespace MyNotes;

class FileManager
{
    /**
     * @var string
     */
    private $fileName;
    /**
     * @var string
     */
    private $folder = "notes";

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param string $content
     */
    public function editFile(string $content)
    {
        file_put_contents($this->getFilePath(), $content);
    }

    /**
     * @return string
     */
    private function getFilePath()
    {
        return $this->folder . "/" . $this->fileName;
    }
}