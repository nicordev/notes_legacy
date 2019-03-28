<!-- Edit the note -->
<div id="note-to-edit">
    <form action="" method="post">
        <p>
            <input class="note-edit" type="text" name="n_title" <?= 'value="' . $note->getTitle() . '"' ?>>
            <input class="note-btn big" type="submit" value="🗸">
        </p>
        <p>
            <textarea class="note-edit" name="n_content" cols="30" rows="10"><?= htmlspecialchars_decode($note->getContent()) ?></textarea>
        </p>
        <p>
            <label for="">Status</label>
            <input class="note-edit small" type="text" name="n_status" value="<?= $note->getStatus() ?>">
        </p>
        <input type="hidden" name="save_modifications">
        <input type="hidden" name="n_id" <?= 'value="' . $note->getId() . '"' ?>>
    </form>
</div>

<div class="note-commands">
    <!-- Cancel -->
    <form action="" method="post">
        <input class="note-btn big" type="submit" value="⬅">
    </form>
    <!-- Delete the note -->
    <form action="" method="post">
        <input type="hidden" name="delete_a_note">
        <input type="hidden" name="n_id" <?= 'value="' . $note->getId() . '"' ?>>
        <input class="note-btn red big" type="submit" value="🗑">
    </form>
</div>