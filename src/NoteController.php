<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 21/01/2019
 * Time: 14:14
 */

namespace App;


class NoteController
{
    private $notes = [];
    private $noteManager;

    public function __construct()
    {
        $this->noteManager = new NoteManager();
        $this->notes = $this->noteManager->getAllNotes();
    }

    /**
     * Call a view which shows all the notes available
     */
    public function showAllNotes(Note $noteToEdit = null)
    {
        ?>
        <ul>
            <?php
            foreach ($this->notes as $note) {
                ?>
                <li>
                    <div>
                        <?php

                        if ($noteToEdit && $note->getId() === $noteToEdit->getId())
                            self::showANote($note, true);
                        else
                            self::showANote($note, false);
                        ?>
                    </div>
                    <div>
                        <?php
                        if (!empty($note->getCreationDate()))
                        {
                            ?>
                            <span class="info-date">Créée le <?= htmlspecialchars($note->getCreationDate()) ?></span>
                            <?php
                        }
                        if (!empty($note->getModificationDate()))
                        {
                            ?>
                            <span class="info-date">Modifiée le <?= htmlspecialchars($note->getModificationDate()) ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (!$noteToEdit || $note->getId() !== $noteToEdit->getId())
                    {
                        ?>
                        <form action="index.php" method="post">
                            <input type="hidden" name="n_id" <?= 'value="' . htmlspecialchars($note->getId()) . '"' ?>>
                            <button class="note-btn" type="submit">🖉</button>
                        </form>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }

    /**
     * Return either a note in a form to edit it or just the note to read
     *
     * @param Note $note the note to change
     * @return string the HTML code of the form to change the note
     */
    private static function showANote(Note $note, bool $edit = false)
    {
        // We show a form to edit the note
        if ($edit)
        {
            ?>
            <!-- Edit the note -->
            <form action="index.php" method="post">
                <input class="note-edit" type="text" name="n_title" <?= 'value="' . $note->getTitle() . '"' ?>>
                <input type="hidden" name="edit_a_note">
                <input type="hidden" name="n_id" <?= 'value="' . $note->getId() . '"' ?>>
                <input class="note-btn" type="submit" value="🗸">
            </form>
            <div class="note-commands">
                <!-- Cancel -->
                <form action="index.php" method="post">
                    <input class="note-btn" type="submit" value="Annuler">
                </form>
                <!-- Delete the note -->
                <form action="index.php" method="post">
                    <input type="hidden" name="delete_a_note">
                    <input type="hidden" name="n_id" <?= 'value="' . $note->getId() . '"' ?>>
                    <input class="note-btn" type="submit" value="❌">
                </form>
            </div>
            <?php
        }
        // We show just the note to read
        else
        {
            ?>
            <span class="note-content"><?= $note->getTitle() ?></span>
            <?php
        }
    }
}