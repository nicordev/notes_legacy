<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 21/01/2019
 * Time: 09:12
 */

namespace App;


use PDO;

class NoteManager
{
    /**
     * @var bool|PDO
     */
    private $db;

    /**
     * NoteManager constructor.
     */
    public function __construct()
    {
        $this->db = self::getPdo('localhost', 'db_note', 'root', '');
    }

    /**
     * @param string $host
     * @param string $databaseName
     * @param string $user
     * @param string $password
     * @param string $charset
     * @return bool|PDO
     */
    public static function getPdo($host = 'localhost', $databaseName = 'test', $user = 'root', $password = '', $charset = 'utf8')
    {
        try
        {
            $db = new PDO('mysql:host=' . $host . ';dbname=' . $databaseName . ';charset=' . $charset, $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // On émet une alerte à chaque fois qu'une requête a échoué.
        }
        catch(Exception $e)
        {
            return false;
        }
        return $db;
    }


    /**
     * Get saved notes from the database
     *
     * @return array notes
     */
    public function getAllNotes() : array
    {
        $notes = [];
        $query = 'SELECT * FROM dn_note';

        $requestAll = $this->db->query($query);
        $notesFromDb = $requestAll->fetchAll(PDO::FETCH_ASSOC); // It would be nice to use PDO::FETCH_CLASS

        foreach ($notesFromDb as $note) {
            $notes[] = new Note($note);
        }

        return $notes;
    }

    /**
     * Add a new note in the database.
     *
     * @param Note $newNote
     */
    public function addANewNote(Note $newNote) : void
    {
        $query = 'INSERT INTO dn_note(n_creation_date, n_title, n_content)
		VALUES (NOW(), ?, ?)';

        $requestAdd = $this->db->prepare($query);
        $requestAdd->execute([
            $newNote->getTitle(),
            $newNote->getContent()
        ]);
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
     */
    public function editANote(Note $modifiedNote)
    {
        $query = 'UPDATE dn_note
		SET n_title = :title, n_content = :content, n_modification_date = NOW()
		WHERE n_id = :id';

        $requestEdit = $this->db->prepare($query);
        $requestEdit->execute([
            'title' => $modifiedNote->getTitle(),
            'content' => $modifiedNote->getContent(),
            'id' => $modifiedNote->getId()
        ]);
    }

}