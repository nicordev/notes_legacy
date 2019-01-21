<!-- Edit the note -->
<div>
    <form action="index.php" method="post">
        <input class="note-edit" type="text" name="n_title" <?= 'value="' . $note->getTitle() . '"' ?>>
        <input type="hidden" name="save_modifications">
        <input type="hidden" name="n_id" <?= 'value="' . $note->getId() . '"' ?>>
        <input class="note-btn" type="submit" value="🗸">
    </form>
</div>
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