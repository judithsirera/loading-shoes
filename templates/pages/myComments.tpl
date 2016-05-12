{$modules.head}



<section id="comments">
    <div class="container box extra-margin-top">
        <div class="row">
            <div class="col s6">
                <h1>My Comments</h1>
            </div>
            <div class="offset-s2 col s4 total-information">
                <h5>Total: {$numComments} comments</h5>
            </div>
        </div>
    </div>
    <div class="container extra-margin-top extra-margin-bottom">
        <div class="row">
            {if $numComments == 0}
                <div class="col s12 comment">
                    <h4>You don't have any comment.</h4>
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
                            <div class="col s6">
                                <h5>{$c.subject}</h5>
                            </div>
                            <div class="col s2 right">
                                <p>
                                    {foreach from = $date item = d}
                                        {if $c.id_comment == $d.id}
                                            {$d.date}
                                        {/if}
                                    {/foreach}
                                </p>
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
</section>


{$modules.footer}