<?php

namespace MyNotes;


class NoteController
{
    public $noteManager;
    public $noteToEditId = null;
    private $lastId = -1;
    private $notes = [];

    public function __construct()
    {
        $this->noteManager = new NoteManager();
        $this->notes = $this->noteManager->getAllNotes();
        if (!empty($this->notes))
            $this->lastId = end($this->notes)->getId();
    }

    /**
     * Call a view which shows all the notes available
     */
    public function run()
    {
        ob_start();
        require 'view/mainView.php';
        $content = ob_get_clean();

        require 'view/layout/template.php';
    }

    /**
     * @param Note $newNote
     * @throws \Exception
     */
    public function addANewNote(Note $newNote)
    {
        $newNote = $this->noteManager->addANewNote($newNote);
        $this->notes[$newNote->getId()] = $newNote;
    }

    /**
     * @param $noteId
     */
    public function deleteANote($noteId)
    {
        unset($this->notes[$noteId]);
        $this->noteManager->deleteANote($noteId);
    }

    public function editANote(Note $modifiedNote)
    {
        $this->notes[$modifiedNote->getId()] = $this->noteManager->editANote($modifiedNote);
    }

    /**
     * @param $noteId
     * @return Note
     */
    public function getANote($noteId)
    {
        foreach ($this->notes as $note) {
            if ($note->getId() === $noteId) {
                return $note;
            }
        }
    }

    /**
     * @param Note $note
     * @return bool
     */
    public function isTheNoteToEdit(Note $note)
    {
        if ($note->getId() === $this->noteToEditId) {
            return true;
        }
        return false;
    }
}