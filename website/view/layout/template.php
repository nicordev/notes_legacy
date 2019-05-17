<!DOCTYPE html>
<html lang="fr">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" href="resource/img/favicon.png" />

	    <link rel="stylesheet" href="public/css/style.css">

	    <title>Notes</title>
	</head>
	<body>
	    <header>
	        <h1>Notes</h1>
	    </header>
	    
	    <?= $content; ?>
        <script src="public/js/marked.js"></script>
        <script src="public/js/notes.js"></script>
        <script>
            notes.markdownDecode();
        </script>
	</body>
</html>