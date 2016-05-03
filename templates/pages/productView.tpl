{$modules.head}



<section id="productView">
    <div class="goBackBtn">
        <a href="{$url.global}/products">
            <i id="back-icon" class="material-icons">arrow_back</i>
        </a>
    </div>
    <div class="container extra-margin-top">
        <div class="row">
            <div class="col s6">
                <h1 class="product-title">NIKE BAMBES</h1>
            </div>
            <div class="col s6 user">
                <img src="{$url.global}/imag/user_default.png" alt="" class="circle img-user">
                <h4>{$p.usuari}</h4>
            </div>
        </div>

    </div>
    <div class="container box extra-margin-bottom">
        <div class="row">
            <div class="col s6">
                <img class="img-product z-depth-1" src="{$url.global}/imag/products/{$p.image_path}">
            </div>
            <div class="col s6 extra-margin-top">
                <div class="row">
                    <div class="col s12" style="min-height: 125px">
                        <h5>Description</h5>
                        <p>{$p.description}</p>
                    </div>
                    <div class="col s4">
                        <h5>Price</h5>
                        <p>{$p.price}<i class="material-icons">euro_symbol</i></p>
                    </div>
                    <div class="col s4">
                        <h5>Stock</h5>
                        <p>{$p.stock} units</p>
                    </div>
                    <div class="col s4">
                        <h5>Date limit</h5>
                        <p>{$date_limit}</p>
                    </div>
                </div>
                <div class="row recharge-box">
                    <div class="col s4">
                        <h5>Views</h5>
                        <p>{$p.views} views</p>
                    </div>
                    <div class="col s8">
                        <h5>User success</h5>
                        <p>
                            {foreach from = $stars item = s}
                                <i class="material-icons">{$s}</i>
                            {/foreach}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {if $p.stock > 0}
        <div class="shoppingBtn">
            <a href="{$global.url}/buy/{$p.URL}/id={$p.id}">
                <i id="shopping-icon" class="medium material-icons right">add_shopping_cart</i>
            </a>
        </div>
        {/if}
    </div>
</section>


{$modules.footer}