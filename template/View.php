<?php

namespace li3_twig\template;

class View extends \lithium\template\View {
  protected $_processes = array(
    'all' => array('template', 'layout'),
    'template' => array('template'),
    'element' => array('element')
  );
  protected $_steps = array(
    'template' => array('path' => 'template', 'capture' => array('context' => 'content')),
    'layout' => array(
      'path' => 'layout', 'conditions' => 'layout', 'multi' => true, 'capture' => array(
        'context' => 'content'
      )
    ),
    'element' => array('path' => 'element')
  );
}

?>