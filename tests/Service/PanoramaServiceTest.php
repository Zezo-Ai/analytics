<?php
/**
 * SPDX-FileCopyrightText: 2026 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\Analytics\Tests\Service;

use OCA\Analytics\Activity\ActivityManager;
use OCA\Analytics\Db\PanoramaMapper;
use OCA\Analytics\Service\PanoramaService;
use OCA\Analytics\Service\ShareService;
use OCA\Analytics\Service\VariableService;
use OCA\Analytics\Tests\Stubs\FakeL10N;
use OCP\Files\IRootFolder;
use OCP\IConfig;
use OCP\ITagManager;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class PanoramaServiceTest extends TestCase {
	public function testResolvePictureFileReturnsIdFromUserFolder(): void {
		$file = new class {
			public function getMimeType(): string {
				return 'image/jpeg';
			}

			public function getId(): int {
				return 42;
			}
		};
		$userFolder = new class($file) {
			public function __construct(private $file) {
			}

			public function get(string $path) {
				TestCase::assertSame('Pictures/chart.jpg', $path);
				return $this->file;
			}
		};
		$rootFolder = $this->createMock(IRootFolder::class);
		$rootFolder->expects($this->once())
			->method('getUserFolder')
			->with('u1')
			->willReturn($userFolder);

		$this->assertSame(42, $this->createService($rootFolder)->resolvePictureFile('/Pictures/chart.jpg'));
	}

	public function testResolvePictureFileRejectsUnsupportedMimeType(): void {
		$file = new class {
			public function getMimeType(): string {
				return 'application/pdf';
			}

			public function getId(): int {
				return 42;
			}
		};
		$userFolder = new class($file) {
			public function __construct(private $file) {
			}

			public function get(string $path) {
				return $this->file;
			}
		};
		$rootFolder = $this->createMock(IRootFolder::class);
		$rootFolder->method('getUserFolder')->willReturn($userFolder);

		$this->expectException(\InvalidArgumentException::class);
		$this->createService($rootFolder)->resolvePictureFile('/Documents/report.pdf');
	}

	private function createService(IRootFolder $rootFolder): PanoramaService {
		return new PanoramaService(
			'u1',
			new FakeL10N(),
			$this->createMock(LoggerInterface::class),
			$this->createMock(ITagManager::class),
			$this->createMock(ShareService::class),
			$this->createMock(PanoramaMapper::class),
			$this->createMock(IConfig::class),
			$this->createMock(VariableService::class),
			$this->createMock(ActivityManager::class),
			$rootFolder,
		);
	}
}
