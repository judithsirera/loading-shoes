{$modules.head}

<section id="fbShare">
    <div id="fb-root"></div>
    <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fg4.dev%2Fp%2Fprova-4-45%2Fid%3D83&layout=box_count&mobile_iframe=true&width=80&height=61&appId" width="80" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
</section>

<section id="productView">
    <div class="goBackBtn">
        <a href="{$url.global}/products">
            <i id="back-icon" class="material-icons">arrow_back</i>
        </a>
    </div>
    <div class="container extra-margin-top">
        <div class="row">
            <div class="col s6">
                <h1 class="product-title">{$p.name}</h1>
            </div>
            <div class="col s6 user">
                <img src="{$url.global}/imag/users/{$image_user}" alt="" class="circle img-user">
                <h4><a href="{$url.global}/user-comments/{$p.usuari}">{$p.usuari}</a></h4>
            </div>
        </div>

    </div>
    <div class="container box">
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
        {if $p.stock > 0 && $p.usuari != $user && $logged}
        <div class="shoppingBtn">
            <a href="{$global.url}/buy/{$p.URL}/id={$p.id}">
                <i id="shopping-icon" class="medium material-icons right">add_shopping_cart</i>
            </a>
        </div>
        {/if}
    </div>
</section>

<section id="comments">
    <div class="container row extra-margin-top">
        <div class="col s12">
            <h4>Comments to {$to_user}</h4>
        </div>
    </div>
    <div class="container extra-margin-bottom">
        <div class="row">
            {if $numComments == 0}
                <div class="col s12 comment">
                    <h4>{$to_user} doesn't have any comment.</h4>
                </div>
            {else}
                {foreach from=$comments item=c}
                    <div class="col s12 comment">
                        <div class="row">
                            <div class="col s2">
                                {foreach from = $from_userImgs item = u}
                                    {if $u.username == $c.from_user}
                                        <img src="{$url.global}/imag/users/{$u.img}" class="img-responsive circle">
                                    {/if}
                                {/foreach}
                            </div>
                            <div class="col s2">
                                <h4><a href="{$url.global}/user-comments/{$c.from_user}">{$c.from_user}</a></h4>
                            </div>
                            <div class="col s5">
                                <h5>{$c.subject}</h5>
                            </div>
                            <div class="col s2">
                                <p>
                                    {foreach from = $date item = d}
                                        {if $c.id_comment == $d.id}
                                            {$d.date}
                                        {/if}
                                    {/foreach}
                                </p>
                            </div>
                            <div class="col s1 right">
                                <a href="{$url.global}/user-comments/{$c.to_user}/{$actual_page}/edit/id={$c.id_comment}"><i class="material-icons">mode_edit</i></a>
                                <a class = "modal-trigger" href="#modal{$c.id_comment}"><i class="material-icons">delete</i></a>
                            </div>
                        </div>
                        <div class="row recharge-box">
                            <div class="col s12 comment-text">
                                <p>{$c.text}</p>
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
                <li class="{$isPrevDis}">
                    <a href="{$url.global}/user-comments/{$to_user}/{$prev_page}" aria-label="Previous">
                        <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                </li>

                {foreach from=$pages item=i}
                    {if $i == $actual_page}
                        <li class="active"><a href="{$url.global}/user-comments/{$to_user}/{$i}">{$i}</a></li>
                    {else}
                        <li class=""><a href="{$url.global}/user-comments/{$to_user}/{$i}">{$i}</a></li>
                    {/if}
                {/foreach}

                <li class="{$isNextDis}">
                    <a href="{$url.global}/user-comments/{$to_user}/{$next_page}" aria-label="Next">
                        <i class="material-icons">keyboard_arrow_right</i>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    {foreach from=$comments item=c}
        <div id="modal{$c.id_comment}" class="modal bottom-sheet">
            <div class="modal-content">
                <h4>Are you sure you want to delete this comment?</h4>
            </div>
            <div class="modal-footer">
                <a href="{$url.global}/user-comments/{$c.to_user}/{$actual_page}/delete/id={$c.id_comment}" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
            </div>

        </div>
    {/foreach}

</section>



{$modules.footer}