<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 21/01/2019
 * Time: 09:12
 */

namespace MyNotes;


use PDO;

class NoteManager
{
    /**
     * @var bool|PDO
     */
    private $db;

    /**
     * NoteManager constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->db = Database::getPdo();
    }


    /**
     * Get saved notes from the database
     *
     * @param bool $orderByModificationDate
     * @param bool $desc
     * @return array notes
     * @throws \Exception
     */
    public function getAllNotes(bool $orderByModificationDate = false, bool $desc = true)
    {
        if ($orderByModificationDate) {
            $orderBy = 'n_modification_date';
        } else {
            $orderBy = 'n_creation_date';
        }
        $notes = [];
        $query = 'SELECT * FROM dn_note ORDER BY ' . $orderBy;

        if ($desc) {
            $query .= ' DESC';
        }

        $requestAll = $this->db->query($query);

        while($noteData = $requestAll->fetch(PDO::FETCH_ASSOC)) {
            $notes[] = new Note($noteData);
        }

        return $notes;
    }

    /**
     * Add a new note in the database.
     *
     * @param Note $newNote
     * @return Note
     * @throws \Exception
     */
    public function addANewNote(Note $newNote)
    {
        $query = 'INSERT INTO dn_note(n_creation_date, n_title, n_content)
		VALUES (NOW(), ?, ?)';

        $requestAdd = $this->db->prepare($query);
        $requestAdd->execute([
            $newNote->getTitle(),
            $newNote->getContent()
        ]);

        return $this->getANote($this->getLastNoteId());
    }

    /**
     * @return mixed
     */
    private function getLastNoteId()
    {
        $query = 'SELECT MAX(n_id) FROM dn_note';
        $requestLastId = $this->db->query($query);
        $lastId = $requestLastId->fetch(PDO::FETCH_NUM);

        return $lastId[0];
    }

    /**
     * Delete a note in the database.
     *
     * @param $noteToDeleteId
     */
    public function deleteANote($noteToDeleteId)
    {
        $query = 'DELETE FROM dn_note
		WHERE n_id = :id';
        $requestDelete = $this->db->prepare($query);
        $requestDelete->execute(['id' => htmlspecialchars($noteToDeleteId)]);
    }


    /**
     * Edit a note in the database.
     *
     * @param Note $modifiedNote
     * @return Note
     * @throws \Exception
     */
    public function editANote(Note $modifiedNote)
    {
        $query = 'UPDATE dn_note
		SET n_title = :title, n_content = :content, n_status = :noteStatus, n_modification_date = NOW()
		WHERE n_id = :id';

        $requestEdit = $this->db->prepare($query);
        $requestEdit->execute([
            'title' => $modifiedNote->getTitle(),
            'content' => $modifiedNote->getContent(),
            'noteStatus' => $modifiedNote->getStatus(),
            'id' => $modifiedNote->getId()
        ]);

        return $this->getANote($modifiedNote->getId());
    }

    /**
     * Get a note from the database
     *
     * @param $noteId
     * @return Note
     * @throws \Exception
     */
    public function getANote($noteId)
    {
        $query = 'SELECT * FROM dn_note WHERE n_id = ?';
        $requestANote = $this->db->prepare($query);
        $requestANote->execute([$noteId]);

        return new Note($requestANote->fetch(PDO::FETCH_ASSOC));
    }

}