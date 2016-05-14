{$modules.head}

<section id="user">
    <div class="container extra-margin-top">
        <div class="row box">
            <div class="col s5">
                <img src="{$url.global}/imag/users/{$to_user.image_path}" class="img-responsive circle img-uComments">
            </div>
            <div class="col s7">
                <div class="row">
                    <div class="col 12">
                        <h1 class="user-name">{$to_user.username}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        <h5>Comments</h5>
                        <p>{$numComments} comments</p>
                    </div>
                    <div class="col s6">
                        <h5>Success</h5>
                        <p>
                            {foreach from=$to_user.stars item=s}
                                <i class="material-icons">{$s}</i>
                            {/foreach}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="commentForm">
    <div class="container extra-margin-top">
        <div class="comment">
            {if $isEnableToComment}
                <div class="row">
                    <div class="col s12">
                        <h1>Make your comment</h1>
                    </div>
                </div>
                <form method="POST">
                    <div class="row">
                        <div class="input-field col s9">
                            <input name="subject" id="subject" type="text" class="validate" required>
                            <label for="subject">Subject</label>
                        </div>
                        <div class="input-field col s3">
                            <button class="btn waves-effect waves-light btn-large right" type="submit" name="comment">Comment</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <textarea name="commentText" id="commentText" required></textarea>
                        </div>
                    </div>
                </form>
            {else}
                <div class="row">
                    <div class="col s12">
                        <h4>You can't comment to {$to_user.username}. You have already commented, if not you must buy a product to this user.</h4>
                    </div>
                </div>
            {/if}
        </div>
    </div>

</section>


<section id="comments">
    <div class="container extra-margin-top extra-margin-bottom">
        <div class="row">
            {if $numComments == 0}
                <div class="col s12 comment">
                    <h4>{$to_user.username} doesn't have any comment.</h4>
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
                    {if $isPrevDis}
                        <a aria-label="Previous">
                    {else}
                        <a href="{$url.global}/user-comments/{$to_user.username}/{$prev_page}" aria-label="Previous">
                    {/if}
                        <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                </li>

                {foreach from=$pages item=i}
                    {if $i == $actual_page}
                        <li class="active"><a href="{$url.global}/user-comments/{$to_user.username}/{$i}">{$i}</a></li>
                    {else}
                        <li class=""><a href="{$url.global}/user-comments/{$to_user.username}/{$i}">{$i}</a></li>
                    {/if}
                {/foreach}

                <li class="{$isNextDis}">
                    {if $isNextDis}
                        <a aria-label="Next">
                    {else}
                        <a href="{$url.global}/user-comments/{$to_user.username}/{$next_page}" aria-label="Next">
                    {/if}
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