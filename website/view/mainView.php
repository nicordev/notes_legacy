<section class="page-content">

    <!-- Add a new note -->
    <div id="new-note-form-wrapper">
        <?php
        require 'mainViewPart/addANote.php';
        ?>
    </div>

    <!-- Saved notes -->
    <div id="notes-wrapper">
        <?php
        require 'mainViewPart/viewAllNotes.php';
        ?>
    </div>
</section>