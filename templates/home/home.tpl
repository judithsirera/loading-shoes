{$modules.head}

<section id="lastproduct">
    <div class="container">
        <div id="last_product" class="row">
            <div class="col s12 left">
                <h2> Last Product </h2>
            </div>
            <div class="col s6">
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
                                    <p class="user"><a href="{$url.global}/user-comments/{$p_last.usuari}">{$p_last.usuari}</a></p>
                                    <p>
                                        {foreach from=$stars_last.stars item=s}
                                            <i class="material-icons">{$s}</i>
                                        {/foreach}
                                    </p>
                                    <p class="views">{$p_last.views} views</p>

                                </div>
                            </div>

                            <div class="col s2 shopping">
                                {if $p.usuari != $user && $logged}
                                    <div class="col s2 shopping">
                                        <a href="{$global.url}/buy/{$p_last.URL}/id={$p_last.id}"><i class="medium material-icons right">add_shopping_cart</i></a>
                                    </div>
                                {/if}
                            </div>
                        </div>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{$p_last.name}<i class="material-icons right">close</i></span>
                        <p>{$p_last.description}.</p>
                    </div>
                </div>
            </div>
            <!--TWITTER-->
            <div class="col s6 extra-margin-top">
                <a class="twitter-timeline" href="https://twitter.com/hashtag/LSStore" data-widget-id="731897596743196672">Tweets sobre #LSStore</a>
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLoading-Productions-641234369312404%2F%3Ffref%3Dts&tabs&width=500&height=250&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=true&appId" width="500" height="250" style="border:none;overflow:hidden;margin-top: 40px" scrolling="no" frameborder="0" allowTransparency="true"></iframe>            </div>
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
                                <div class="row">
                                    <div class="col s6">
                                        <h6>{$p.price}€</h6>
                                    </div>
                                    <div class="col s6">
                                        <h6>
                                            {foreach from=$dates item=d}
                                                {if $d.id == $p.id}
                                                    {$d.date}
                                                {/if}
                                            {/foreach}
                                        </h6>
                                    </div>

                                    <div class="col s6">
                                        <h6>
                                            {foreach from=$numPurchases item=n}
                                                {if $n.id == $p.id}
                                                    {$n.num} sales
                                                {/if}
                                            {/foreach}
                                        </h6>
                                    </div>
                                    <div class="col s6">
                                        <h6>
                                            {foreach from=$percent item=n}
                                                {if $n.id == $p.id}
                                                    {$n.numViews}%
                                                {/if}
                                            {/foreach}
                                        </h6>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card-action">
                            <div class="row">
                                <div class="col s10">
                                    <div class="collection-item">
                                        <p class="user"><a href="{$url.global}/user-comments/{$p.usuari}">{$p.usuari}</a></p>
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