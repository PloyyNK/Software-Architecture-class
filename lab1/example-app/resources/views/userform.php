<?php

use Collective\Html\FormFacade as Form;

?>

<h1>User Info</h1>

<?php
$messages = $errors->all('<p style="color:red">:message</p>');
foreach ($messages as $msg) {
    echo $msg;
}
?>

<?= Form::open() ?>

<?= Form::label('email', 'Email') ?>
<?= Form::text('email', old('email')) ?>
<br>

<?= Form::label('username', 'Username') ?>
<?= Form::text('username', old('username')) ?>
<br>

<?= Form::label('password', 'Password') ?>
<?= Form::password('password') ?>
<br>

<?= Form::label('password_confirm', 'Retype your Password') ?>
<?= Form::password('password_confirm') ?>
<br>

<?= Form::label('color', 'Favorite Color') ?>
<?= Form::select('color', ['red' => 'red', 'green' => 'green', 'blue' => 'blue'], old('color')) ?>
<br>

<?= Form::submit('Send it!') ?>

<?php echo Form::close() ?>
