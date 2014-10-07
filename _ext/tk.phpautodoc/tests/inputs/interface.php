<?php

/**
 * here is docs for IHello interface
 */
interface IHello {
  /**
   * here is docs for doc_world method
   */
  public function doc_world($name);
  public function undoc_world($name);
  /**
   * @access private
   */
  public function private_access_world($name) {
  }
}
?>
