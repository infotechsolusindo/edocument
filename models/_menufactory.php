<?php
class _Menufactory extends Model {
    public $menus = [];
    public $group;
    public $parent = 0;

    function __construct() {
        $db = DB_ENGINE;
        parent::__construct(new $db);
    }
    public function setGroup($group) {
        $this->group = $group;
    }
    public function setTopParent($parent) {
        $this->parent = $parent;
    }
    public function addMenu(_Menu $menu) {
        $this->menus[] = $menu;
    }
    public function loadMenus() {
        $where = "";
        $sql = "select * from _menugroup ";
        if (!is_null($this->group)) {
            $where = "idgroup = $this->group";
        }

        $where = $where == "" ? "" : "where $where";
        $sql = "$sql $where";
        $result = $this->_db->Exec($sql);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $r) {
            $p = 0;
            if (!is_null($this->parent)) {
                $p = $this->parent;
            }

            $menu = new _Menu($r->idmenu, $p);
            if (!$menu->id) {continue;}
            $this->addMenu($menu);
        }
        return $this->menus;
    }
    public function getMenuList() {
        $sql = "select * from _menu";
        return $this->_db->Exec($sql);
    }
    public function getGroupList() {
        $sql = "select mg.idgroup,mg.idmenu,m.mname from _menugroup as mg right join _menu as m on m.id = mg.idmenu";
        return $this->_db->Exec($sql);
    }
}
