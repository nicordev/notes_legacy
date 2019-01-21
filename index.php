<?php

use App\Autoloader;
use App\NoteController;

require "src/Autoloader.php";

Autoloader::register();

$noteController = new NoteController();

// View
ob_start();
?>
<section class="page-content">
	<!-- Saved notes -->
	<div id="notes-wrapper">
<?php
$noteController->showAllNotes();
?>
	</div>

	<!-- Add a new note -->
	<div id="new-note-form-wrapper">
		<form method="post" action="index.php">
			<p>
				<label for="new-note-content">Note à ajouter</label><br>
				<input class="my_input" type="text" name="n_content" id="new-note-content">
			</p>
			<input type="hidden" name="add_a_note">
			<p>
				<input class="note-btn2" type="submit" value="Ajouter une note">
			</p>
		</form>
	</div>
</section>
<?php
$content = ob_get_clean();

require 'view/template.php';