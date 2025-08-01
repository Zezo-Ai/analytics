<?php
/**
 * Analytics
 *
 * SPDX-FileCopyrightText: 2019-2024 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */


return [
	'routes' => [
		['name' => 'page#main', 'url' => '/', 'verb' => 'GET'],
		['name' => 'page#report', 'url' => '/r/{id}', 'verb' => 'GET'],
		['name' => 'page#dataset', 'url' => '/d/{id}', 'verb' => 'GET'],
		['name' => 'page#panorama', 'url' => '/pa/{id}', 'verb' => 'GET'],
		['name' => 'page#indexPublic', 'url' => '/p/{token}', 'verb' => 'GET'],
		['name' => 'page#indexPublicMin', 'url' => '/pm/{token}', 'verb' => 'GET'],
		['name' => 'page#authenticatePassword', 'url' => '/p/{token}', 'verb' => 'POST'],

		// Report
		['name' => 'report#index', 'url' => '/report', 'verb' => 'GET'],
		['name' => 'report#create', 'url' => '/report', 'verb' => 'POST'],
		['name' => 'report#read', 'url' => '/report/{reportId}', 'verb' => 'GET'],
		['name' => 'report#delete', 'url' => '/report/{reportId}', 'verb' => 'DELETE'],
                ['name' => 'report#update', 'url' => '/report/{reportId}', 'verb' => 'PUT'],
                ['name' => 'report#rename', 'url' => '/report/{reportId}/rename', 'verb' => 'PUT'],
		['name' => 'report#createCopy', 'url' => '/report/copy', 'verb' => 'POST'],
		['name' => 'report#createFromDataFile', 'url' => '/report/file', 'verb' => 'POST'],
		['name' => 'report#updateOptions', 'url' => '/report/{reportId}/options', 'verb' => 'POST'],
		['name' => 'report#updateRefresh', 'url' => '/report/{reportId}/refresh', 'verb' => 'POST'],
		['name' => 'report#updateGroup', 'url' => '/report/{reportId}/group', 'verb' => 'POST'],
		['name' => 'report#getOwnFavoriteReports', 'url' => '/favorites', 'verb' => 'GET'],
		['name' => 'report#setFavorite', 'url' => '/favorite/{reportId}', 'verb' => 'POST'],
		['name' => 'report#export', 'url' => '/report/export/{reportId}', 'verb' => 'GET'],
		['name' => 'report#import', 'url' => '/report/import/', 'verb' => 'POST'],

		// Dataset
		['name' => 'dataset#index', 'url' => '/dataset', 'verb' => 'GET'],
		['name' => 'dataset#create', 'url' => '/dataset', 'verb' => 'POST'],
		['name' => 'dataset#read', 'url' => '/dataset/{datasetId}', 'verb' => 'GET'],
                ['name' => 'dataset#delete', 'url' => '/dataset/{datasetId}', 'verb' => 'DELETE'],
                ['name' => 'dataset#update', 'url' => '/dataset/{datasetId}', 'verb' => 'PUT'],
                ['name' => 'dataset#rename', 'url' => '/dataset/{datasetId}/rename', 'verb' => 'PUT'],
                ['name' => 'dataset#updateGroup', 'url' => '/dataset/{datasetId}/group', 'verb' => 'POST'],
                ['name' => 'dataset#createGroup', 'url' => '/dataset/group', 'verb' => 'POST'],
                ['name' => 'dataset#status', 'url' => '/dataset/{datasetId}/status', 'verb' => 'GET'],
                ['name' => 'dataset#provider', 'url' => '/dataset/{datasetId}/provider', 'verb' => 'POST'],

		// Panorama
		['name' => 'panorama#index', 'url' => '/panorama', 'verb' => 'GET'],
		['name' => 'panorama#create', 'url' => '/panorama', 'verb' => 'POST'],
		['name' => 'panorama#read', 'url' => '/panorama/{panoramaId}', 'verb' => 'GET'],
                ['name' => 'panorama#delete', 'url' => '/panorama/{panoramaId}', 'verb' => 'DELETE'],
                ['name' => 'panorama#update', 'url' => '/panorama/{panoramaId}', 'verb' => 'PUT'],
                ['name' => 'panorama#rename', 'url' => '/panorama/{panoramaId}/rename', 'verb' => 'PUT'],
                ['name' => 'panorama#updateGroup', 'url' => '/panorama/{panoramaId}/group', 'verb' => 'POST'],
                ['name' => 'panorama#createGroup', 'url' => '/panorama/group', 'verb' => 'POST'],
                ['name' => 'panorama#getOwnFavoriteReports', 'url' => '/panoramaFavorites', 'verb' => 'GET'],
		['name' => 'panorama#setFavorite', 'url' => '/panoramaFavorite/{panoramaId}', 'verb' => 'POST'],

		// Data Output
		['name' => 'output#read', 'url' => '/data/{reportId}', 'verb' => 'GET'],
		['name' => 'output#readPanorama', 'url' => '/data/pa/{reportId}', 'verb' => 'GET'],
		['name' => 'output#readPublic', 'url' => '/data/public/{token}', 'verb' => 'GET'],
		['name' => 'output#readPreview', 'url' => '/data', 'verb' => 'POST'],

		// Data Maintenance
		['name' => 'dataload#updateData', 'url' => '/data/{reportId}', 'verb' => 'PUT'],
		['name' => 'dataload#deleteData', 'url' => '/data/{reportId}', 'verb' => 'DELETE'],
		['name' => 'dataload#deleteDataSimulate', 'url' => '/data/deleteDataSimulate', 'verb' => 'POST'],
		['name' => 'dataload#importClipboard', 'url' => '/data/importCSV', 'verb' => 'POST'],
		['name' => 'dataload#importFile', 'url' => '/data/importFile', 'verb' => 'POST'],

		// Data loads
		['name' => 'dataload#create', 'url' => '/dataload', 'verb' => 'POST'],
		['name' => 'dataload#read', 'url' => '/dataload', 'verb' => 'GET'],
		['name' => 'dataload#update', 'url' => '/dataload/{dataloadId}', 'verb' => 'PUT'],
		['name' => 'dataload#delete', 'url' => '/dataload/{dataloadId}', 'verb' => 'DELETE'],
		['name' => 'dataload#simulate', 'url' => '/dataload/simulate', 'verb' => 'POST'],
		['name' => 'dataload#execute', 'url' => '/dataload/execute', 'verb' => 'POST'],
		['name' => 'dataload#copy', 'url' => '/dataload/copy', 'verb' => 'POST'],

		// Datasource
		['name' => 'datasource#index', 'url' => '/datasource', 'verb' => 'GET'],
		['name' => 'datasource#indexFiltered', 'url' => '/datasource/{datasourceType}', 'verb' => 'GET'],

		// Share
		['name' => 'share#create', 'url' => '/share', 'verb' => 'POST'],
		['name' => 'share#readReport', 'url' => '/share/report/{item_source}', 'verb' => 'GET'],
		['name' => 'share#readPanorama', 'url' => '/share/panorama/{item_source}', 'verb' => 'GET'],
		['name' => 'share#update', 'url' => '/share/{shareId}', 'verb' => 'PUT'],
		['name' => 'share#delete', 'url' => '/share/{shareId}', 'verb' => 'DELETE'],

		// Threshold
		['name' => 'threshold#create', 'url' => '/threshold', 'verb' => 'POST'],
                ['name' => 'threshold#read', 'url' => '/threshold/{reportId}', 'verb' => 'GET'],
                ['name' => 'threshold#delete', 'url' => '/threshold/{thresholdId}', 'verb' => 'DELETE'],
                ['name' => 'threshold#reorder', 'url' => '/threshold/order/{reportId}', 'verb' => 'PUT'],

		// API
		// V1
		[
			'name' => 'ApiData#preflighted_cors',
			'url' => '/api/1.0/{path}',
			'verb' => 'OPTIONS',
			'requirements' => ['path' => '.+']
		],
		['name' => 'ApiData#addData', 'url' => '/api/1.0/adddata/{datasetId}', 'verb' => 'POST'],

		// V2
		[
			'name' => 'ApiData#preflighted_cors',
			'url' => '/api/2.0/{path}',
			'verb' => 'OPTIONS',
			'requirements' => ['path' => '.+']
		],
		['name' => 'ApiData#addDataV2', 'url' => '/api/2.0/adddata/{datasetId}', 'verb' => 'POST'],
		['name' => 'ApiData#deleteDataV2', 'url' => '/api/2.0/deletedata/{datasetId}', 'verb' => 'POST'],

		// V3
		[
			'name' => 'ApiData#preflighted_cors',
			'url' => '/api/3.0/{path}',
			'verb' => 'OPTIONS',
			'requirements' => ['path' => '.+']
		],
		['name' => 'ApiData#dataAddV3', 'url' => '/api/3.0/data/{datasetId}/add', 'verb' => 'POST'],
		['name' => 'ApiData#dataDeleteV3', 'url' => '/api/3.0/data/{datasetId}/delete', 'verb' => 'POST'],
		['name' => 'ApiData#dataGetV3', 'url' => '/api/3.0/data/{reportId}', 'verb' => 'GET'],
		['name' => 'ApiData#datasetIndexV3', 'url' => '/api/3.0/datasets', 'verb' => 'GET'],
		['name' => 'ApiData#reportIndexV3', 'url' => '/api/3.0/reports', 'verb' => 'GET'],
		['name' => 'ApiData#reportDetailV3', 'url' => '/api/3.0/report/{reportId}', 'verb' => 'GET'],

		// V4
		[
			'name' => 'ApiData#preflighted_cors',
			'url' => '/api/4.0/{path}',
			'verb' => 'OPTIONS',
			'requirements' => ['path' => '.+']
		],
		['name' => 'ApiData#addDataV4', 'url' => '/api/4.0/data/{datasetId}/add', 'verb' => 'POST'],

		// wizard
		['name' => 'wizard#dismiss', 'url' => '/wizard', 'verb' => 'POST'],

		// whatsnew
		['name' => 'whatsNew#get', 'url' => '/whatsnew', 'verb' => 'GET'],
		['name' => 'whatsNew#dismiss', 'url' => '/whatsnew', 'verb' => 'POST'],
	]
];
