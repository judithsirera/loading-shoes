{$modules.head}

<section id="lastproduct">
    <div class="container">
        <div id="last_product" class="row">
            <div class="col s6 left">
                <h2> Last Product </h2>
            </div>
            <div class="col s8">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <a href="{$global.url}/p/{$p_last.URL}/id={$p_last.id}">
                            <img class="img-responsive" src="{$global.url}/imag/products/{$i_last}">
                        </a>
                    </div>
                    <div class="card-content">
                        <span class="card-title"><a href="{$global.url}/p/{$p_last.URL}/id={$p_last.id}">{$p_last.name}</a></span>
                        <span><i class="activator material-icons right">description</i></span>
                        <div class="price-stock">
                            <h5>{$p_last.price}€</h5>
                            <h6>
                                {foreach from=$diff_last item=d}
                                    {if $d.id == $p_last.id}
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
                                    <p class="user">{$p_last.usuari}</p>
                                    <p>
                                        {foreach from=$stars_last.stars item=s}
                                            <i class="material-icons">{$s}</i>
                                        {/foreach}
                                    </p>
                                    <p class="views">{$p_last.views} views</p>

                                </div>
                            </div>
                            <div class="col s2 shopping">
                                <a href="{$global.url}/buy/{$p_last.URL}/id={$p_last.id}"><i class="medium material-icons right">add_shopping_cart</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{$p_last.name}<i class="material-icons right">close</i></span>
                        <p>{$p_last.description}.</p>
                    </div>
                </div>
            </div>
        </div>
</section>


<section id="mostviewed">
    <div class="container">
        <h2> Most viewed </h2>
        <div class="row">

            {foreach from = $most_viewed item = p}
                <div class="col s4">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            {foreach from=$i_most item=i}
                                {if $i.id == $p.id}
                                    <a href="{$global.url}/p/{$p.URL}/id={$p.id}">
                                        <img class="img-responsive" src="{$global.url}/imag/products/{$i.image_path}">
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
                                    {foreach from=$diff_most item=d}
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
                                        <p class="user">{$p.usuari}</p>
                                        <p>
                                            {foreach from=$stars_most item=sa}
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
                                {if $p.usuari != $user}
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
        </div>
    </div>

    <div class="container">
        <div class="container">
            <ul class="pagination">
                <li class="{$isPrevDis}">
                    {if $isPrevDis}
                        <a aria-label="Previous">
                    {else}
                        <a href="{$url.global}/home/{$prev_page}" aria-label="Previous">
                    {/if}
                        <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                </li>

                {foreach from=$limit_pages item=i}
                    {if $i == $actual_page}
                        <li class="active"><a href="{$url.global}/home/{$i}">{$i}</a></li>
                    {else}
                        <li class=""><a href="{$url.global}/home/{$i}">{$i}</a></li>
                    {/if}
                {/foreach}

                <li class="{$isNextDis}">
                    {if $isNextDis}
                        <a aria-label="Next">
                    {else}
                        <a href="{$url.global}/home/{$next_page}" aria-label="Next">
                    {/if}
                        <i class="material-icons">keyboard_arrow_right</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

 </section>



{$modules.footer}