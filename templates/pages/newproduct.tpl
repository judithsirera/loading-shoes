{$modules.head}

<section id="newproduct">
    <div class="container extra-margin-top">
        <div class="row box">
            <div class="col s12">
                <div class="row">
                    <div class="col s6 offset-s3">
                        <h1>New product</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 offset-s3">
                        {if $error_msg}
                            <div class="col s12 error-message borders-box">
                                <p>{$error_msg}</p>
                            </div>
                        {/if}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        <form id="subirImg" name="subirImg" enctype="multipart/form-data" method="post" action="">
                            <label for="imagen">Subir imagen:</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                            <input type="file" name="imagen" id="imagen" />
                            <input type="submit" name="subirBtn" id="subirBtn" value="Subir imagen" />
                        </form>
                        <!--<div class="uploadShoesFoto">
                            <div class="file-field input-field">
                                <div class="btn uploadImageButton">
                                    <i class="material-icons large">file_upload</i>
                                    <input id="shoesPhoto" name="shoesPhoto" type="file">
                                </div>
                            </div>
                            <img class="img-responsive" src="img/uploadFotoShoes.png" alt="" />
                        </div>-->
                    </div>
                    <form class="col s6" method="POST">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="product_name" id="product_name" type="text" class="validate" value="{$product_name}" required>
                                <label for="product_name">Product name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea name="description_product" id="description_product" class="materialize-textarea" required>{$description_product}</textarea>
                                <label for="description_product">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input name="price" id="price" type="number" class="validate" min="1" max="1000" value="{$price}" required>
                                <label for="price">Price (€)</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="quantity" id="quantity" type="number" class="validate" min="1" max="1000" value="{$quantity_value}" required>
                                <label for="quantity">Quantity</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="limit_date" type="text" id="datepicker" class="validate" value="{$limit_date}" required>
                                <label for="datepicker">Data caducitat</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s8 translateY">
                                <input type="checkbox" class="filled-in" id="conditions" name="conditions"/>
                                <label for="conditions">I accept conditions.</label>
                                <a class="modal-trigger" href="#modal-conditions"><span>Read conditions</span></a>
                            </div>
                            <div class="col s4">
                                <button class="btn waves-effect waves-light btn-large right" type="submit" name="submit">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Conditions -->
        <div id="modal-conditions" class="modal bottom-sheet">
            <div class="modal-content">
                <h4>Conditions</h4>
                <p>COSTS: Publish and edit a product cost 1€. If the user has not the money need it, the product will not be published or edited.</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>

    </div>
</section>



{$modules.footer}