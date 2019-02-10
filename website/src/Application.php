<?php

namespace MyNotes;


class Application
{
    public function run()
    {
        $noteController = new NoteController();
        $noteToEdit = null;

        // Router

        // Add a note
        if (isset($_POST['add_a_note']) && !empty($_POST['n_title'])) {
            $newNote = new Note($_POST);
            $noteController->addANewNote($newNote);

        // Edit a note
        } elseif (isset($_POST['edit_this_note'])) {
            $noteController->showAllNotes((int) $_POST['edit_this_note']);

        // Update a note in the database
        } elseif (isset($_POST['save_modifications']) && !empty($_POST['n_title'])) {
            $noteController->editANote(new Note($_POST));

        // Delete a note
        } elseif (isset($_POST['delete_a_note'])) {
            $noteController->deleteANote($_POST['n_id']);
        } else {
            $noteController->showAllNotes();
        }
    }
}