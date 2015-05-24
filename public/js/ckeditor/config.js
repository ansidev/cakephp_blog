/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    config.language = 'vi';
    // config.uiColor = '#AADC6E';
    //config.skin = 'bootstrapck';
    config.skin = 'office2013';
    //config.extraPlugins = 'bootstrap';
    CKEDITOR.config.contentsCss = '/css/bootstrap.css';

    // get path of directory ckeditor
    //var basePath = CKEDITOR.basePath;
    //basePath = basePath.substr(0, basePath.indexOf("ckeditor/"));
    //(function () {
    //    CKEDITOR.plugins.addExternal('bootstrap', basePath + 'ckeditor/bootstrap-ckeditor', 'bootstrap-ckeditor.js');
    //})();
};
