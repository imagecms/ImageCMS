<?php
header("Content-Type: text/html; charset=UTF-8");
setlocale(LC_ALL, 'en_US.UTF-8');
bindtextdomain ("t1", "./locale");
//bindtextdomain ("template", "./locale");

textdomain ("t1");
echo gettext("Basic test"), "\n";

textdomain ("t1");
echo _("foo"), "\n";

textdomain ("messages");
echo gettext("Basic test"), "\n";
