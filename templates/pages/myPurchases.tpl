{$modules.head}

<section id="myPurchases">
    <div class="container box extra-margin-top">
        <div class="row">
            <div class="col s6">
                <h1>My purchases</h1>
            </div>
            <div class="offset-s2 col s4 total-information">
                <h5>Total: {$total_purchases} purchases, {$total_price} €</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                {if $total_purchases == 0}
                    <div class="container center">
                        <h5>You have not bought any product, go shopping</h5>
                    </div>
                {else}
                    <table class="striped highlight responsive-table">
                        <thead>
                        <tr>
                            <th id="product-name" data-field="id">Product name</th>
                            <th data-field="user">User</th>
                            <th data-field="price">Price</th>
                            <th data-field="date">Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        {foreach from=$purchases item=p}
                        <tr>
                            <td>
                                {foreach from = $products item = prod}
                                    {if $prod.name == $p.product}
                                        <a href="{$global.url}/p/{$prod.URL}/id={$prod.id}" class="product-link">{$p.product}</a>
                                    {/if}
                                {/foreach}
                            </td>
                            <td><a class="toComment" href="{$url.global}/user-comments/{$p.user_sell}">{$p.user_sell}</a></td>
                            <td>{$p.price} €</td>
                            <td>
                                {foreach from = $date item = d}
                                    {if $p.id == $d.id}
                                        {$d.date}
                                    {/if}
                                {/foreach}
                            </td>
                        </tr>
                        {/foreach}
                        </tbody>
                    </table>
                {/if}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container">
                <ul class="pagination">
                    <li class="{$isPrevDis}">
                        <a href="{$url.global}/my-purchases/{$prev_page}" aria-label="Previous">
                            <i class="material-icons">keyboard_arrow_left</i>
                        </a>
                    </li>

                    {foreach from=$limit_pages item=i}
                        {if $i == $actual_page}
                            <li class="active"><a href="{$url.global}/my-purchases/{$i}">{$i}</a></li>
                        {else}
                            <li class=""><a href="{$url.global}/my-purchases/{$i}">{$i}</a></li>
                        {/if}
                    {/foreach}

                    <li class="{$isNextDis}">
                        <a href="{$url.global}/my-purchases/{$next_page}" aria-label="Next">
                            <i class="material-icons">keyboard_arrow_right</i>
                        </a>
                    </li>
                </ul>
        </div>
    </div>

</section>


{$modules.footer}