<?php

/**
 * here is docs for Hello class
 */
class Hello {
  /**
   * here is docs for doc_world method
   */
  public function doc_world($name) {
  }
  public function undoc_world($name) {
  }
  protected function protected_world($name) {
  }
  private function private_world($name) {
  }
  /**
   * @access private
   */
  public function private_access_world($name) {
  }
  function no_modifiers_world($name) {
  }

  /**
   * here is docs for $attr1 attribute
   */
  public $attr1;
  public $attr2;
  protected $attr3;
  private $attr4;
  /**
   * @access private
   */
  private $attr5;
  var $attr6;
}
?>
