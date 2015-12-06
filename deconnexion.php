<?php

session_start();
unset($_SESSION['auth']);
unset($_SESSION['basket']);

header('Location: ./');