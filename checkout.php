<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Cart - Paygames</title>
        <link href="css/global.css" type="text/css" rel="stylesheet" media="all" />
        <link href="css/checkout.css" type="text/css" rel="stylesheet" media="all" />
        <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet" media="all" />
        <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="js/unslider.js" type="text/javascript"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:800|Roboto&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
    </head>
    <?php
    require_once 'header.php';
    if(isset($_SESSION['register_email'])){
        $email = $_SESSION['register_email'];
    } else {
        $email = post('email');
    }
    $view_query = "SELECT * FROM `customer` WHERE `email` = '$email'";
    $view_result = execute_query($view_query);
    $view_row = mysqli_fetch_assoc($view_result);
    $view_query_check = mysqli_num_rows($view_result);
    
    ?>
    <main>
        <div class="container main-content  ">
            <div class="main-content">
                <div class="content">
                    <br/>
                    <br/>
                        <table>
                            <thead>
                                <tr><th colspan="2">Input your Email</th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Email: </th>
                                    <form action="checkout.php" method="post">
                                    <td><input type="text" name="email" value="<?php if ($email != ''){ echo $email; } ?>"/></td>
                                    <?php
                                        if ($email == '') { 
                                    ?>
                                    <td><input type="submit"/></td>
                                        <?php } ?>
                                    </form>
                                </tr>
                                <?php
                                   if ($email != '') { 
                                       if ($view_query_check != '0') {
                                ?>
                                    <form action="process/checkout.php?do=method" method="post">
                                    <input type="hidden" name="email" value="<?php echo $email ?>" />
                                    <tr>
                                        <th>Name: </th>
                                        <td><input type="text" name="name" value="<?php echo $view_row['name'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <th>Phone: </th>
                                        <td><input type="tel" name="phone" value="<?php echo $view_row['phone'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <th>Payment method:</th>
                                        <td>
                                            <select name="method">
                                                <option value="1">Online Banking</option>
                                                <option value="2">By Mobile Card</option>
                                                <option value="3">In our Store</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <input type="submit" value="Checkout"/>
                                        </th>
                                    </tr>
                                    </form>
                                    <?php
                                       } elseif ($view_query_check =='0') {
                                    ?>
                                    
                                    <form action="process/checkout.php?do=register" method="post">
                                    <input type="hidden" name="email" value="<?php echo $email ?>" />
                                    <tr>
                                        <th>Name: </th>
                                        <td><input type="text" name="name" /></td>
                                    </tr>
                                    <tr>
                                        <th>Phone: </th>
                                        <td><input type="tel" name="phone" /></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            <input type="submit" value="Register"/>
                                        </th>
                                    </tr>
                                    </form>
                                    <?php
                                    } } 
                                    ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php
    unset($_SESSION['register_email']);
    require_once 'footer.php';
    ?>