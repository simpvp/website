<?php

namespace Flow\Tests\Repository;

use Flow\Model\UUID;
use Flow\Repository\TreeRepository;
use Flow\Tests\FlowTestCase;
use Wikimedia\Rdbms\IDatabase;

/**
 * @covers \Flow\Repository\TreeRepository
 *
 * @group Flow
 */
class TreeRepositoryTest extends FlowTestCase {

	/** @var UUID */
	private $ancestor;
	/** @var UUID */
	private $descendant;

	protected function setUp(): void {
		parent::setUp();
		$this->ancestor = UUID::create( false );
		$this->descendant = UUID::create( false );
	}

	public function testSuccessfulInsert() {
		$cache = $this->getCache();
		$treeRepository = new TreeRepository( $this->mockDbFactory( true ), $cache );
		$this->assertTrue( $treeRepository->insert( $this->descendant, $this->ancestor ) );
	}

	protected function mockDbFactory( $dbResult ) {
		$dbFactory = $this->getMockBuilder( \Flow\DbFactory::class )
			->disableOriginalConstructor()
			->getMock();
		$dbFactory->method( 'getDB' )
			->willReturn( $this->mockDb( $dbResult ) );
		return $dbFactory;
	}

	protected function mockDb( $dbResult ) {
		$db = $this->createMock( IDatabase::class );
		$db->method( $this->logicalOr( 'insert', 'insertSelect' ) )
			->willReturn( $dbResult );
		$db->method( 'addQuotes' )
			->willReturn( '' );
		return $db;
	}

}
