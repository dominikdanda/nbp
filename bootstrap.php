<?php

require './config.php';
require './SimpleValidator.php';
require './ReplyBroker.php';
require './InputBroker.php';
require './NBPApi.php';

$simpleValidator = new SimpleValidator();
$replyBroker = new ReplyBroker();
$inputBroker = new InputBroker();
$NBPApi = new NBPApi();