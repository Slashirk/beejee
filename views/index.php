<?php
/** @var $model TaskCreateFormModel */
/** @var $tasks */
/** @var $pagination Paginator */
/** @var $success boolean */
/** @var $isAdmin */
/** @var $sorts array */

use helpers\UrlHelper;
use services\Tasks\models\TaskCreateFormModel;
use voku\helper\Paginator;

[$field, $direction, $url] = $sorts;

?>
<br />
<form class="form-inline" action="/" method="post">
    <div class="form-row">
        <div class="mb-3 mr-sm-3">
            <?php
            $hasError = !empty($error = $model->getError('name'));
            ?>
            <input type="text" class="form-control <?=$hasError ? 'is-invalid' : ''?>" placeholder="Name" name="name" value="<?=$model->name ?? ''?>">
            <?php if ($hasError) { ?>
                <div class="text-danger">
                    <small><?=$error?></small>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3 mr-sm-3">
            <?php
            $hasError = !empty($error = $model->getError('email'));
            ?>
            <input type="text" class="form-control <?=$hasError ? 'is-invalid' : ''?>" placeholder="Email" name="email" value="<?=$model->email ?? ''?>">
            <?php if ($hasError) { ?>
                <div class="text-danger">
                    <small><?=$error?></small>
                </div>
            <?php } ?>
        </div>
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
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
            <?php if ($success) { ?>
                <span class="text-success" role="alert">
                    &nbsp; Task Created
                </span>
            <?php } ?>
        </div>
    </div>
</form>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <?php if ($isAdmin) { ?>
                <th scope="col">Actions</th>
            <?php } ?>
            <th scope="col">
                <a href="/?<?=UrlHelper::getSortLink('name')?>">
                    Name
                    <?php if ($field == 'name') { ?><i class="fa fa-fw fa-sort-<?=$direction?>"></i><?php } ?>
                </a>
            </th>
            <th scope="col">
                <a href="/?<?=UrlHelper::getSortLink('email')?>">
                    Email
                    <?php if ($field == 'email') { ?><i class="fa fa-fw fa-sort-<?=$direction?>"></i><?php } ?>
                </a>
            </th>
            <th scope="col">Description</th>
            <th scope="col" style="text-align: center">
                <a href="/?<?=UrlHelper::getSortLink('state')?>">
                    Status
                    <?php if ($field == 'state') { ?><i class="fa fa-fw fa-sort-<?=$direction?>"></i><?php } ?>
                </a>
            </th>
            <th scope="col" style="text-align: center">Updated By Administrator</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task) { ?>
            <tr>
                <th scope="row"><?=$task['id']?></th>
                <?php if ($isAdmin) { ?>
                    <td>
                        <a href="/site/update/?id=<?=$task['id']?>"><i class="fa fa-edit"></i></a>
                    </td>
                <?php } ?>
                <td><?=$task['name']?></td>
                <td><?=$task['email']?></td>
                <td><?=$task['description']?></td>
                <td style="text-align: center">
                    <input type="checkbox" <?=$task['state'] == 1 ? 'checked="checked"' : ''?> disabled>
                </td>
                <td style="text-align: center">
                    <input type="checkbox" <?=$task['updated'] == 1 ? 'checked="checked"' : ''?> disabled>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">

        </div>
        <div class="col-md-auto">
            <?=$pagination->page_links(!empty($url) ? "?$url&" : "?");?>
        </div>
        <div class="col col-lg-2">

        </div>
    </div>
</div>


