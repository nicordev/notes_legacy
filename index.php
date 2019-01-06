<?php

$db = dbConnect('localhost', 'db_note', 'root', '');
$notes = getNotes($db);
$selectedNote = getSelectedNote($db);

// Functions

/**
 *  Create a PDO object for a database
 *
 *  @param {String} $host server
 *  @param {String} $databaseName
 *  @param {String} $user
 *  @param {String} $password
 *  @param {Strong} $charset = 'utf8'
 *	@return PDO
 */
function dbConnect($host, $databaseName, $user, $password, $charset = 'utf8') {

    try {
        $db = new \PDO('mysql:host=' . $host . ';dbname=' . $databaseName . ';charset=' . $charset, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
    } catch(Exception $e) {
        return false;
    }
    return $db;
}

/**
 * Get saved notes
 * @param  PDO    $db database
 * @return array     notes
 */
function getNotes(PDO $db)
{
	$notes = array();
	
	$query = 'SELECT * FROM dn_note';
	
	$requestAll = $db->query($query);
	while ($data = $requestAll->fetch())
	{
		$notes[] = getAssociativeData($data);
	}

	return $notes;
}

function getAssociativeData($data)
{
	$associativeArray = array();

	foreach ($data as $key => $value) {
		if (!is_numeric($key))
		{
			$associativeArray[$key] = $value;
		}
	}
	return $associativeArray;
}

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
			<input type="hidden" name="n_id" <?= 'value="' . $note['n_id'] . '"' ?>>
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
			<form action="index.php" method="post">
				<input class="note-edit" type="text" name="n_content" <?= 'value="' . $note['n_content'] . '"' ?>>
				<input class="note-btn" type="submit" value="🗸">
			</form>
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

/**
 * Add a new note in the database. Uses $_POST.
 */
function addANewNote()
{
	if 
}

/**
 * Get a note from its id
 * @param PDO $db the database
 * @return string the content of the note
 */
function getSelectedNote($db)
{
	if (isset($_POST['n_id']))
	{
		$query = 'SELECT n_content
			FROM dn_note
			WHERE n_id = :id';
		$requestNote = $db->prepare($query);
		$requestNote->execute(array(
			'id' => $_POST['n_id']
		));
		$note = $requestNote->fetch()['n_content'];
		
		return $note;
	}

	return false;
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
				<input type="text" name="n_content" id="new-note-content">
			</p>
			<p>
				<input type="submit" value="Ajouter une note">
			</p>
		</form>
	</div>
</section>
<?php
$content = ob_get_clean();

require 'view/template.php';