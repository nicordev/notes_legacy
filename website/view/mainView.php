<section class="page-content">

    <!-- Add a new note -->
    <div id="new-note-form-wrapper">
        <?php
        require 'mainViewPart/addANote.php';
        ?>
    </div>

    <!-- Saved notes -->
    <div id="commands">
        <p>
            <a href="?filter=all">Voir toutes les notes</a>
        </p>
        <p>
            <a href="?filter=new">Voir uniquement les nouvelles notes</a>
        </p>
    </div>
    
    <div id="notes-wrapper">
        <?php
        require 'mainViewPart/viewAllNotes.php';
        ?>
    </div>
</section>