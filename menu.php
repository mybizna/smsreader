<?php

$this->add_menu("sms", "smsreader", "Sms Reader", "/smsreader/admin/incoming", "fas fa-cogs", 5);

$this->add_submenu("sms", "smsreader", "Incoming", "/smsreader/admin/incoming", 5);
$this->add_submenu("sms", "smsreader", "Format", "/smsreader/admin/format", 5);
$this->add_submenu("sms", "smsreader", "Payment", "/smsreader/admin/payment", 5);
$this->add_submenu("sms", "smsreader", "Account", "/smsreader/admin/account", 5);
$this->add_submenu("sms", "smsreader", "Requests", "/smsreader/admin/requests", 5);
$this->add_submenu("sms", "smsreader", "Template", "/smsreader/admin/template", 5);
$this->add_submenu("sms", "smsreader", "Whitelist", "/smsreader/admin/whitelist", 5);
$this->add_submenu("sms", "smsreader", "Blacklist", "/smsreader/admin/blacklist", 5);
