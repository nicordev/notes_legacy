
    <ul>
        <?php
        foreach ($notes as $note) {
            ?>
            <li>
                <div class="note-wrapper">
                    <?php
                    if ($note->getId() === $noteToEditId) {
                        require 'editANote.php';
                    } else {
                        require 'viewANote.php';
                    }
                    ?>
                </div>

                <?php
                if ($note->getId() !== $noteToEditId)
                {
                    require 'editANoteButton.php';
                }
                ?>
            </li>
            <?php
        }
        ?>
    </ul>