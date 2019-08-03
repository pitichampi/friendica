<?php

namespace Friendica\Test\src\Core\Cache;

use Friendica\Core\Cache\MemcacheCacheDriver;
use Friendica\Core\Config\Configuration;

/**
 * @requires extension memcache
 */
class MemcacheCacheDriverTest extends MemoryCacheTest
{
	protected function getInstance()
	{
		$configMock = \Mockery::mock(Configuration::class);

		$configMock
			->shouldReceive('get')
			->with('system', 'memcache_host')
			->andReturn('localhost');
		$configMock
			->shouldReceive('get')
			->with('system', 'memcache_port')
			->andReturn(11211);

		$this->cache = new MemcacheCacheDriver('localhost', $configMock);
		return $this->cache;
	}

	public function tearDown()
	{
		$this->cache->clear(false);
		parent::tearDown();
	}
}
