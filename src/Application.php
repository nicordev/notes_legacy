<?php

namespace MyNotes;


class Application
{
    public function run()
    {
        $noteController = new NoteController();
        $noteToEdit = null;

        // Router

        if (isset($_POST['add_a_note']) && !empty($_POST['n_title'])) {
            $newNote = new Note($_POST);
            $noteController->addANewNote($newNote);
        }

        if (isset($_POST['edit_this_note'])) {
            $noteController->noteToEditId = htmlspecialchars($_POST['edit_this_note']);
        }

        if (isset($_POST['save_modifications']) && !empty($_POST['n_title'])) {
            $noteController->editANote(new Note($_POST));
        }

        if (isset($_POST['delete_a_note'])) {
            $noteController->deleteANote($_POST['n_id']);
        }

        // Controller

        $noteController->run();
    }
}