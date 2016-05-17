{$modules.head}

<section id="login">
    <div class="container extra-margin-top">
        <div class="row">
            <div class="col s7">
                <img class="img-logIn" src="{$url.global}/imag/pensando.png" alt="" />
            </div>
            <div class="row">
                <div class="col s4">
                    <h1>Password reestablishment</h1>
                </div>
                <div class="col s5 box">
                    <div class="row">
                         {if $error_msg}
                             <div class="col s12 error-message borders-box">
                                <p>{$error_msg}</p>
                            </div>
                        {/if}
                    </div>
                    <div class="row">
                        {if $to_active}
                            <p for="user_name">Check your mail and spam folder to end the process </p>
                        {else}
                    <form method="POST" class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="user_name" id="user_name" type="text" class="validate" required>
                                <label for="user_name">Write your email account or your username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-large right" type="submit" name="login">Send</button>
                            </div>
                        </div>
                    </form>
                        {/if}
                </div>
            </div>
            </div>
        </div>
    </div>
</section>


{$modules.footer}