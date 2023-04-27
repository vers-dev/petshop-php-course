<?php
session_start();
include('../../services/functions.php');

unset($_SESSION['AUTH_ID']);
session_destroy();

redirect('');