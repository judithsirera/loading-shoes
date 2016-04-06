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
                    <div class="col s12 borders-box">
                        <p>To activate: <a class="center" href="#">Link</a></p>
                    </div>
                </div>
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="user_name" type="text" class="validate">
                                <label for="user_name">User name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-large right" type="submit" name="action">Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{$modules.footer}