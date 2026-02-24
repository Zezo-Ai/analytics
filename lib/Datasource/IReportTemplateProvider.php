<?php
/**
 * Analytics
 *
 * SPDX-FileCopyrightText: 2026 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types=1);

namespace OCA\Analytics\Datasource;

/**
 * Optional interface for data sources that provide report templates.
 */
interface IReportTemplateProvider {
	/**
	 * Return report templates keyed by a stable template id.
	 *
	 * Each template should contain at least a "report" object.
	 *
	 * @return array<string, array<string, mixed>>
	 */
	public function getReportTemplates(): array;
}
