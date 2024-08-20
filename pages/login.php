<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login_css.css">
    <title>Login</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            transition: 0.2s linear;
        }

        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0;
            width: 100vw;
            height: 100vh;
            background: #DAD6CD;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-column {
            width: 40%;
            height: 70%;
            display: flex;
            justify-content: start;
            align-items: center;
            flex-direction: column;
        }

        .left-column h1 {
            margin-top: 5%;
            font-size: 3rem;
        }

        .left-column h3 {
            font-style: italic;
            font-weight: normal;
            text-align: center;
        }

        .left-column form {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin: 10% 0;
        }

        .left-column form input {
            width: 100%;
            height: 35px;
            border: none;
            background-color: #fff;
            opacity: 0.5;
            font-size: large;
        }

        .left-column form a {
            text-decoration: none;
            color: black;
            font-style: italic;
            font-size: .8rem;
            padding: 3%;
        }

        button {
            margin-top: 5%;
            background-color: #B66F30;
            color: #f2f2f2;
            font-size: .9rem;
            height: 35px;
            width: 100%;
            border-radius: 15px;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #a04b00;
        }

        .right-column {
            width: 30%;
            height: 70%;
            background-image: url(../assets/LOGINN.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .right-column h2 {
            margin-top: 5%;
        }

        .right-column h3 {
            font-size: 1rem;
            font-weight: lighter;
            margin: 2% 0;
            font-style: italic;
        }

        .right-column a {
            opacity: 0.8;
            background-color: #B66F30;
            text-decoration: none;
            color: #f2f2f2;
            border-radius: 15px;
            width: 35%;
            height: 35px;
            text-align: center;
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: .9rem;
        }

        .toast-container .error, .toast-container .success {
            position: absolute;
            top: 2%;
            color: #f2f2f2;
            width: fit-content;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            left: 0;
            right: 0;
            margin: auto;
            padding: 0 10px;
            z-index: 1000;
        }

        .toast-container .error {
            background-color: #ff4545;
        }

        .toast-container .success {
            background-color: #4caf50;
        }

        /* Animation styles */
        .entryarea {
            position: relative;
            height: 80px;
            line-height: 80px;
        }

        .input {
            position: absolute;
            width: 100%;
            outline: none;
            font-size: 2.2em;
            padding: 0 30px;
            line-height: 80px;
            border-radius: 10px;
            border: 2px solid #f0ffff;
            background: transparent;
            transition: 0.2s ease; /* Transition applied correctly */
            z-index: 1; /* Ensure it's on top of labelline */
        }

        .labelline {
            position: absolute;
            font-size: 1.6em;
            color: #f0ffff;
            padding: 0 25px;
            margin: 0 20px;
            background-color: #1c2841;
            transition: 0.2s ease; /* Transition applied correctly */
        }

        .input:focus,
        .input:valid {
            color: #66ff00;
            border: 4px solid #66ff00;
        }

        .input:focus + .labelline,
        .input:valid + .labelline {
            color: #66ff00;
            height: 30px;
            line-height: 30px;
            padding: 0 12px;
            transform: translate(-15px, -16px) scale(0.88);
            z-index: 0; /* Ensure it's behind the input */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-column">
            <h1>WELCOME</h1>
            <h3>Capture, organize, and access your <br> ideas effortlessly.</h3>

            <form action="./_login.php" method="POST">
                <div class="entryarea">
                    <input type="text" class="input" name="user_input" required>
                    <div class="labelline">Email or Username</div>            
                    
                    <input autocomplete="off" type="password" name="password">
                    <div class="labelline">Password</div>
                </div>
                
                <a href="forgotpass.php">Forgot Password?</a>
                <button type="submit">LOGIN</button>
            </form>
        </div>
        <div class="right-column">
            <h2>NEW HERE?</h2>
            <h3>Why wait? Join us now and <br> experience the difference!</h3>
            <a href="signup.php">SIGN UP</a>
        </div>
    </div>

    <script src="../script/login.js"></script>
</body>
</html>
