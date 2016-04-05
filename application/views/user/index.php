<!DOCTYPE html>
<html>
    <head>
    </head>
    <body class="o-page">
        <div id="content" style="min-height:480px;">
            <div>
                <h2>Welcome! Please Log In</h2>
                <form method="post" action="/efa/user/login">
                    <input placeholder="Email address" name="email" type="text" class="form-control" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}$" required><br>
                    <input placeholder="Password" name="password" type="password" class="form-control" pattern="[A-Za-z0-9]{1,16}" required><br>
                    <input name="button" type="submit" class="btn btn-primary" value="Log In"><br>
                </form>
                <!--
                Below we include the Login Button social plugin. This button uses
                the JavaScript SDK to present a graphical Login button that triggers
                the FB.login() function when clicked.
                
                <a href="fbconfig.php"><span class="btn btn-primary">Login with Facebook</span></a>
                -->
            </div>
            <div>
                <h2>Not signed up?</h2>
                <form method="post" action="/efa/user/register">
                    <input placeholder="First name" name="firstName" type="first" class="form-control" pattern="[A-Za-z]{1,16}" required><br>
                    <input placeholder="Last name" name="lastName" type="last" class="form-control" pattern="[A-Za-z]{1,16}" required><br>
                    <input placeholder="Email address" name="email" type="text" class="form-control" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}$" required><br>
                    <input placeholder="Password" name="password" type="password" class="form-control" id="password1" pattern="[A-Za-z0-9]{1,16}" required><br>
                    <input placeholder="Confirm Password" name="passwordconf" type="password" class="form-control" id="password2" pattern="[A-Za-z0-9]{1,16}" required oninput="check();"><br>
                    <input type="submit" class="btn btn-primary" value="Sign up"><br>
                </form>
            </div>
        </div>

        <div class="subFooter" style="bottom:0;">Copyright 2015. All rights reserved.</div>

        <script>
            function check() {
                var p1 = $("#password1");
                var p2 = $("#password2");
                if (p1.val() == p2.val()) {
                    p1.get(0).setCustomValidity("");
                    return true;
                }
                else {
                    p1.get(0).setCustomValidity("Passwords do not match");
                    return false; 
                }
            }
        </script>
    </body>
</html>
