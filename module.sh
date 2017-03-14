echo Wpisz sciezke modulu:
read mod
echo Wpisz nazwe modulu:
read name
echo "#######################################"
echo Tworze foldery...
sleep 2
##############################################
mkdir $mod/module/$name/
mkdir $mod/module/$name/config/
mkdir $mod/module/$name/src/
mkdir $mod/module/$name/view/
mkdir $mod/module/$name/src/Controller/
touch $mod/module/$name/src/Controller/DefaultController.php
mkdir $mod/module/$name/src/Form/
touch $mod/module/$name/src/Form/DefaulForm.php
mkdir $mod/module/$name/src/Model/
touch $mod/module/$name/src/Model/DefaultModel.php
name2="${name,,}" #lowercase
mkdir $mod/module/$name/view/$name2/
mkdir $mod/module/$name/view/$name2/$name2/
touch $mod/module/$name/view/$name2/$name2/index.phtml
echo Foldery utworzone, tworze Module.php...
sleep 2
echo "#######################################"
###############################################
#touch $mod/module/$name/src/Module.php
echo -e "<?php\nnamespace $name;\n\n
use Zend\ModuleManager\Feature\ConfigProviderInterface;\n\n
class Module implements ConfigProviderInterface\n
{\n
\tpublic function getConfig()\n
\t{\n
\t\treturn include __DIR__ . '/config/module.config.php';\n
\t}\n
}\n" >> $mod/module/$name/src/Module.php
###############################################
echo Module.php utworzony.
echo "#######################################"
echo "Wykonaj w pliku composer.json:
'autoload': {
    'psr-4': {
        'Application\\': 'module/Application/src/',
  ------->>\"$name\\\": \"module/$name/src/\"<<--------
    }
},"
echo Nacisnij enter jesli wykonales
read
echo "composer dump-autoload"
composer dump-autoload
sleep 2
echo "#######################################"
echo Tworze module.config.php...
sleep 2
echo "<?php

namespace $name;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\\${name}Controller::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];" >> $mod/module/$name/config/module.config.php
echo module.config.php utworzony.
echo "#######################################"
echo Dodaj nazwe swojego modulu do config/modules.config.php
echo "#######################################"

