<?php
    include_once 'autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $php_library_title; ?></title>
</head>

<body>
<?php
    echo '<h1>Welcome to ' . $php_library_title . '</h1>'; 
    echo $php_library_description . '<br/>' . PHP_EOL;
    
    echo 'Projcet is open-sourced under MIT licence on <a href="https://github.com/90zlaya/php-library">GitHub</a>. Available over <a href="https://getcomposer.org/">Composer</a> and <a href="https://packagist.org/packages/90zlaya/php-library">Packagist</a>.' . PHP_EOL;
    echo '<h2/>' . ucfirst($php_library_folder_demonstrations) . '</h2>' . PHP_EOL;
    echo '<ol>' . $navigation_for_demonstration . '</ol>' . PHP_EOL;
    echo '<h2/>' . ucfirst($php_library_folder_modules) . '</h2>' . PHP_EOL;
    echo '<ol>' . $navigation_for_modules . '</ol>' . PHP_EOL;
    
    echo '<p>Copyright &#169; 2017 | <a href="https://www.zlatanstajic.com/">Zlatan Stajić</a> | All Rights Reserved</p>' . PHP_EOL;
?>
</body>
</html>