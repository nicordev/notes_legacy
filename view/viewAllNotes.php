<?php

?>
    <ul>
        <?php
        foreach ($this->notes as $note) {
            ?>
            <li>
                <div class="note-wrapper">
                    <?php
                    if ($this->noteToEdit && $note->getId() === $this->noteToEdit->getId())
                        require 'editANote.php';
                    else
                        require 'viewANote.php';
                    ?>
                </div>

                <?php
                if (!$this->noteToEdit || $note->getId() !== $this->noteToEdit->getId())
                {
                    require 'editANoteButton.php';
                }
                ?>
            </li>
            <?php
        }
        ?>
    </ul>
<?php