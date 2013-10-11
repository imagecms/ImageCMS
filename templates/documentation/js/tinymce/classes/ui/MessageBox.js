/**
 * MessageBox.js
 *
 * Copyright, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * This class is used to create MessageBoxes like alerts/confirms etc.
 *
 * @class tinymce.ui.Window
 * @extends tinymce.ui.FloatPanel
 */
define("tinymce/ui/MessageBox", [
	"tinymce/ui/Window"
], function(Window) {
	"use strict";

	var MessageBox = Window.extend({
		/**
		 * Constructs a instance with the specified settings.
		 *
		 * @constructor
		 * @param {Object} settings Name/value object with settings.
		 */
		init: function(settings) {
			settings = {
				border: 1,
				padding: 20,
				layout: 'flex',
				pack: "center",
				align: "center",
				containerCls: 'panel',
				autoScroll: true,
				buttons: {type: "button", text: "Ok", action: "ok"},
				items: {
					type: "label",
					multiline: true,
					maxWidth: 500,
					maxHeight: 200
				}
			};

			this._super(settings);
		},

		Statics: {
			/**
			 * Ok buttons constant.
			 *
			 * @static
			 * @final
			 * @field {Number} OK
			 */
			OK: 1,

			/**
			 * Ok/cancel buttons constant.
			 *
			 * @static
			 * @final
			 * @field {Number} OK_CANCEL
			 */
			OK_CANCEL: 2,

			/**
			 * yes/no buttons constant.
			 *
			 * @static
			 * @final
			 * @field {Number} YES_NO
			 */
			YES_NO: 3,

			/**
			 * yes/no/cancel buttons constant.
			 *
			 * @static
			 * @final
			 * @field {Number} YES_NO_CANCEL
			 */
			YES_NO_CANCEL: 4,

			/**
			 * Constructs a new message box and renders it to the body element.
			 *
			 * @static
			 * @method msgBox
			 * @param {Object} settings Name/value object with settings.
			 */
			msgBox: function(settings) {
				var buttons, callback = settings.callback || function() {};

				switch (settings.buttons) {
					case MessageBox.OK_CANCEL:
						buttons = [
							{type: "button", text: "Ok", subtype: "primary", onClick: function(e) {
								e.control.parents()[1].close();
								callback(true);
							}},

							{type: "button", text: "Cancel", onClick: function(e) {
								e.control.parents()[1].close();
								callback(false);
							}}
						];
						break;

					case MessageBox.YES_NO:
						buttons = [
							{type: "button", text: "Ok", subtype: "primary", onClick: function(e) {
								e.control.parents()[1].close();
								callback(true);
							}}
						];
						break;

					case MessageBox.YES_NO_CANCEL:
						buttons = [
							{type: "button", text: "Ok", subtype: "primary", onClick: function(e) {
								e.control.parents()[1].close();
							}}
						];
						break;

					default:
						buttons = [
							{type: "button", text: "Ok", subtype: "primary", onClick: function(e) {
								e.control.parents()[1].close();
							}}
						];
						break;
				}

				return new Window({
					padding: 20,
					x: settings.x,
					y: settings.y,
					minWidth: 300,
					minHeight: 100,
					layout: "flex",
					pack: "center",
					align: "center",
					buttons: buttons,
					title: settings.title,
					items: {
						type: "label",
						multiline: true,
						maxWidth: 500,
						maxHeight: 200,
						text: settings.text
					},
					onClose: settings.onClose
				}).renderTo(document.body).reflow();
			},

			/**
			 * Creates a new alert dialog.
			 *
			 * @method alert
			 * @param {Object} settings Settings for the alert dialog.
			 * @param {function} [callback] Callback to execute when the user makes a choice.
			 */
			alert: function(settings, callback) {
				if (typeof(settings) == "string") {
					settings = {text: settings};
				}

				settings.callback = callback;
				return MessageBox.msgBox(settings);
			},

			/**
			 * Creates a new confirm dialog.
			 *
			 * @method confirm
			 * @param {Object} settings Settings for the confirm dialog.
			 * @param {function} [callback] Callback to execute when the user makes a choice.
			 */
			confirm: function(settings, callback) {
				if (typeof(settings) == "string") {
					settings = {text: settings};
				}

				settings.callback = callback;
				settings.buttons = MessageBox.OK_CANCEL;

				return MessageBox.msgBox(settings);
			}
		}
	});

	return MessageBox;
});