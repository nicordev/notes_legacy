<?php

namespace MyNotes;


class Application
{
    public function run()
    {
        $noteController = new NoteController();
        $noteToEdit = null;

        // Router

        if (isset($_POST['add_a_note'])) {
            $newNote = new Note($_POST);
            $noteController->addANewNote($newNote);
        }

        if (isset($_POST['edit_this_note'])) {
            $noteController->noteToEdit = $noteController->getANote($_POST['edit_this_note']); // Improve : Mettre l'id
        }

        if (isset($_POST['save_modifications'])) {
            $noteController->noteManager->editANote(new Note($_POST)); // WIP : Faire la méthode dans le controller
        }

        if (isset($_POST['delete_a_note'])) {
            $noteController->noteManager->deleteANote($_POST['n_id']);
        }

        // Controller

        $noteController->run();
    }
}