/**
 * Analytics
 *
 * SPDX-FileCopyrightText: 2019-2022 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

/** global: OC */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
    OCA.Analytics.Reference.init();
})

if (!OCA.Analytics) {
    /**
     * @namespace
     */
    OCA.Analytics = {};
}
/**
 * @namespace OCA.Analytics.Reference
 */
OCA.Analytics.Reference = {
    init: function () {
        _registerWidget('analytics', async (el, {richObjectType, richObject, accessible}) => {
            el.innerHTML = '<a href="' + richObject.url + '" target="_blank" style="display: flex;">'
                + '<img src="' + richObject.image + '" style="width: 20%; padding: 20px; opacity:.5;">'
                + '<div style="width: 75%; padding:10px;">'
                + '<div style="font-weight: 600;">' + richObject.name + '</div>'
                + '<br>'
                + '<div>' + richObject.subheader + '</div>'
                //+ '<div style="color: var(--color-text-maxcontrast);">' + richObject.url + '</div>'
                + '</div></a>';
        }, () => {}, { hasInteractiveView: false });
    },
}