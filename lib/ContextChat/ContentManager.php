<?php
/**
 * Analytics
 *
 * SPDX-FileCopyrightText: 2024 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\Analytics\ContextChat;

use OCP\DB\Exception;
use OCP\IL10N;
use Psr\Log\LoggerInterface;
use OCA\ContextChat\Public\ContentItem;
use OCA\Analytics\Service\StorageService;
use OCA\Analytics\Service\DatasetService;

class ContentManager {
	private $userId;
	private $logger;
	private $l10n;
	private $StorageService;
	private $DatasetService;

	public function __construct(
		$userId,
		IL10N $l10n,
		LoggerInterface $logger,
		StorageService $StorageService,
		DatasetService $DatasetService
	) {
		$this->userId = $userId;
		$this->l10n = $l10n;
		$this->logger = $logger;
		$this->StorageService = $StorageService;
		$this->DatasetService = $DatasetService;
	}

	/**
	 * Providers can use this to submit content for indexing in context chat
	 *
	 * @param int $datasetId
	 * @return void
	 * @throws Exception
	 */
	public function submitContent(int $datasetId): void {
		$storageData = $this->StorageService->read($datasetId, null);
		$datasetMetadata = $this->DatasetService->read($datasetId);

		$columns = $datasetMetadata['dimension1'] .', '.$datasetMetadata['dimension2'].', '.$datasetMetadata['value'];

		$data = array_map(function ($subArray) {
			return implode(",", $subArray);
		}, $storageData['data']);
		$dataString = implode("\n", $data);

		$content = 'This is a report of statistical data. ' . $datasetMetadata['subheader'] . '. ';
		$content .= 'The data comes in multiple rows which 3 columns separated by a comma. ';
		$content .= 'The columns are ' . $columns . '. ';
		$content .= 'The data is: ' . $dataString;

		$contentItem = new ContentItem($datasetId, 'report', $datasetMetadata['name'], $content, 'Report', new \DateTime(), ['admin']);

		$contentItems = [$contentItem];
		//$this->ContentManager->removeContentForUsers('analytics', 'report', $dataset, ['admin']);
		$this->logger->debug('adding item: ' . json_encode($contentItem));
		$this->ContentManager->submitContent('analytics', $contentItems);
		return;
	}

	/**
	 * return true if the data set has indexing activated
	 *
	 * @param int $datasetId
	 * @return bool
	 * @throws Exception
	 */
	public function isActiveForDataset(int $datasetId) {
		$datasetMetadata = $this->DatasetService->read($datasetId);
		return $datasetMetadata['ai_index'] === 1;
	}
}