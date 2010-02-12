<?php
include(dirname(__FILE__).'/../../../../../../../test/bootstrap/unit.php');

$t = new lime_test(10, new lime_output_color());

class sfImageResizeGenericTest extends sfImageResizeGeneric
{
  public function computeTargetSize($source_w, $source_h)
  {
    return parent::computeTargetSize($source_w, $source_h);
  }
}

$resizeTransform = new sfImageResizeGenericTest(null, null, false, true);

$t->diag('->computeTargetSize()');

  // @test
  $resizeTransform->setWidth(100);
  $result = array(100, 200); 
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() does nothing if width is ok');

  // @test
  $resizeTransform->setWidth(50);
  $result = array(50, 100);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() can shrink image');

  // @test
  $resizeTransform->setWidth(200);
  $result = array(100, 200);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() does not magnify image');

  // @test
  $resizeTransform->setHeight(200);
  $result = array(100, 200);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() does nothing if height is ok');

  // @test
  $resizeTransform->setHeight(100);
  $result = array(50, 100);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() can shrink image');
    
  // @test
  $resizeTransform->setHeight(400);
  $result = array(100, 200);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() does not magnify image');

  // @test
  $resizeTransform->setWidth(50);
  $resizeTransform->setHeight(100);
  $resizeTransform->setWidth(50);$resizeTransform->setHeight(100);
  $result = array(50, 100);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() can resize if target format have the same width/height ratio than current');

  // @test
  $resizeTransform->setWidth(100);
  $resizeTransform->setHeight(100);
  $result = array(50, 100);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() can resize if target format implies height contraint');

  // @test
  $resizeTransform->setWidth(50);
  $resizeTransform->setHeight(200);
  $result = array(50, 100);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() can resize if target format implies width contraint');

  // @test
  $resizeTransform->setWidth(123);
  $resizeTransform->setHeight(456);
  $resizeTransform->setInflate(true);
  $resizeTransform->setProportional(false);
  $result = array(123, 456);
  $t->is($resizeTransform->computeTargetSize(100, 200), $result, '->computeTargetSize() can force target format');
