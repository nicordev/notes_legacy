<?php

$db = dbConnect('localhost', 'db_note', 'root', '');
$notes = getNotes($db);

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
		<span class="note-content"><?= $note['n_content'] ?></span><br>
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
	</li>
<?php
	}
?>
</ul>
<?php
}



// View
ob_start();
?>
<section class="page-content">
	<!-- Notes enregistrées -->
	<div id="notes-wrapper">
<?php
showNotes($notes);
?>
	</div>
</section>
<?php
$content = ob_get_clean();

require 'view/template.php';