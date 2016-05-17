{$modules.head}

<section id="login">
    <div class="container extra-margin-top">
        <div class="row">
            <div class="row">
                <div class="col s12">
                    <h1>Hi, restablish here your password</h1>
                </div>
                <div class="col s8 box">
                    <div class="row">
                         {if $error_msg}
                             <div class="col s12 error-message borders-box">
                                <p>{$error_msg}</p>
                            </div>
                        {/if}
                    </div>
                    <div class="row">
                        {if !$est_Ok}
                            <form method="POST" class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="user_password_1" id="password-establishment-1" type="password" class="check" value="{$password_value}" {literal}pattern=".{6,10}"{/literal} required>
                                        <label for="password" data-error="wrong" data-success="right">Write your new password</label>
                                        <span class="instructions right">Minimum 6 characters, maximum 10 characters</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="user_password_2" id="password-establishment-2" type="password" class="check" value="{$password_value}" {literal}pattern=".{6,10}"{/literal} required>
                                        <label for="password" data-error="wrong" data-success="right">Repeat the password</label>
                                        <span class="instructions right"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <button class="btn waves-effect waves-light btn-large right" type="submit" name="search">Save</button>
                                    </div>
                                </div>
                            </form>
                        {else}
                            <div class="col s12">
                                <p>Password re-established correctly, log in to enjoy Loading shoes</p>
                             </div>
                            <div class="row">
                                <div class="col s12">
                                    <a href="{$url.global}/login" class="btn waves-effect waves-light right">Login</a>
                                </div>
                            </div>
                        {/if}
                </div>
            </div>
            </div>
        </div>
    </div>
</section>


{$modules.footer}