<h2>Ajouter une Pizza</h2>


<?= form_open_multipart('administration/nouvelle_pizza'); ?>
<div id="form-group">
    <?= form_label('Nom :', 'nom'); ?>
    <?= form_input('nom', '', 'class="form-control" placeholder="Nom de la Pizza"'); ?>
</div>
<div id="form-group">
    <?= form_label('Ingrédients :', 'ingredients'); ?>
    <?= form_input('ingredients', '', 'class="form-control" placeholder="ingredients"'); ?>
</div>
<div id="form-group">
    <?= form_label('Prix :', 'prix'); ?>
    <?= form_input('prix', '', 'class="form-control" placeholder="Prix" style="width: 30%;"'); ?>
</div>
<div id="form-group">
    <?= form_label('Image :', 'image'); ?>
    <?= form_upload('image') ?>
</div>
<br>
<?= form_submit('envoyer', 'Envoyer', 'class="btn btn-info"'); ?>
<?= validation_errors('<p class="error">'); ?>
<?= form_close(); ?>