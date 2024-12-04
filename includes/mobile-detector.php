<?php

require_once '../../lib/src/MobileDetect.php'; // Ajusta la ruta según la ubicación del archivo.

$detect = new \Detection\MobileDetect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');


?>