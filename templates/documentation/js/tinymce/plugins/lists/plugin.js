/**
 * plugin.js
 *
 * Copyright, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/*global tinymce:true */

tinymce.PluginManager.add('lists', function(editor) {
	var plugin = this;

	editor.on('init', function() {
		var dom = editor.dom, selection = editor.selection;

		/**
		 * Returns a range bookmark. This will convert indexed bookmarks into temporary span elements with
		 * index 0 so that they can be restored properly after the DOM has been modified. Text bookmarks will not have spans
		 * added to them since they can be restored after a dom operation.
		 *
		 * So this: <p><b>|</b><b>|</b></p>
		 * becomes: <p><b><span data-mce-type="bookmark">|</span></b><b data-mce-type="bookmark">|</span></b></p>
		 *
		 * @param  {DOMRange} rng DOM Range to get bookmark on.
		 * @return {Object} Bookmark object.
		 */
		function createBookmark(rng) {
			var bookmark = {};

			function setupEndPoint(start) {
				var offsetNode, container, offset;

				container = rng[start ? 'startContainer' : 'endContainer'];
				offset = rng[start ? 'startOffset' : 'endOffset'];

				if (container.nodeType == 1) {
					offsetNode = dom.create('span', {'data-mce-type': 'bookmark'});

					if (container.hasChildNodes()) {
						offset = Math.min(offset, container.childNodes.length - 1);

						if (start) {
							container.insertBefore(offsetNode, container.childNodes[offset]);
						} else {
							dom.insertAfter(offsetNode, container.childNodes[offset]);
						}
					} else {
						container.appendChild(offsetNode);
					}

					container = offsetNode;
					offset = 0;
				}

				bookmark[start ? 'startContainer' : 'endContainer'] = container;
				bookmark[start ? 'startOffset' : 'endOffset'] = offset;
			}

			setupEndPoint(true);

			if (!rng.collapsed) {
				setupEndPoint();
			}

			return bookmark;
		}

		/**
		 * Moves the selection to the current bookmark and removes any selection container wrappers.
		 *
		 * @param {Object} bookmark Bookmark object to move selection to.
		 */
		function moveToBookmark(bookmark) {
			function restoreEndPoint(start) {
				var container, offset, node;

				function nodeIndex(container) {
					var node = container.parentNode.firstChild, idx = 0;

					while (node) {
						if (node == container) {
							return idx;
						}

						// Skip data-mce-type=bookmark nodes
						if (node.nodeType != 1 || node.getAttribute('data-mce-type') != 'bookmark') {
							idx++;
						}

						node = node.nextSibling;
					}

					return -1;
				}

				container = node = bookmark[start ? 'startContainer' : 'endContainer'];
				offset = bookmark[start ? 'startOffset' : 'endOffset'];

				if (!container) {
					return;
				}

				if (container.nodeType == 1) {
					offset = nodeIndex(container);
					container = container.parentNode;
					dom.remove(node);
				}

				bookmark[start ? 'startContainer' : 'endContainer'] = container;
				bookmark[start ? 'startOffset' : 'endOffset'] = offset;
			}

			restoreEndPoint(true);
			restoreEndPoint();

			var rng = dom.createRng();

			rng.setStart(bookmark.startContainer, bookmark.startOffset);

			if (bookmark.endContainer) {
				rng.setEnd(bookmark.endContainer, bookmark.endOffset);
			}

			selection.setRng(rng);
		}

		function isListNode(node) {
			return node && (/^(OL|UL)$/).test(node.nodeName);
		}

		function isFirstChild(node) {
			return node.parentNode.firstChild == node;
		}

		function isLastChild(node) {
			return node.parentNode.lastChild == node;
		}

		function isTextBlock(node) {
			return node && !!editor.schema.getTextBlockElements()[node.nodeName];
		}

		function isBookmarkNode(node) {
			return node && node.nodeName === 'SPAN' && node.getAttribute('data-mce-type') === 'bookmark';
		}

		function createNewTextBlock(contentNode, blockName) {
			var node, textBlock, hasContentNode;

			if (editor.settings.forced_root_block) {
				blockName = blockName || editor.settings.forced_root_block;
			}

			if (blockName) {
				textBlock = dom.create(blockName);
			} else {
				textBlock = dom.createFragment();
			}

			if (contentNode) {
				while ((node = contentNode.firstChild)) {
					if (!hasContentNode && (node.nodeName != 'SPAN' || node.getAttribute('data-mce-type') != 'bookmark')) {
						hasContentNode = true;
					}

					textBlock.appendChild(node);
				}
			}

			if (!editor.settings.forced_root_block) {
				textBlock.appendChild(dom.create('br'));
			} else {
				// BR is needed in empty blocks on non IE browsers
				if (!hasContentNode && (!tinymce.Env.ie || tinymce.Env.ie > 10)) {
					textBlock.appendChild(dom.create('br', {'data-mce-bogus': '1'}));
				}
			}

			return textBlock;
		}

		function getSelectedListItems() {
			return tinymce.grep(selection.getSelectedBlocks(), function(block) {
				return block.nodeName == 'LI';
			});
		}

		function splitList(ul, li, newBlock) {
			var tmpRng, fragment;

			var bookmarks = dom.select('span[data-mce-type="bookmark"]', ul);

			newBlock = newBlock || createNewTextBlock(li);
			tmpRng = dom.createRng();
			tmpRng.setStartAfter(li);
			tmpRng.setEndAfter(ul);
			fragment = tmpRng.extractContents();

			if (!dom.isEmpty(fragment)) {
				dom.insertAfter(fragment, ul);
			}

			dom.insertAfter(newBlock, ul);

			if (dom.isEmpty(li.parentNode)) {
				tinymce.each(bookmarks, function(node) {
					li.parentNode.parentNode.insertBefore(node, li.parentNode);
				});

				dom.remove(li.parentNode);
			}

			dom.remove(li);
		}

		function mergeWithAdjacentLists(listBlock) {
			var sibling, node;

			sibling = listBlock.nextSibling;
			if (sibling && isListNode(sibling) && sibling.nodeName == listBlock.nodeName) {
				while ((node = sibling.firstChild)) {
					listBlock.appendChild(node);
				}

				dom.remove(sibling);
			}

			sibling = listBlock.previousSibling;
			if (sibling && isListNode(sibling) && sibling.nodeName == listBlock.nodeName) {
				while ((node = sibling.firstChild)) {
					listBlock.insertBefore(node, listBlock.firstChild);
				}

				dom.remove(sibling);
			}
		}

		/**
		 * Normalizes the all lists in the specified element.
		 */
		function normalizeList(element) {
			tinymce.each(tinymce.grep(dom.select('ol,ul', element)), function(ul) {
				var sibling, parentNode = ul.parentNode;

				// Move UL/OL to previous LI if it's the only child of a LI
				if (parentNode.nodeName == 'LI' && parentNode.firstChild == ul) {
					sibling = parentNode.previousSibling;
					if (sibling && sibling.nodeName == 'LI') {
						sibling.appendChild(ul);

						if (dom.isEmpty(parentNode)) {
							dom.remove(parentNode);
						}
					}
				}

				// Append OL/UL to previous LI if it's in a parent OL/UL i.e. old HTML4
				if (isListNode(parentNode)) {
					sibling = parentNode.previousSibling;
					if (sibling && sibling.nodeName == 'LI') {
						sibling.appendChild(ul);
					}
				}
			});
		}

		function outdent(li) {
			var ul = li.parentNode, ulParent = ul.parentNode, newBlock;

			function removeEmptyLi(li) {
				if (dom.isEmpty(li)) {
					dom.remove(li);
				}
			}

			if (isFirstChild(li) && isLastChild(li)) {
				if (ulParent.nodeName == "LI") {
					dom.insertAfter(li, ulParent);
					removeEmptyLi(ulParent);
					dom.remove(ul);
				} else if (isListNode(ulParent)) {
					dom.remove(ul, true);
				} else {
					ulParent.insertBefore(createNewTextBlock(li), ul);
					dom.remove(ul);
					return;
				}
			} else if (isFirstChild(li)) {
				if (ulParent.nodeName == "LI") {
					dom.insertAfter(li, ulParent);
					newBlock = dom.create("LI");
					newBlock.appendChild(ul);
					dom.insertAfter(newBlock, li);
					removeEmptyLi(ulParent);
				} else if (isListNode(ulParent)) {
					ulParent.insertBefore(li, ul);
				} else {
					ulParent.insertBefore(createNewTextBlock(li), ul);
					dom.remove(li);
					return;
				}
			} else if (isLastChild(li)) {
				if (ulParent.nodeName == "LI") {
					dom.insertAfter(li, ulParent);
				} else if (isListNode(ulParent)) {
					dom.insertAfter(li, ul);
				} else {
					dom.insertAfter(createNewTextBlock(li), ul);
					dom.remove(li);
					return;
				}
			} else {
				if (ulParent.nodeName == 'LI') {
					ul = ulParent;
					newBlock = createNewTextBlock(li, 'LI');
				} else if (isListNode(ulParent)) {
					newBlock = createNewTextBlock(li, 'LI');
				} else {
					newBlock = createNewTextBlock(li);
				}

				splitList(ul, li, newBlock);
				normalizeList(ul.parentNode);
			}

			return true;
		}

		function indent(li) {
			var sibling, newList;

			sibling = li.previousSibling;

			if (sibling && sibling.nodeName == 'UL') {
				sibling.appendChild(li);
				return;
			}

			if (sibling && sibling.nodeName == 'LI' && isListNode(sibling.lastChild)) {
				sibling.lastChild.appendChild(li);
				return;
			}

			sibling = li.nextSibling;

			if (sibling && sibling.nodeName == 'UL') {
				sibling.insertBefore(li, sibling.firstChild);
				return;
			}

			if (sibling && sibling.nodeName == 'LI' && isListNode(li.lastChild)) {
				return;
			}

			sibling = li.previousSibling;
			if (sibling && sibling.nodeName == 'LI') {
				newList = dom.create(li.parentNode.nodeName);
				sibling.appendChild(newList);
				newList.appendChild(li);
			}

			/*sibling = li.nextSibling;
			if (sibling && sibling.nodeName == 'LI') {
				newList = dom.create(li.parentNode.nodeName);
				sibling.insertBefore(newList, sibling.firstChild);
				newList.appendChild(li);
			}*/

			return true;
		}

		function indentSelection() {
			var state, bookmark = createBookmark(selection.getRng(true));

			tinymce.each(getSelectedListItems(), function(li) {
				if (indent(li)) {
					state = true;
				}
			});

			moveToBookmark(bookmark);

			return state;
		}

		function outdentSelection() {
			var state, bookmark = createBookmark(selection.getRng(true));

			tinymce.each(getSelectedListItems(), function(li) {
				if (outdent(li)) {
					state = true;
				}
			});

			moveToBookmark(bookmark);

			return state;
		}

		function applyList(listName) {
			var rng = selection.getRng(true), bookmark = createBookmark(rng);

			function getSelectedTextBlocks() {
				var textBlocks = [], root = editor.getBody();

				function getEndPointNode(start) {
					var container, offset;

					container = rng[start ? 'startContainer' : 'endContainer'];
					offset = rng[start ? 'startOffset' : 'endOffset'];

					// Resolve node index
					if (container.nodeType == 1) {
						container = container.childNodes[Math.min(offset, container.childNodes.length - 1)] || container;
					}

					while (container.parentNode != root) {
						if (isTextBlock(container)) {
							return container;
						}

						if (/^(TD|TH)$/.test(container.parentNode.nodeName)) {
							return container;
						}

						container = container.parentNode;
					}

					return container;
				}

				var startNode = getEndPointNode(true);
				var endNode = getEndPointNode();
				var block, siblings = [];

				for (var node = startNode; node; node = node.nextSibling) {
					siblings.push(node);

					if (node == endNode) {
						break;
					}
				}

				tinymce.each(siblings, function(node) {
					if (isTextBlock(node)) {
						textBlocks.push(node);
						block = null;
						return;
					}

					if (dom.isBlock(node) || node.nodeName == 'BR') {
						if (node.nodeName == 'BR') {
							dom.remove(node);
						}

						block = null;
						return;
					}

					var nextSibling = node.nextSibling;
					if (isBookmarkNode(node)) {
						if (isTextBlock(nextSibling) || (!nextSibling && node.parentNode == root)) {
							block = null;
							return;
						}
					}

					if (!block) {
						block = dom.create('p');
						node.parentNode.insertBefore(block, node);
						textBlocks.push(block);
					}

					block.appendChild(node);
				});

				return textBlocks;
			}

			var textBlocks = getSelectedTextBlocks();

			tinymce.each(textBlocks, function(block) {
				var listBlock, sibling;

				sibling = block.previousSibling;
				if (sibling && isListNode(sibling) && sibling.nodeName == listName) {
					listBlock = sibling;
					block = dom.rename(block, 'LI');
					sibling.appendChild(block);
				} else {
					listBlock = dom.create(listName);
					block.parentNode.insertBefore(listBlock, block);
					listBlock.appendChild(block);
					block = dom.rename(block, 'LI');
				}

				mergeWithAdjacentLists(listBlock);
			});

			moveToBookmark(bookmark);
		}

		function removeList() {
			var bookmark = createBookmark(selection.getRng(true));

			tinymce.each(getSelectedListItems(), function(li) {
				var node, rootList;

				if (dom.isEmpty(li)) {
					outdent(li);
					return;
				}

				for (node = li; node; node = node.parentNode) {
					if (isListNode(node)) {
						rootList = node;
					}
				}

				splitList(rootList, li);
			});

			moveToBookmark(bookmark);
		}

		function toggleList(listName) {
			var parentList = dom.getParent(selection.getStart(), 'OL,UL');

			if (parentList) {
				if (parentList.nodeName == listName) {
					removeList(listName);
				} else {
					var bookmark = createBookmark(selection.getRng(true));
					mergeWithAdjacentLists(dom.rename(parentList, listName));
					moveToBookmark(bookmark);
				}
			} else {
				applyList(listName);
			}
		}

		plugin.backspaceDelete = function(isForward) {
			function findNextCaretContainer(rng, isForward) {
				var node = rng.startContainer, offset = rng.startOffset;

				if (node.nodeType == 3 && (isForward ? offset < node.data.length : offset > 0)) {
					return node;
				}

				var walker = new tinymce.dom.TreeWalker(rng.startContainer);
				while ((node = walker[isForward ? 'next' : 'prev']())) {
					if (node.nodeType == 3 && node.data.length > 0) {
						return node;
					}
				}
			}

			function mergeLiElements(fromElm, toElm) {
				var node, listNode, ul = fromElm.parentNode;

				if (isListNode(toElm.lastChild)) {
					listNode = toElm.lastChild;
				}

				node = toElm.lastChild;
				if (node && node.nodeName == 'BR' && fromElm.hasChildNodes()) {
					dom.remove(node);
				}

				while ((node = fromElm.firstChild)) {
					toElm.appendChild(node);
				}

				if (listNode) {
					toElm.appendChild(listNode);
				}

				dom.remove(fromElm);

				if (dom.isEmpty(ul)) {
					dom.remove(ul);
				}
			}

			if (selection.isCollapsed()) {
				var li = dom.getParent(selection.getStart(), 'LI');

				if (li) {
					var rng = selection.getRng(true);
					var otherLi = dom.getParent(findNextCaretContainer(rng, isForward), 'LI');

					if (otherLi && otherLi != li) {
						var bookmark = createBookmark(rng);

						if (isForward) {
							mergeLiElements(otherLi, li);
						} else {
							mergeLiElements(li, otherLi);
						}

						moveToBookmark(bookmark);

						return true;
					} else if (!otherLi) {
						if (!isForward && removeList(li.parentNode.nodeName)) {
							return true;
						}
					}
				}
			}
		};

		editor.addCommand('Indent', function() {
			if (!indentSelection()) {
				return true;
			}
		});

		editor.addCommand('Outdent', function() {
			if (!outdentSelection()) {
				return true;
			}
		});

		editor.addCommand('InsertUnorderedList', function() {
			toggleList('UL');
		});

		editor.addCommand('InsertOrderedList', function() {
			toggleList('OL');
		});
	});

	editor.on('keydown', function(e) {
		if (e.keyCode == tinymce.util.VK.BACKSPACE) {
			if (plugin.backspaceDelete()) {
				e.preventDefault();
			}
		} else if (e.keyCode == tinymce.util.VK.DELETE) {
			if (plugin.backspaceDelete(true)) {
				e.preventDefault();
			}
		}
	});
});
