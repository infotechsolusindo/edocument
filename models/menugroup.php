<?php
/**
 *

 */
class MenuGroup extends Model {
    function __construct() {
        $db = DB_ENGINE;
        parent::__construct(new $db);
    }
    public function getmenugroup($idgroup = null) {
        $sql = "select user_group.*,_menugroup.*,_menu.* from _menugroup inner join user_group on user_group.idgroup = _menugroup.idgroup inner join _menu on _menu.id = _menugroup.idmenu";
        if (!is_null($idgroup)) {
            $sql .= " where _menugroup.idgroup = $idgroup";
        }
        $result = $this->_db->Exec($sql);
        return $result;
    }
    public function simpanMenuGroup($data) {
        $this->_db->setTable('_menugroup');
        return $this->_db->Create($data);
    }
    public function show($idgroup, $idmenu) {
        $sql = "select user_group.*,_menugroup.*,_menu.* from _menugroup inner join user_group on user_group.idgroup = _menugroup.idgroup inner join _menu on _menu.id = _menugroup.idmenu where _menugroup.idgroup = $idgroup and _menugroup.idmenu = $idmenu";
        return $this->_db->Exec($sql);
    }
    public function ubahMenuGroup($oldgroup, $oldmenu, $idgroup, $idmenu) {
        $sql = "update _menugroup set idgroup = $idgroup, idmenu = $idmenu where idgroup = $oldgroup and idmenu = $oldmenu";
        return $this->_db->Exec($sql);
    }
    public function hapus($idgroup, $idmenu) {
        if ($idgroup == '' && $idmenu == '') {
            return;
        }

        $sql = "delete from _menugroup where idgroup = $idgroup and idmenu = $idmenu ";
        $this->_db->Exec($sql);
    }
}