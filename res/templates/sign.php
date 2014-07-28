<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <style>
            .error { color: red; }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row-fluid">
                <!-- login form -->
                <div class="col-md-6">
                    <div class="form">
                        <h1>Login</h1>

                        <?php if (count($this->loginErrors) > 0): ?>
                        <ul class="error">
                            <?php foreach ($this->loginErrors as $loginError): ?>
                            <li><?= $loginError ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <form action="<?= $this->urlGenerator->getAbsoluteUrl('user/login') ?>" method="post">
                            <div class="form-group <?= isset($this->loginErrors['name']) ? 'has-error' : ''; ?>">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?= $this->loginModel !== null ? $this->loginModel->getName() : '' ?>" />
                            </div>
                            <div class="form-group <?= isset($this->loginErrors['password']) ? 'has-error' : ''; ?>">
                                <input type="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-default" value="Login" />
                            </div>
                        </form>
                    </div>
                </div>
                <!-- registration form -->
                <div class="col-md-6">
                    <div class="form">
                        <h1>Register</h1>

                        <?php if (count($this->registrationErrors) > 0): ?>
                        <ul class="error">
                            <?php foreach ($this->registrationErrors as $registrationError): ?>
                                <li><?= $registrationError ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <form action="<?= $this->urlGenerator->getAbsoluteUrl('user/register') ?>" method="post">
                            <div  class="form-group <?= isset($this->registrationErrors['email']) ? 'has-error' : ''; ?>">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $this->registrationModel !== null ? $this->registrationModel->getEmail() : '' ?>"/>
                            </div>
                            <div  class="form-group <?= isset($this->registrationErrors['name']) ? 'has-error' : ''; ?>">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?= $this->registrationModel !== null ? $this->registrationModel->getName() : '' ?>" <?= isset($this->registrationErrors['name']) ? 'class="error"' : ''; ?> />
                            </div>
                            <div  class="form-group <?= isset($this->registrationErrors['password']) ? 'has-error' : ''; ?>">
                                <input type="password" name="password" class="form-control" placeholder="Password" />
                            </div>
                            <div class="form-group <?= isset($this->registrationErrors['repeated_password']) ? 'has-error' : ''; ?>">
                                <input type="password" name="repeated_password" class="form-control" placeholder="Repeat Password" />
                            </div>
                            <div>
                                <input type="submit" class="btn btn-default" value="Register" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>