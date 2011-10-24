<?php
/**
 * トランザクション管理クラス
 */
class TransManager{
	private $table;
	function __construct(){
		global $xoopsDB;
		$this->table = $xoopsDB->prefix("charinavi_transcheck");
	}
	public function check($id){
		global $xoopsDB;
		$myts =& MyTextSanitizer::getInstance();
		$id = $myts->makeTboxData4Save($id);
		$sql = sprintf("SELECT COUNT(transid) FROM %s WHERE transid = '%s';", $this->table, $id);
		$res = $xoopsDB->query($sql);
		$row = $xoopsDB->fetchRow($res);
		return $row[0];
	}
	public function add($id){
		global $xoopsDB;
		$myts =& MyTextSanitizer::getInstance();
		$id = $myts->makeTboxData4Save($id);
		$sql = sprintf("INSERT INTO %s VALUES('%s', '%s');", $this->table, $id, date("Y-m-d H:i:s"));
		$res = $xoopsDB->query($sql);
	}
	public function get(){
		$id = mt_rand();
		while($this->check($id)){
			$id = mt_rand();
		}
		return $id;
	}
}