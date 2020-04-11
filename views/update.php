<?php
/** @var $model TaskUpdateFormModel */

use services\Tasks\models\TaskModel;
use services\Tasks\models\TaskUpdateFormModel; ?>
<br />

<form class="form-inline" action="/site/update?id=<?=$_GET['id']?>" method="post">
    <div class="form-row">
        <div class="mb-3 mr-sm-3">
            <?php
            $hasError = !empty($error = $model->getError('description'));
            ?>
            <input type="text" class="form-control <?=$hasError ? 'is-invalid' : ''?>" placeholder="Description" name="description" value="<?=$model->description ?? ''?>">
            <?php if ($hasError) { ?>
                <div class="text-danger">
                    <small><?=$error?></small>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3 mr-sm-3">
            <input name="state" value="1" type="checkbox" class="form-control" <?=$model->state == 1 ? 'checked="checked"' : ''?>> Status
        </div>
        <div class="mb-3 mr-sm-3">
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </div>
    </div>
</form>
