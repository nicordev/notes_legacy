<?php

?>
    <ul>
        <?php
        foreach ($this->notes as $note) {
            ?>
            <li>
                <div class="note-wrapper">
                    <?php
                    if ($this->isTheNoteToEdit($note))
                        require 'editANote.php';
                    else
                        require 'viewANote.php';
                    ?>
                </div>

                <?php
                if (!$this->isTheNoteToEdit($note))
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