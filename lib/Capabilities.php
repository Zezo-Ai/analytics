<?php
/**
 * Analytics
 *
 * SPDX-FileCopyrightText: 2019-2024 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\Analytics;

use OCP\Capabilities\ICapability;
use OCA\Analytics\AppInfo\Application;
use OCP\IL10N;
use OCP\IURLGenerator;

class Capabilities implements ICapability {

	public function __construct(
		private IL10N $l10n,
		private IURLGenerator $urlGenerator,) {
	}

	/**
	 * Expose the endpoint to create a report from a csv file
	 */
	public function getCapabilities() {
		return [
			'client_integration' => [
				Application::APP_ID => [
					'version' => 0.1,
					'context-menu' => [
						[
							'name' => $this->l10n->t('Visualize data in Analytics'),
							'url' => '/ocs/v2.php/apps/analytics/createFromDataFile',
							'method' => 'POST',
							'mimetype_filters' => 'text/csv',
							'params' => ['fileId' => '{fileId}'],
							'icon' => $this->urlGenerator->imagePath('analytics', 'app-integration.svg'),
						],
					],
				],
			],
		];
	}
}
