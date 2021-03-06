var wpmsLinkTitle;

(function ($) {
    var inputs = {};

    wpmsLinkTitle = {
        origsetDefaultValues: null,
        origmceRefresh: null,
        origgetAttrs: null,
        origupdateFields: null,
        orightmlUpdate: null,
        init: function () {
            // Put the title field back where it belongs
            $('.wp-link-text-field').before('<div class="link-title-field"><label><span>' + wpmsLinkTitleL10n.titleLabel + '</span><input id="wp-link-title" type="text" name="linktitle" /></label></div>');

            // Move search results lower to avoid overlapping
            $('<style type="text/css"> .has-text-field #wp-link #search-panel .query-results { top: 235px; } </style>').appendTo('head');

            inputs.wrap = $('#wp-link-wrap');
            inputs.submit = $('#wp-link-submit');

            // Input
            inputs.url = $('#wp-link-url');
            inputs.title = $('#wp-link-title');
            inputs.text = $('#wp-link-text');
            inputs.openInNewTab = $('#wp-link-target');

            // override several functions in wpLink, save the originals
            if ('undefined' !== typeof wpLink) {
                wpmsLinkTitle.origsetDefaultValues = wpLink.setDefaultValues;
                wpmsLinkTitle.origmceRefresh = wpLink.mceRefresh;
                wpmsLinkTitle.origgetAttrs = wpLink.getAttrs;
                wpmsLinkTitle.origupdateFields = wpLink.updateFields;
                wpmsLinkTitle.orightmlUpdate = wpLink.htmlUpdate;

                wpLink.setDefaultValues = wpmsLinkTitle.setDefaultValues;
                wpLink.mceRefresh = wpmsLinkTitle.mceRefresh;
                wpLink.getAttrs = wpmsLinkTitle.getAttrs;
                wpLink.updateFields = wpmsLinkTitle.updateFields;
                wpLink.htmlUpdate = wpmsLinkTitle.htmlUpdate;
            }

            $('#wp-link').find('.query-results').on('river-select', wpmsLinkTitle.updateFields);
        },
        mceRefresh: function () {
            var editor = tinymce.get(wpActiveEditor),
                    selectedNode = editor.selection.getNode(),
                    linkNode = editor.dom.getParent(selectedNode, 'a[href]');

            if (linkNode) {
                inputs.title.val(editor.dom.getAttrib(linkNode, 'title'));
            }
            return wpmsLinkTitle.origmceRefresh.apply(this, arguments);
        },
        getAttrs: function () {
            attrs = wpmsLinkTitle.origgetAttrs.apply(this, arguments);
            attrs.title = (inputs.title.val()).trim();
            return attrs;
        },
        htmlUpdate: function () {
            var attrs, text, html, begin, end, cursor, selection,
                    textarea = wpLink.textarea;

            if (!textarea) {
                return;
            }

            attrs = wpmsLinkTitle.getAttrs();
            text = inputs.text.val();

            // If there's no href, return.
            if (!attrs.href) {
                return;
            }

            // Build HTML
            html = '<a href="' + attrs.href + '"';

            if (attrs.title) {
                title = attrs.title.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                html += ' title="' + title + '"';
            }

            if (attrs.target) {
                html += ' target="' + attrs.target + '"';
            }

            html += '>';

            // Insert HTML
            if (document.selection && wpLink.range) {
                // IE
                // Note: If no text is selected, IE will not place the cursor
                //       inside the closing tag.
                textarea.focus();
                wpLink.range.text = html + (text || wpLink.range.text) + '</a>';
                wpLink.range.moveToBookmark(wpLink.range.getBookmark());
                wpLink.range.select();

                wpLink.range = null;
            } else if (typeof textarea.selectionStart !== 'undefined') {
                // W3C
                begin = textarea.selectionStart;
                end = textarea.selectionEnd;
                selection = text || textarea.value.substring(begin, end);
                html = html + selection + '</a>';
                cursor = begin + html.length;

                // If no text is selected, place the cursor inside the closing tag.
                if (begin === end && !selection) {
                    cursor -= 4;
                }

                textarea.value = (
                        textarea.value.substring(0, begin) +
                        html +
                        textarea.value.substring(end, textarea.value.length)
                        );

                // Update cursor position
                textarea.selectionStart = textarea.selectionEnd = cursor;
            }

            wpLink.close();
            textarea.focus();
        },
        updateFields: function (e, li) {
            inputs.title.val(li.hasClass('no-title') ? '' : li.children('.item-title').text());
        },
        setDefaultValues: function () {
            inputs.title.val('');
            return wpmsLinkTitle.origsetDefaultValues.apply(this, arguments);
        }
    };

    $(document).ready(wpmsLinkTitle.init);
})(jQuery);
