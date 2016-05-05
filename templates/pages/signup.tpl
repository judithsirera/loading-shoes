{$modules.head}

<section id="signup">
    <div class="container extra-margin-top">
        <div class="row">
            <div class="col s6">
                <img class="img-signUp" src="{$url.global}/imag/signUp.png" alt="" />
            </div>
            <div class="col s6 box">
                <div class="row">
                    <div class="col s12">
                        <h1>Sign up</h1>
                        <p>or <a href="{$url.global}/login">log in</a></p>
                    </div>
                </div>
                <div class="row">
                    {if $to_active}
                    <div class="col s12 borders-box">
                        <p>To activate: {$to_active}</p>
                    </div>
                    {/if}
                    {if $active_link}
                        <div class="col s12 borders-box">
                            <p>To activate: <a href="{$active_link}">click to active your account</a></p>
                        </div>
                    {/if}
                    {if $error_msg}
                    <div class="col s12 error-message borders-box">
                        <p>{$error_msg}</p>
                    </div>
                    {/if}
                </div>
                <div class="row">
                    <form class="col s12" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="user_name" id="user_name" type="text" class="validate" value="{$username_value}" required>
                                <label for="user_name" data-error="wrong" data-success="right">User name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="user_email" id="email" type="email" class="validate" value="{$email_value}" required>
                                <label for="email" data-error="wrong" data-success="right">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="user_password" id="password" type="password" class="validate" value="{$password_value}" required>
                                <label for="password" data-error="wrong" data-success="right">Password</label>
                                <span class="instructions right">Minimum 6 characters, maximum 10 characters</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div style="width: 100%; margin-left: auto" id="fileInput" class="file-field input-field">
                                    <div style="height: 3rem" class="btn waves-effect waves-light btn-large">
                                        <span>File</span>
                                        <input id="fileName" name="fileName" type="file" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="user_twitter" id="twitter" type="text" value="{$twitter_value}" class="validate">
                                <label for="twitter" data-error="wrong" data-success="right">Twitter user</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-large right" type="submit" name="submit">Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{$modules.footer}