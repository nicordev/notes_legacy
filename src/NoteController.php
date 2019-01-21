<?php

namespace MyNotes;


class NoteController
{
    public $noteManager;
    public $noteToEdit = null;
    private $notes = [];

    public function __construct()
    {
        $this->noteManager = new NoteManager();
        $this->notes = $this->noteManager->getAllNotes();
    }

    /**
     * Call a view which shows all the notes available
     */
    public function run()
    {
        ob_start();
        require 'view/mainView.php';
        $content = ob_get_clean();

        require 'view/template.php';
    }

    /**
     * @param Note $newNote
     */
    public function addANewNote(Note $newNote)
    {
        $this->notes[] = $newNote;
        $this->noteManager->addANewNote($newNote);
    }

    /**
     * @param $noteId
     */
    public function deleteANote($noteId)
    {
        unset($this->notes[$noteId]);
        $this->noteManager->deleteANote($noteId);
    }

    /**
     * @param $noteId
     * @return Note
     */
    public function getANote($noteId) : Note
    {
        foreach ($this->notes as $note) {
            if ($note->getId() === $noteId) {
                return $note;
            }
        }
    }
}