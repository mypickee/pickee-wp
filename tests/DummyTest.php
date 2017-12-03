<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DummyTest extends TestCase {
  public function testAlwaysPass() {
    $this->assertEquals(true, true);
  }
}
