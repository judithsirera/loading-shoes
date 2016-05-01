{$modules.head}

<section id="recharge">
    <div class="container extra-margin-top">
        <div class="row">
            <div class="col s6 box">
                <div class="row">
                    <div class="col s12">
                        <h1>Charge</h1>
                    </div>
                </div>
                <div class="row">
                    {if $error_msg}
                        <div class="col s12 error-message borders-box">
                            <p>{$error_msg}</p>
                        </div>
                    {/if}
                    {if $itsDone}
                        <div class="col s12 borders-box center">
                            <p>Your recharge has been successfully!</p>
                        </div>
                    {/if}
                </div>
                <div class="row">
                    <div class="offset-s1 col s6">
                        <h5>Your actual money:</h5>
                    </div>
                    <div class="col s3">
                        <h5 class="right actual-money">{$my_money}<i class="material-icons">euro_symbol</i></h5>
                    </div>
                </div>
                <div class="row recharge-box">
                    <form class="col s12" method="POST">
                        <div class="row">
                            <div class="col s6">
                                <h5>How much money</h5>
                            </div>
                            <div class="input-field col s6">
                                <input name="money" id="money" type="number" class="validate" min="1" max="100" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <h5>Method to pay</h5>
                            </div>
                            <div class="input-field row">
                                <div class="col s4">
                                    <input name="method" type="radio" id="visa" required>
                                    <label for="visa">VISA</label>
                                </div>
                                <div class="col s4">
                                    <input name="method" type="radio" id="paypal" required>
                                    <label for="paypal">Paypal</label>
                                </div>
                                <div class="col s4">
                                    <input name="method" type="radio" id="transfer" required>
                                    <label for="transfer">Transfer</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-large right" type="submit" name="submit">Charge</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col s6">
                <img class="img-recharge" src="{$url.global}/imag/recharge.jpg" alt="" />
            </div>
        </div>
    </div>
</section>


{$modules.footer}