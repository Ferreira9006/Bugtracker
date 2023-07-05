<?php
if (!isset($_SESSION['email']))
{
    include("includes/header.php");
?>

<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
    <h1 style="margin-bottom: 50px;"><?= HEADER ?></h1>
    <?php
    if (!empty($_POST['submit'])) 
    {
        if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordRepeat']) && !empty($_POST['captcha'])) 
        {
            $confirmCaptcha = $Common->verifyCaptcha($_POST['captcha']);

            if ($confirmCaptcha == TRUE)
            {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                $Account->register($username, $email, $password);
            }
            else 
            {
                echo "<div class='alert alert-danger' role='alert'>Incorrect captcha. Please try again.</div>";
            }
        } 
        else 
        {
            echo "<div class='alert alert-danger' role='alert'>In order to submit the report you need to fill in all fields.</div>";
        }
    }
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
    </nav>
    <hr />

    <form class="row g-3" method="POST" action="" onsubmit="return validate();">

        <div class="col-12">
            <label for="Username">Username</label>
            <input type="text" class="form-control" name="username" id="Username" maxlength="20" placeholder="Enter your Username." required>
            <div id="UsernameHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-12">
            <label for="Email">Email</label>
            <input type="email" class="form-control" name="email" id="Email" maxlength="30" placeholder="Enter your e-mail." required>
            <div id="EmailHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-12">
            <label for="Password">Password</label>
            <input type="password" class="form-control" name="password" id="Password" maxlength="30" placeholder="Enter your password." required>
            <div id="PasswordHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-12">
            <label for="PasswordRepeat">Repeat password</label>
            <input type="password" class="form-control" name="passwordRepeat" id="PasswordRepeat" maxlength="30" placeholder="Enter your password." required>
            <div id="PasswordRepeatHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-md-12">
            <label for="Captcha" class="input-group-text w-100 rounded-0 rounded-top text-center d-block"><?= $Common->generateCaptcha(CAPTCHA); ?></label>
            <input type="hidden" value ="<?= $_SESSION['captcha'] ?>" id="captchaValue">
            <input type="text" class="form-control rounded-0 rounded-bottom" placeholder="Captcha" name="captcha" id="Captcha" maxlength="<?=CAPTCHA?>" required>
            <div id="PriorityHelp" class="form-text">Required field.</div>
        </div> 

        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" name="submit" value="Register"/>
        </div>

        <script src="pages/js/register.js"></script>
    </form>
</div>

<?php
}
else
{
    header("location: ?page=home");
}

?>