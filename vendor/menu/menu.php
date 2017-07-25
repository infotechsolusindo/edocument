<?php
class Menu {
    function __construct() {
        logs('Generate Side Left Menu ----------------------------------------------------------');
        $menu = new _Menufactory;
        $menu->setGroup($_SESSION['idwewenang']);
        //$menu->setTopParent(1);
        $this->menus = $this->getMenus($menu->loadMenus());
    }
    private function getMenus($menus) {
        $s = '';
        foreach ($menus as $m) {
            $s .= "
                  <li class=\"sub-menu\">
                    <a href=\"$m->url\"><i class=\"$m->icon\"></i><span>$m->mname</span></a>
            " . PHP_EOL;
            if (isset($m->children) && !empty($m->children)) {
                $c = $this->getSubMenus($m->children);
                $s .= "<ul class=\"sub\">$c</ul>" . PHP_EOL;
            }
            $s .= "</li>";
        }
        return $s;
    }
    private function getSubMenus($menus) {
        $s = '';
        foreach ($menus as $m) {
            $s .= "<li id=\"menu$m->id\"><a href=\"$m->url\">$m->mname</a></li>";
        }
        return $s;
    }
}
