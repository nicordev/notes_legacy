<?php

namespace MyNotes;


/**
 * Class NoteController
 * @package MyNotes
 */
class NoteController
{
    /**
     * @var NoteManager
     */
    public $noteManager;

    /**
     * NoteController constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->noteManager = new NoteManager();
    }

    /**
     * Call a view which shows all the notes available
     */
    public function showAllNotes(int $noteToEditId = null)
    {
        $notes = $this->noteManager->getAllNotes(false, true, self::getFilter());

        ob_start();
        require ROOT_PATH . '/view/mainView.php';
        $content = ob_get_clean();

        require ROOT_PATH . '/view/layout/template.php';
    }

    /**
     * @param Note $newNote
     * @throws \Exception
     */
    public function addANewNote(Note $newNote)
    {
        $this->noteManager->addANewNote($newNote);
        $this->showAllNotes();
    }

    /**
     * @param $noteId
     */
    public function deleteANote($noteId)
    {
        $this->noteManager->deleteANote($noteId);
        $this->showAllNotes();
    }

    /**
     * @param Note $modifiedNote
     * @throws \Exception
     */
    public function editANote(Note $modifiedNote)
    {
        $this->noteManager->editANote($modifiedNote);
        $this->showAllNotes();
    }

    /**
     * @param $noteId
     * @return Note
     */
    public function getANote($noteId)
    {
        return $this->getANote($noteId);
    }

    /**
     * Get a filter to show some particular notes
     *
     * @return string|null
     */
    private static function getFilter()
    {
        if (isset($_GET['filter']) && $_GET['filter'] === "all") {
            return null;
        } else {
            return "new";
        }
    }
}