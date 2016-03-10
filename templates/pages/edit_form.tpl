{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

<html>
<head><title>Practica 4</title></head>
<body>


<h2>Practica 4</h2>
<span class="message-error">{$msg}</span>


<section>
	<div class="container">
		<div class="container">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="material-icons">mode_edit</i> Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="nom_instrument" id="nom_instrument" type="text" class="validate" value="{$name}">
                            <label for="nom_instrument">Instrument</label>
                        </div>
                        <div class="input-field col s12">
                            <select id="edit_select" name="tipus_instrument">
                                <option value="" disabled selected>Choose your option</option>
                                {if ($type == 'Vent')}
                                    <option selected>Vent</option>
                                    <option>Corda</option>
                                    <option>Percussio</option>
                                    <option>Electronic</option>
                                {/if}
                                {if ($type == 'Corda')}
                                    <option>Vent</option>
                                    <option selected>Corda</option>
                                    <option>Percussio</option>
                                    <option>Electronic</option>
                                {/if}
                                {if ($type == 'Percussio')}
                                    <option>Vent</option>
                                    <option>Corda</option>
                                    <option selected>Percussio</option>
                                    <option>Electronic</option>
                                {/if}
                                {if ($type == 'Electronic')}
                                    <option>Vent</option>
                                    <option>Corda</option>
                                    <option>Percussio</option>
                                    <option selected>Electronic</option>
                                {/if}
                            </select>
                            <label for="tipus_instrument">Tipus instrument</label>
                        </div>
                        <div class="input-field col s12">
                            <input name="URL_instrument" id="URL_instrument" type="text" class="validate" value="{$url_inst}">
                            <label for="URL_instrument">URL</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btnEdit" id="btnEdit" name="btnEdit">Edit</button>
                    <a class="editBtn" href="{$url.global}/practica4"><h4><i class="material-icons">close</i></h4></a>

                </div>
            </form>

        </div>
		</div>
	</div>
</section>


</body>
</html>


{$modules.footer}