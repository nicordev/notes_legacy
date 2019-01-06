<?php

$db = dbConnect('localhost', 'db_note', 'root', '');
$notes = getNotes($db);

if (isset($_POST['n_content']) AND isset($_POST['add_a_note']))
{
	addANewNote($db);
	header('Location: index.php');
}

if (isset($_POST['n_content']) AND isset($_POST['edit_a_note']))
{
	editANote($db);
	header('Location: index.php');
}

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
				<input type="hidden" name="edit_a_note">
				<input type="hidden" name="n_id" <?= 'value="' . $_POST['n_id'] . '"' ?>>
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
 * @param PDO $db the database
 */
function addANewNote($db)
{
	$query = 'INSERT INTO dn_note(n_creation_date, n_content)
		VALUES (NOW(), ?)';
	$requestAdd = $db->prepare($query);
	$requestAdd->execute(array($_POST['n_content']));
}

/**
 * Edit a note in the database. Uses $_POST.
 * @param  PDO] $db the database
 */
function editANote($db)
{
	$query = 'UPDATE dn_note
		SET n_content = :content, n_modification_date = NOW()
		WHERE n_id = :id';

	$requestEdit = $db->prepare($query);
	$requestEdit->execute(array(
		'content' => $_POST['n_content'],
		'id' => $_POST['n_id']
	));
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
			<input type="hidden" name="add_a_note">
			<p>
				<input type="submit" value="Ajouter une note">
			</p>
		</form>
	</div>
</section>
<?php
$content = ob_get_clean();

require 'view/template.php';