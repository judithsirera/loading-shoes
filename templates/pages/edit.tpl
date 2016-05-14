{$modules.head}

<section id="newproduct">
    <div class="container extra-margin-top">
        <div class="row box">
            <form method="POST" enctype="multipart/form-data">
                <div class="col s12">
                    <div class="row">
                        <div class="col s6 offset-s3">
                            <h1>Edit product</h1>
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
                            <div class="row">
                                <div class="col s12">
                                    <div id="uploadshoesfoto">
                                        <img id="imgFile" class="img-responsive" src="{$url.global}/imag/products/{$foto}" alt="" />
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div id="fileInput" class="file-field input-field">
                                        <div style="height: 3rem" class="btn waves-effect waves-light btn-large">
                                            <span>File</span>
                                            <input id="fileName" name="fileName" type="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" value="{$foto}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input name="product_name" id="product_name" type="text" class="validate" value="{$name}" required>
                                    <label for="product_name">Product name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea name="description_product" id="description_product" class="materialize-textarea" required>{$description}</textarea>
                                    <label for="description_product">Description</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input name="price" id="price" type="number" class="validate" min="1" max="1000" value="{$price_value}" required>
                                    <label for="price">Price (€)</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="quantity_value" id="quantity_value" type="number" class="validate" min="1" max="1000" value="{$quantity}" required>
                                    <label for="quantity_value">Quantity</label>
                                </div>
                                <div class="input-field col s4">
                                    <input name="datepicker" type="text" id="datepicker" value="{$date}" class="validate" required>
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
                                    <button class="btn waves-effect waves-light btn-large right" type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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