<?php
    require 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>login - kasir</title>
        <link href="css/styles.css" rel="stylesheet" />

        <style type="text/css">
            body {
                background-image: url('img/img2.jpg');
                background-size: 100%;
                background-position: center;
                text-align: center;
                height: 100%;
                width: 100%;
                display: table;
                vertical-align: middle;
                }
        </style>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">


                                        <form method="post">
                                            <div class="form-group mt-2">
                                                <label for="inputEmailAddress">Username</label>
                                                <input class="form-control" id="inputEmailAddress" name ="username" type="text" placeholder="Username" />
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" name = "password" type="password" placeholder="Password" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                             </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>       
        </div>
    </body>
</html>
