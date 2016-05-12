{$modules.head}

<section id="products">
    <div class="container extra-margin-top">
        {if $isResult}
            {if $areResults}
                <h4>Results with the word '<span>{$word}</span>'</h4>
            {else}
                <h4>No results with the word '<span>{$word}</span>'</h4>
                <h5>We are showing all products</h5>
            {/if}
            <h6><a href="{$global.url}/products">See all</a></h6>
        {else}
            <h4>All products</h4>
        {/if}
    </div>
    <div class="box container extra-margin-top">
        <div class="row">

            {if $total_products == 0}
                <div class="col s12">
                    <div class="container center">
                        <h5>There are no products available</h5>
                    </div>
                </div>
            {else}

                {foreach from = $products item = p}
                    <div class="col s4">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                {foreach from=$images item=img}
                                    {if $img.id == $p.id}
                                        <a >
                                            <img class="img-responsive" src="{$global.url}/imag/products/{$img.image_path}">
                                        </a>
                                    {/if}
                                {/foreach}
                            </div>
                            <div class="card-content">
                                <span class="card-title"><a href="{$global.url}/p/{$p.URL}/id={$p.id}">{$p.name}</a></span>
                                <span><i class="activator material-icons right">description</i></span>
                                <div class="price-stock">
                                    <h5>{$p.price}€</h5>
                                    <h6>
                                        {foreach from=$diff_days item=d}
                                            {if $d.id == $p.id}
                                                -{$d.days} days
                                            {/if}
                                        {/foreach}
                                    </h6>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col s10">
                                        <div class="collection-item">
                                            <p class="user"><a href="{$url.global}/user-comments/{$p.usuari}">{$p.usuari}</a></p>
                                            <p>
                                                {foreach from=$stars item=sa}
                                                    {if $sa.id == $p.id}
                                                        {foreach from=$sa.stars item=s}
                                                            <i class="material-icons">{$s}</i>
                                                        {/foreach}
                                                    {/if}
                                                {/foreach}
                                            </p>
                                            <p class="views">{$p.views} views</p>

                                        </div>
                                    </div>
                                    {if $p.usuari != $user && $logged}
                                        <div class="col s2 shopping">
                                            <a href="{$global.url}/buy/{$p.URL}/id={$p.id}"><i class="medium material-icons right">add_shopping_cart</i></a>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{$p.name}<i class="material-icons right">close</i></span>
                                <p>{$p.description}.</p>
                            </div>
                        </div>
                    </div>
                {/foreach}

            {/if}

        </div>
    </div>
    <div class="container">
        <div class="container">
            <ul class="pagination">
                {if !$isResult}
                    <li class="{$isPrevDis}">
                        <a href="{$url.global}/products/{$prev_page}" aria-label="Previous">
                            <i class="material-icons">keyboard_arrow_left</i>
                        </a>
                    </li>

                    {foreach from=$limit_pages item=i}
                        {if $i == $actual_page}
                            <li class="active"><a href="{$url.global}/products/{$i}">{$i}</a></li>
                        {else}
                            <li class=""><a href="{$url.global}/products/{$i}">{$i}</a></li>
                        {/if}
                    {/foreach}

                    <li class="{$isNextDis}">
                        <a href="{$url.global}/products/{$next_page}" aria-label="Next">
                            <i class="material-icons">keyboard_arrow_right</i>
                        </a>
                    </li>
                {else}
                    <li class="{$isPrevDis}">
                        <a href="{$url.global}/products/search/{$word}/{$prev_page}" aria-label="Previous">
                            <i class="material-icons">keyboard_arrow_left</i>
                        </a>
                    </li>

                    {foreach from=$limit_pages item=i}
                        {if $i == $actual_page}
                            <li class="active"><a href="{$url.global}/products/search/{$word}/{$i}">{$i}</a></li>
                        {else}
                            <li class=""><a href="{$url.global}/products/search/{$word}/{$i}">{$i}</a></li>
                        {/if}
                    {/foreach}

                    <li class="{$isNextDis}">
                        <a href="{$url.global}/products/search/{$word}/{$next_page}" aria-label="Next">
                            <i class="material-icons">keyboard_arrow_right</i>
                        </a>
                    </li>

                {/if}
            </ul>
        </div>
    </div>
</section>



{$modules.footer}