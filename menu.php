<?php

$this->add_menu("sms", "smsreader", "Sms Reader", "/smsreader/admin/sms", "fas fa-cogs", 5);

$this->add_submenu("sms", "smsreader", "Format", "/smsreader/admin/format", 5);
$this->add_submenu("sms", "smsreader", "Payment", "/smsreader/admin/payment", 5);
$this->add_submenu("sms", "smsreader", "Format", "/smsreader/admin/sms", 5);
