{$modules.head}

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col s6">
                <img class="img-logIn" src="{$url.global}/imag/logIn.jpg" alt="" />
            </div>
            <div class="col s6">
                <div class="row">
                    <div class="col s12">
                        <h1>Log in</h1>
                        <p>or <a href="{$url.global}/signup">sign up</a></p>
                    </div>
                </div>
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="first_name" type="text" class="validate">
                                <label for="first_name">User name or email</label>
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
                                <button class="btn waves-effect waves-light btn-large right" type="submit" name="action">Log in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{$modules.footer}