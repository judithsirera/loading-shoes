{$modules.head}

<section id="login">
    <div class="container extra-margin-top">
        <div class="row">
            <div class="col s6">
                <img class="img-logIn" src="{$url.global}/imag/logIn.jpg" alt="" />
            </div>
            <div class="col s6 box">
                <div class="row">
                    <div class="col s12">
                        <h1>Log in</h1>
                        <p>or <a href="{$url.global}/signup">sign up</a></p>
                    </div>
                </div>
                <div class="row">
                    {if $error_msg}
                        <div class="col s12 error-message borders-box">
                            <p>{$error_msg}</p>
                        </div>
                    {/if}
                </div>
                <div class="row">
                    <form method="POST" class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="user_name" id="user_name" type="text" class="validate" required>
                                <label for="user_name">User name or email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="password" id="password" type="password" class="validate" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-large right" type="submit" name="login">Log in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{$modules.footer}