<!-- View a note -->
<div class="note-title-wrapper">
    <?php if (!empty($note->getStatus())) { ?>
        <span class="note-status"><?= $note->getStatus() ?></span>
    <?php } ?>
    <span class="note-title"><?= htmlspecialchars_decode($note->getTitle()) ?></span>
</div>
<?php
if (!empty($note->getContent())) {
    ?>
    <div class="note-content-wrapper">
        <span class="note-content"><?= htmlspecialchars_decode($note->getContent()) ?></span>
    </div>
    <?php
}
?>
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
