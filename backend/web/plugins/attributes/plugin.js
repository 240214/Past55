/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 *
 * Version: 1.0 (2022-03-30)
 * https://www.tiny.cloud/docs/advanced/creating-a-plugin/#exampleplugin
 */
(function () {
    'use strict';

    var global = tinymce.util.Tools.resolve('tinymce.PluginManager');

    var global$1 = tinymce.util.Tools.resolve('tinymce.dom.RangeUtils');

    var global$2 = tinymce.util.Tools.resolve('tinymce.util.Tools');

    var allowHtmlInNamedAttribute = function (editor) {
      return editor.getParam('allow_html_in_named_attribute', false, 'boolean');
    };

    var namedAttributeSelector = 'a:not([href])';
    var isEmptyString = function (str) {
      return !str;
    };
    var getIdFromAttribute = function (elm) {
      var id = elm.getAttribute('id') || elm.getAttribute('name');
      return id || '';
    };
    var isAttribute = function (elm) {
      return elm && elm.nodeName.toLowerCase() === 'a';
    };
    var isNamedAttribute = function (elm) {
      return isAttribute(elm) && !elm.getAttribute('href') && getIdFromAttribute(elm) !== '';
    };
    var isEmptyNamedAttribute = function (elm) {
      return isNamedAttribute(elm) && !elm.firstChild;
    };

    var removeEmptyNamedAttributesInSelection = function (editor) {
      var dom = editor.dom;
      global$1(dom).walk(editor.selection.getRng(), function (nodes) {
        global$2.each(nodes, function (node) {
          if (isEmptyNamedAttribute(node)) {
            dom.remove(node, false);
          }
        });
      });
    };
    var isValidId = function (id) {
      return /^[A-Za-z][A-Za-z0-9\-:._]*$/.test(id);
    };
    var getNamedAttribute = function (editor) {
      return editor.dom.getParent(editor.selection.getStart(), namedAttributeSelector);
    };
    var getId = function (editor) {
      var attribute = getNamedAttribute(editor);
      if (attribute) {
        return getIdFromAttribute(attribute);
      } else {
        return '';
      }
    };
    var createAttribute = function (editor, id) {
      editor.undoManager.transact(function () {
        if (!allowHtmlInNamedAttribute(editor)) {
          editor.selection.collapse(true);
        }
        if (editor.selection.isCollapsed()) {
          editor.insertContent(editor.dom.createHTML('a', { id: id }));
        } else {
          removeEmptyNamedAttributesInSelection(editor);
          editor.formatter.remove('namedAttribute', null, null, true);
          editor.formatter.apply('namedAttribute', { value: id });
          editor.addVisual();
        }
      });
    };
    var updateAttribute = function (editor, id, attributeElement) {
      attributeElement.removeAttribute('name');
      attributeElement.id = id;
      editor.addVisual();
      editor.undoManager.add();
    };
    var insert = function (editor, id) {
      var attribute = getNamedAttribute(editor);
      if (attribute) {
        updateAttribute(editor, id, attribute);
      } else {
        createAttribute(editor, id);
      }
      editor.focus();
    };

    var insertAttribute = function (editor, newId) {
      if (!isValidId(newId)) {
        editor.windowManager.alert('Id should start with a letter, followed only by letters, numbers, dashes, dots, colons or underscores.');
        return false;
      } else {
        insert(editor, newId);
        return true;
      }
    };
    var open = function (editor) {
      var currentId = getId(editor);
      editor.windowManager.open({
        title: 'Attribute',
        size: 'normal',
        body: {
          type: 'panel',
          items: [{
              name: 'id',
              type: 'input',
              label: 'ID',
              placeholder: 'example'
            }]
        },
        buttons: [
          {
            type: 'cancel',
            name: 'cancel',
            text: 'Cancel'
          },
          {
            type: 'submit',
            name: 'save',
            text: 'Save',
            primary: true
          }
        ],
        initialData: { id: currentId },
        onSubmit: function (api) {
          if (insertAttribute(editor, api.getData().id)) {
            api.close();
          }
        }
      });
    };

    var register = function (editor) {
      editor.addCommand('mceAttribute', function () {
        open(editor);
      });
    };

    var isNamedAttributeNode = function (node) {
      return node && isEmptyString(node.attr('href')) && !isEmptyString(node.attr('id') || node.attr('name'));
    };
    var isEmptyNamedAttributeNode = function (node) {
      return isNamedAttributeNode(node) && !node.firstChild;
    };
    var setContentEditable = function (state) {
      return function (nodes) {
        for (var i = 0; i < nodes.length; i++) {
          var node = nodes[i];
          if (isEmptyNamedAttributeNode(node)) {
            node.attr('contenteditable', state);
          }
        }
      };
    };
    var setup = function (editor) {
      editor.on('PreInit', function () {
        editor.parser.addNodeFilter('a', setContentEditable('false'));
        editor.serializer.addNodeFilter('a', setContentEditable(null));
      });
    };

    var registerFormats = function (editor) {
      editor.formatter.register('namedAttribute', {
        inline: 'a',
        selector: namedAttributeSelector,
        remove: 'all',
        split: true,
        deep: true,
        attributes: { id: '%value' },
        onmatch: function (node, _fmt, _itemName) {
          return isNamedAttribute(node);
        }
      });
    };
    var isToc = function (editor) {
        return function (elm) {
            return elm && editor.dom.is(elm, '.' + getTocClass(editor)) && editor.getBody().contains(elm);
        };
    };

    var register$1 = function (editor) {
      editor.ui.registry.addToggleButton('attribute', {
        icon: 'bookmark',
        tooltip: 'Attribute',
        onAction: function () {
          return editor.execCommand('mceAttribute');
        },
        onSetup: function (buttonApi) {
          return editor.selection.selectorChangedWithUnbind('a:not([href])', buttonApi.setActive).unbind;
        }
      });
      editor.ui.registry.addMenuItem('attribute', {
        icon: 'bookmark',
        text: 'Attribute...',
        onAction: function () {
          return editor.execCommand('mceAttribute');
        }
      });
        editor.ui.registry.addContextToolbar('attributes', {
            items: 'attributeupdate',
            predicate: isToc(editor),
            scope: 'node',
            position: 'node'
        });
    };

    function Plugin () {
      global.add('attribute', function (editor) {
        setup(editor);
        register(editor);
        register$1(editor);
        editor.on('PreInit', function () {
          registerFormats(editor);
        });
      });
    }

    Plugin();

}());
