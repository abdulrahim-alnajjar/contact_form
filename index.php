<?php

/** Post request */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    /** posted data */
    $user = strip_tags($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);

    $form_errors = [];

    /** validation */
    if (empty($user)) {
        $form_errors['user_error'] = 'Please inter username';
    } elseif (strlen($user) <= 3) {
        $form_errors['user_error'] = 'User is not valid';
    }
    if (empty($email)) {
        $form_errors['email_error'] = 'Please inter an email';
    }
    if (empty($mobile)) {
        $form_errors['mobile_error'] = 'Please inter mobile number';
    }

    # Mail Function
    if (empty($form_errors)) {
        mail('hisamjoon2@gmail.com', 'Contact Form', "$user,$mobile,", 'From: ' . $email . "\r\n");
        $user = "";
        $email = "";
        $mobile = "";
        $send_succeded = '<div class="send-succeded">send sucessfuly</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact From</title>
    <link rel="stylesheet" href="./css/contact.css">
    <link rel="stylesheet" href="./css/Normalize.css">
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-title">Form</div>
            <?php if (isset($send_succeded))
                echo $send_succeded; ?>


            <!-- Username -->
            <div <?php if (isset($form_errors['user_error'])) {
                echo 'style="border-color: #ff4c4c;"';
            } ?>   class="form-input">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <path
                        d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                </svg>
                <input type="text" name="username" placeholder="User" value="<?php if (isset($user))
                    echo $user ?>">
                </div>
                <!-- User Error message -->
            <?php if (isset($form_errors['user_error'])) {
                    echo '<div class="error-message">' . $form_errors['user_error'] . '</div>';
                }
                ?>


            <!-- Email -->
            <div <?php if (isset($form_errors['email_error'])) {
                echo 'style="border-color: #ff4c4c;"';
            } ?>   class="form-input">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                    <path
                        d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z" />
                </svg>
                <input type="email" name="email" placeholder="Email" value="<?php if (isset($email))
                    echo $email ?>">
                </div>
                <!-- Email Error message -->
            <?php if (isset($form_errors['email_error'])) {
                    echo '<div class="error-message">' . $form_errors['email_error'] . '</div>';
                }
                ?>


            <!-- Mobile -->
            <div <?php if (isset($form_errors['mobile_error'])) {
                echo 'style="border-color: #ff4c4c;"';
            } ?> class="form-input">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                    <path
                        d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64H80V384H304V64z" />
                </svg>
                <input type="text" name="mobile" placeholder="Mobile" value="<?php if (isset($mobile))
                    echo $mobile ?>">
                </div>
                <!-- Mobile Error message -->
            <?php if (isset($form_errors['mobile_error'])) {
                    echo '<div class="error-message">' . $form_errors['mobile_error'] . '</div>';
                }
                ?>


            <!-- Submit -->
            <div class="submit">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                    <path
                        d="M16.1 260.2c-22.6 12.9-20.5 47.3 3.6 57.3L160 376V479.3c0 18.1 14.6 32.7 32.7 32.7c9.7 0 18.9-4.3 25.1-11.8l62-74.3 123.9 51.6c18.9 7.9 40.8-4.5 43.9-24.7l64-416c1.9-12.1-3.4-24.3-13.5-31.2s-23.3-7.5-34-1.4l-448 256zm52.1 25.5L409.7 90.6 190.1 336l1.2 1L68.2 285.7zM403.3 425.4L236.7 355.9 450.8 116.6 403.3 425.4z" />
                </svg> -->
                <input type="submit" value="Send">
            </div>
        </form>
    </div>
</body>

</html>