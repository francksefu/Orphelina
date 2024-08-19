<?php
  require_once __DIR__.'/../features/Child.php';
  $enfant_child = new Enfant();
  $default_array = $enfant_child->read();
  $total_child = count($default_array);