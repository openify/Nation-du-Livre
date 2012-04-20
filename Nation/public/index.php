<?php
session_start();

$project_name = basename( dirname( dirname( __FILE__ ) ) );
require_once( dirname( __FILE__ ) . '/../../Kernel/include.php' );
