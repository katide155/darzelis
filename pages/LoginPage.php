<?php

?>


    <div id="login">
        <h3 class="text-center text-white pt-5">Norėdami naudotis sistema, prisijunkite</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12 login-form">
                        <form id="login-form" class="form" action="includes/logindata.php" method="post" >
                            <h3 class="text-center text-info login-form-text">Prisijungimo duomenys:</h3>
                            <div class="form-group">
                                <label for="username" class="text-info login-form-text">Vartotojo vardas:</label><br>
                                <input type="text" name="email" id="username" class="form-control">
								<input type="hidden" name="login" value="1"/>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info login-form-text">Slaptažodis:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group ">
                                <input type="submit" name="submit" name="prisijungti" class="button-sub" value="Prisijungti">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
