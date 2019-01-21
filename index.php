<?php

use App\Autoloader;
use App\Note;
use App\NoteManager;

require "src/Autoloader.php";

Autoloader::register();

$noteManager = new NoteManager();

// Add a new note

//$_POST['n_title'] = 'title of the new note';
//$_POST['n_content'] = 'Content of the new note';
//$_POST['add_a_note'] = 1;
//
//if (isset($_POST['n_title'])
//    && isset($_POST['n_content'])
//    && isset($_POST['add_a_note'])
//    && !empty($_POST['n_title']))
//{
//    $newNote = new Note($_POST);
//    $noteManager->addANewNote($newNote);
////    header('Location: index.php');
//}

$notes = $noteManager->getNotes();
var_dump($notes);

// Delete a note

//$_POST['n_id'] = 67;
//$_POST['delete_a_note'] = 1;
//
//if (isset($_POST['n_id']) && isset($_POST['delete_a_note']))
//{
//    $noteManager->deleteANote($_POST['n_id']);
////    header('Location: index.php');
//}

// Edit a note

$_POST['n_id'] = 68;
$_POST['n_title'] = 'Titre de la note modifiée';
$_POST['n_content'] = 'Contenu de la note modifiée';
$_POST['edit_a_note'] = 1;

if (isset($_POST['n_id']) && isset($_POST['edit_a_note']))
{
    $modifiedNote = new Note($_POST);
    $noteManager->editANote($modifiedNote);
//    header('Location: index.php');
}

$notes = $noteManager->getNotes();

var_dump($notes);

die;





// Functions
/**
 * Show notes in HTML tags
 * @param  array  $notes
 */
function showNotes(array $notes)
{
?>
<ul>
<?php
	foreach ($notes as $note) {
?>
	<li>
		<div>
<?php
		showNoteContent($note);
?>
		</div>
		<div>
<?php
		if (!empty($note['n_creation_date']))
		{
?>
			<span class="info-date">Créée le <?= $note['n_creation_date'] ?></span>
<?php
		}
		if (!empty($note['n_modification_date']))
		{
?>
			<span class="info-date">Modifiée le <?= $note['n_modification_date'] ?></span>
<?php
		}
?>
		</div>
<?php
		if (!(isset($_POST['n_id']) && $_POST['n_id'] === $note['n_id']))
		{
?>
		<form action="index.php" method="post">
			<input type="hidden" name="n_id" <?= 'value="' . htmlspecialchars($note['n_id']) . '"' ?>>
			<button class="note-btn" type="submit">🖉</button>
		</form>
<?php
		}
?>
	</li>
<?php
	}
?>
</ul>
<?php
}

/**
 * Return either a note in a form to edit it or just the note to read
 * @param  array $note the note to change
 * @return string the HTML code of the form to change the note
 */
function showNoteContent($note)
{
	// We show a form to edit the note
	if (isset($_POST['n_id']) && $_POST['n_id'] === $note['n_id'])
	{
?>
			<!-- Edit the note -->
			<form action="index.php" method="post">
				<input class="note-edit" type="text" name="n_content" <?= 'value="' . $note['n_content'] . '"' ?>>
				<input type="hidden" name="edit_a_note">
				<input type="hidden" name="n_id" <?= 'value="' . htmlspecialchars($_POST['n_id']) . '"' ?>>
				<input class="note-btn" type="submit" value="🗸">
			</form>
			<div class="note-commands">
				<!-- Cancel -->
				<form action="index.php" method="post">
					<input class="note-btn" type="submit" value="Annuler">
				</form>
				<!-- Delete the note -->
				<form action="index.php" method="post">
					<input type="hidden" name="delete_a_note">
					<input type="hidden" name="n_id" <?= 'value="' . htmlspecialchars($_POST['n_id']) . '"' ?>>
					<input class="note-btn" type="submit" value="❌">
				</form>
			</div>
<?php
	}
	// We show just the note to read
	else
	{
?>
			<span class="note-content"><?= $note['n_content'] ?></span>
<?php
	}
}





// View
ob_start();
?>
<section class="page-content">
	<!-- Saved notes -->
	<div id="notes-wrapper">
<?php
showNotes($notes);
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