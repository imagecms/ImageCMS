/*
Script: RIA DHTML Tree 0.8.1
	Class for make simple DHTML Tree.
	http://linux.ria.ua/rdTree/

Date:
	05 August 2008

Browser Compatibility:
	Safari 2+, Internet Explorer 6+, Firefox 2+ (and browsers based on gecko), Opera 9+.

License:
	LGPL

Author:
	Oleg Cherniy <oleg.cherniy(at)gmail(dot)com>

*/

var rdTree = new Class({

	Implements: Options,

	options: {
		img: {
			path: theme + '/images/tree/',
			itemName: '',
			plusName: 'plus.gif',
			minusName: 'minus.gif'
		},
		classes: {
			selected: 'selected',
			opened: 'opened',
			first: 'first',
			last: 'last',
			center: 'center',
			centerNode: 'centerNode',
			lastNode: 'lastNode'
		},
		openSelectedNode: true
	},

	initialize: function(id, options){
		this.id = id;
		this.setOptions(options);
		this.makeLinkForLiText();
		this.makeSelected();
		this.make();
	},

	openParentForSelectedLink: function(link){
		var li = link.getParent('li');
		var ul = li.getParent();
		if (ul != $(this.id)) {
			var liParent = ul.getParent();
			ul.addClass(this.options.classes.opened);
			if (li.getParent().getLast() == li) {
				li.getElement('ul').setStyle('background', 'none');
			}
			this.openParentForSelectedLink(liParent.getElement('a'));
		}
	},

	makeLinkForLiText: function() {
		var menus = $(this.id).getElements('li');
		var this_cycle = this;
		menus.each(function(li, i){
			var link;
			if (li.firstChild.nodeType!=1) {
				var text = li.firstChild.nodeValue;
				link = new Element('a');
				link.set('text',text);
				link.replaces(li.firstChild);
			} else {
				link = li.getElement('a');
			}
			this_cycle.tableWrapper(link);
		});
	},

	tableWrapper: function(link) {
		var table = new Element('table');
		table.inject(link, 'before');
		var tbody = new Element('tbody');
		tbody.inject(table);
		var table_row = new Element('tr');
		table_row.inject(tbody);
		var icon_container = new Element('td', {'class': 'icon'} );
		icon_container.inject(table_row);
		var link_container = new Element('td');
		link_container.inject(table_row);
		link.inject(link_container);
	},

	getSelected: function() { return $(this.id).getElement('a.'+this.options.classes.selected) },

	makeSelected: function() {
		var selectedLink = this.getSelected();
		if ($chk(selectedLink)) {
			this.openParentForSelectedLink(selectedLink);
		}
	},

	changeSelected: function(link) {
		var selectedLink = this.getSelected();
		if ($chk(selectedLink)) {
			selectedLink.removeProperty('class');
		}
		link.setProperty('class', this.options.classes.selected);
		if (this.options.openSelectedNode) {
			var ul = link.getParent('li').getElement('ul');

            try{
			    this.expandNode(ul,ul.getParent().getElement('img'));
            }catch(err){
                // console.log('Error rdTree');
            }
		}


	},

	make: function(){
		var menus = $(this.id).getElements('li');
		var options = this.options;
		var this_cycle = this;
		menus.each(function(li, i){
			var link = li.getElement('a');
			var img = new Element('img');
			var ul = li.getElement('ul');

			if (li.getParent().getLast() == li)  {
				li.setProperty('class', options.classes.last);
			} else {
				li.setProperty('class', options.classes.center);
			}

			if ($chk(ul)) {
				this_cycle.applyNode(li,link,ul);
			} else {
				this_cycle.applyItem(li,link);
			}

			// Change link setup
			link.addEvent('click', function(){
				this_cycle.changeSelected(link);
			});
		});
	},


	applyNode: function(li,link,ul){
		var img = new Element('img');
		var td = link.getParent().getParent().firstChild;
		var imgSrc;
		var options = this.options;
		var this_event = this;

		if (ul.getStyle('display') == 'block') {
			imgSrc = this.options.img.minusName;
		} else {
			imgSrc = this.options.img.plusName;
		}
		img.inject(td).setProperties({'src': this.options.img.path + imgSrc});

		img.setStyle('cursor', 'pointer');

		if (li.getParent().getLast() == li) {
			ul.setStyle('background', 'none');
		}
		img.addEvent('click', function(event){
			event.preventDefault();
			this_event.toggleNode(ul,img);
		});

		if (li.getParent().getLast() == li) {
			li.setProperty('class', this.options.classes.lastNode);
		} else {
			li.setProperty('class', this.options.classes.centerNode);
		}
	},

	applyItem: function(li,link){
		if (this.options.img.itemName != '') {
			var img = new Element('img');
			var td = link.getParent().getParent().firstChild;
			img.inject(td).setProperties({'src': this.options.img.path + this.options.img.itemName});
		}
	},

	/* ----------------------------------------- */
	// Service methods
	toggleNode: function(ul,img) {
		if (ul.hasClass(this.options.classes.opened)) {
			this.collapseNode(ul,img);
		} else {
			this.expandNode(ul,img);
		}
	},

	expandNode: function(ul,img) {
		ul.setProperty('class', this.options.classes.opened);
		img.setProperties({'src': this.options.img.path + this.options.img.minusName});
	},

	collapseNode: function(ul,img) {
		ul.removeProperty('class');
		img.setProperties({'src': this.options.img.path + this.options.img.plusName});;
	},

	expandAll: function(id) {
		var root;
		if (id != null) {
			root = $(id).getParent('li');
		} else {
			root = $(this.id);
		}
		var uls = root.getElements('ul');
		var this_cycle = this;
		uls.each(function(ul, i){
			if (!(ul.hasClass(this_cycle.options.classes.opened))) {
				this_cycle.expandNode(ul,ul.getParent().getElement('img'));
			}
		});
	},

	collapseAll: function(id) {
		var root;
		if (id != null) {
			root = $(id).getParent('li');
		} else {
			root = $(this.id);
		}
		var uls = root.getElements('ul');
		var this_cycle = this;
		uls.each(function(ul, i){
			if (ul.hasClass(this_cycle.options.classes.opened)) {
				this_cycle.collapseNode(ul,ul.getParent().getElement('img'));
			}
		});
	},

	checkSelectedVisible: function(ul) {
		if (ul != $(this.id)) {
			if (!(ul.hasClass(this.options.classes.opened))) {
                try{
				    this.expandNode(ul,ul.getParent().getElement('img'));
                }catch(err){
                    // ...code...
                }
                try{
                    this.checkSelectedVisible(ul.getParent('ul'));
                }catch(err){
                    // ...code...
                }
			}
		}
	},

	select: function(id) {
		this.changeSelected($(id));
		this.checkSelectedVisible($(id).getParent('ul'));
	}

});
