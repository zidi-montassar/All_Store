<?php

session_start();

session_destroy();

header('Location: ' . $root->url('Login'));

exit();