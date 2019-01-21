<form method="post" action="index.php">
    <p>
        <label for="new-note-title">Note à ajouter</label><br>
        <input class="my_input" type="text" name="n_title" id="new-note-title">
    </p>
    <p>
        <label for="new-note-content">Détail</label><br>
        <textarea class="my_input" name="n_content" id="new-note-content" cols="30" rows="10"></textarea>
    </p>
    <input type="hidden" name="add_a_note">
    <p>
        <input class="note-btn2" type="submit" value="Ajouter une note">
    </p>
</form>