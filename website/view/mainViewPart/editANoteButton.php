<!-- Button to edit a note -->
<form action="#note-to-edit" method="post">
    <input type="hidden" name="edit_this_note" <?= 'value="' . htmlspecialchars($note->getId()) . '"' ?>>
    <button class="note-btn" type="submit">🖉</button>
</form>