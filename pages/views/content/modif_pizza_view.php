<h2>Modifier une Pizza</h2>

<div class="row">
   <div class="col-md-8">
        <?= form_open_multipart('administration/maj_pizza/'.$pizza->PK_Pizza); ?>
        <div id="form-group">
            <?= form_label('Nom :', 'nom'); ?>
            <?= form_input('nom', set_value('nom', $pizza->nom_pizza), 'class="form-control"'); ?>
        </div>
        <div id="form-group">
            <?= form_label('Ingrédients :', 'ingredients'); ?>
            <?= form_input('ingredients', set_value('ingredients', $pizza->ingredients), 'class="form-control"'); ?>
        </div>
        <div id="form-group">
            <?= form_label('Prix :', 'prix'); ?>
            <?= form_input('prix', set_value('prix', $pizza->prix), 'class="form-control" style="width: 30%;"'); ?>
        </div>
        <div id="form-group">
            <?= form_label('Image :', 'image'); ?>
            <?= form_upload('image') ?>
        </div>
        <br>
        <?= form_submit('envoyer', 'Envoyer', 'class="btn btn-info"'); ?>
        <?= validation_errors('<p class="error">'); ?>
        <?= form_close(); ?>
    </div>
    <div class="thumbnail col-md-4">
        <?= img($pizza->PK_Pizza.'.jpg', $pizza->nom_pizza); ?>
    </div>
</div>