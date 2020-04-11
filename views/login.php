<?php
/** @var $model AuthFormModel */

use services\Auth\models\AuthFormModel; ?>
<br />
<h5>Please fill the form below</h5>
<hr />
<form class="form-inline" action="/auth/login" method="post">
    <div class="form-row">
        <div class="mb-3 mr-sm-3">
            <?php
            $hasError = !empty($model->getErrors()['login']);
            $error = $model->getErrors()['login'] ?? '';
            ?>
            <input type="text" class="form-control <?=$hasError ? 'is-invalid' : ''?>" placeholder="Login" name="login" value="<?=$result['login'] ?? ''?>">
            <?php if ($hasError) { ?>
                <div class="text-danger">
                    <small><?=$error?></small>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3 mr-sm-3">
            <?php
            $hasError = !empty($model->getErrors()['password']);
            $error = $model->getErrors()['password'] ?? '';
            ?>
            <input type="password" class="form-control <?=$hasError ? 'is-invalid' : ''?>" placeholder="Password" name="password">
            <?php if ($hasError) { ?>
                <div class="text-danger">
                    <small><?=$error?></small>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3 mr-sm-3">
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </div>
    </div>
</form>