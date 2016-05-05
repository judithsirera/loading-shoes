{$modules.head}

<section id="myProducts">
    <div class="container box extra-margin-top">
        <div class="row">
            <div class="col s6">
                <h1>My products</h1>
            </div>
            <div class="offset-s2 col s4 total-information">
                <h5>Total: {$numberOfProducts} products, {$price} €</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                {if $numberOfProducts == 0}
                    <div class="container center">
                        <h5>You have not uploaded any product, create one</h5>
                    </div>
                {else}
                    <table class="striped highlight responsive-table">
                        <thead>
                        <tr>
                            <th data-field="img">Image</th>
                            <th data-field="id" >Product name</th>
                            <th data-field="stock">Stock</th>
                            <th data-field="limitDate">Date limit</th>
                            <th data-field="price">Price</th>
                            <th id="options" data-field="options"></th>
                        </tr>
                        </thead>

                        <tbody>
                        {foreach from=$products item=p}
                            <tr>
                                <td><img src="{$url.global}/imag/products/{$p.image_path}" class="img_responsive myProd-img"></td>
                                <td><a href="{$global.url}/p/{$p.URL}/id={$p.id}" class="product-link">{$p.name}</a></td>
                                <td>{$p.stock}</td>
                                <td>
                                    {foreach from = $date item = d}
                                        {if $p.id == $d.id}
                                            {$d.date}
                                        {/if}
                                    {/foreach}
                                </td>
                                <td>{$p.price} €</td>
                                <td>
                                    <a href="#"><i class="material-icons">mode_edit</i></a>
                                    <a href="#"><i class="material-icons">delete</i></a>
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
                    <a href="{$url.global}/my-products/{$prev_page}" aria-label="Previous">
                        <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                </li>

                {foreach from=$limit_pages item=i}
                    {if $i == $actual_page}
                        <li class="active"><a href="{$url.global}/my-products/{$i}">{$i}</a></li>
                    {else}
                        <li class=""><a href="{$url.global}/my-products/{$i}">{$i}</a></li>
                    {/if}
                {/foreach}

                <li class="{$isNextDis}">
                    <a href="{$url.global}/my-products/{$next_page}" aria-label="Next">
                        <i class="material-icons">keyboard_arrow_right</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</section>


{$modules.footer}