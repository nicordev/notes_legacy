<!-- View a note -->
<div>
    <span class="note-title"><?= $note->getTitle() ?></span>
</div>

<div>
    <span class="note-content"><?= $note->getContent() ?></span>
</div>

<!-- Infos -->
<div>
    <?php
    if (!empty($note->getCreationDate()))
    {
        ?>
        <span class="info-date">Créée le <?= htmlspecialchars($note->getCreationDate()) ?></span>
        <?php
    }
    if (!empty($note->getModificationDate()))
    {
        ?>
        <span class="info-date">Modifiée le <?= htmlspecialchars($note->getModificationDate()) ?></span>
        <?php
    }
    ?>
</div>