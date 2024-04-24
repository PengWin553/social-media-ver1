<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index-styles.css">
    <link rel="stylesheet" href="css/modal-styles.css">
</head>
<body>
    <main>
        <!-- left-side -->
        <div class="left-side">
            <div class="text-container">
                <div class="logo-text">facebook</div>
                <div class="sub-text">Connect with friends and  the world <br>around you on Facebook.</div>
            </div>
        </div>
         

        <!-- right-side -->
        <div class="right-side">
            <div class="form-container">
                <form action="">
                    <div class="input-container">
                        <input type="email" autocomplete="off" placeholder="Email" id="login-email" >
                        <input type="password" autocomplete="off" placeholder="Password" id="login-password">
                    </div>
                 
                    <button class="btn-login" id="btn-login">Log in</button>
                    <a href="" class="forgot-password-link">Forgot password?</a>
                    <div class="btn-container">
                        <button class="btn-create" type="button" data-bs-toggle="modal" data-bs-target="#sign-up">Create new account</button>
                    </div>
                </form>
            </div>
            <div class="add-text">
                <p> <span> Create a Page </span> for a celebrity, brand or business.</p>
            </div>
        </div>

        <!-- modal-signup -->
        <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#sign-up">Create</button> -->
        <!-- create account -->
        <div class="modal fade" id="sign-up" tabindex="-1" aria-labelledby="create-account-text" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h1 class="" id="create-account-text">Sign up</h1> 
                        <h3 class="">It's quick and easy</h3>
                       
                    </div>
                    <div class="modal-body">
                        <form id="sign-up-form">

                            <div class="two-inputs-container">
                                <input type="text" placeholder="First Name"  name="first_name" id="first_name">
                                <input type="text" placeholder="Last Name"  name="last_name" id="last_name">
                            </div> 

                            <div class="one-input-container">
                                <input type="email" placeholder="Email"  name="email" id="email">
                            </div>

                            <div class="one-input-container">
                                <input type="password" placeholder="Password" name="password" id="password">
                            </div>

                            <h6 class="birthday">Birthday</h6>
                            <div class="three-inputs-container">
                                <select name="month" id="month">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>

                                <select name="day" id="day">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                               
                                <input type="number" min="1900" max="2099" step="1" value="2024" id="year">
                            </div>

                            <h6 class="gender">Gender</h6>
                            <div class="three-radios-container">
                                <label> <input type="radio" name="gender" value="Female" id="female"> Female </label>
                                <label> <input type="radio" name="gender" value="Male" id="male"> Male </label>
                                <label> <input type="radio" name="gender" value="Custom" id="custom"> Custom </label>
                            </div>
                            <!-- <label for="name">Category Name</label> -->
                            <!-- <input type="text" name="name" id="categoryName" class="form-control"> -->
                        </form>
                    </div>

                    <div class="extra-text-container">
                        <p>People who use our service may have uploaded your contact information to Facebook. <span class="extra-text">Learn more.</span></p>
                        <p style="margin-top: -0.5em">By clicking Sign Up, you agree to our <span class="extra-text">Terms</span> , <span class="extra-text">Privacy Policy</span> and <span class="extra-text">Cookies Policy</span>. You may receive SMS Notifications from us and can opt out any time</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-create modal-button" id="btn-signup">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/register.js"></script>
    <script src="js/login.js"></script>
</body>
</html>