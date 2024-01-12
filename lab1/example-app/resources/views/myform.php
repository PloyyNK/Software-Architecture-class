<?php

use Collective\Html\FormFacade as Form;

?>

<h1>User Info</h1>
<?php $messages =  $errors->all
('<p style="color:red">:message</p>') ?>
<?php
foreach ($messages as $msg)
{
echo $msg; }
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
<?= Form::submit('Send it!') ?>
<?php echo Form::close() ?>