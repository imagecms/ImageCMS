$(document).ready(function() {

    $('.languageSelect').autocomplete({
        source: base_url + 'admin/components/cp/translator/getLangaugesNames',
        select: function(event, ui) {
            $(this).attr('locale', ui.item.locale);
        }
    });

    $('.languageSelect').bind('focus', function() {
        $(this).autocomplete("search", "all_languages")
    });

    $('.showAllLanguageList').toggle(function() {
        $(this).prev().focus();
        $(this).prev().autocomplete("search", "all_languages")
    }, function() {
        $(this).prev().autocomplete("close");
    });

    $('#fileEdit').scroll(function() {
        $('.fileLines').scrollTop($(this).scrollTop());
    });

    $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
        e.stopPropagation();
    });

    // *********************** Navigate pagination *********************************************
    $('.pagination li').live('click', function() {
        Pagination.navigate($(this));
    });

    // *********************** GO Search *********************************************
    $('#searchTranslator').die().live('click', function() {
        Search.go();
    });

    $('.translateWord').live('mouseover', function() {
        setTimeout(function() {
            $('div[class="tooltip-inner"]').attr('style', 'min-width: 90px!important; text-align: center!important;');
        }, 500);
    });

    $('.translationCancel').live('mouseover', function() {
        setTimeout(function() {
            $('div[class="tooltip-inner"]').attr('style', 'min-width: 90px!important; text-align: center!important;');
        }, 500);
    });


    $('.searchObjects').die().live('change', function() {
        if ($('.searchObjects:checked').length) {
            $('.searchConditions').removeAttr('disabled');
        } else {
            $('.searchConditions').attr('disabled', '');
            $('.searchConditions').removeAttr('checked');
        }
    });

    $('.translationCancel').on('click', function() {
        $(this).next().val($(this).next().next().val());
        Translator.statisticRecount();
    });

    $('.translation').on('blur', function() {
        $(this).next().val($(this).val());
        $(this).text($(this).val());
        Translator.statisticRecount();
    });

    $('.comment').on('blur', function() {
        $(this).text($(this).val());
    });

});

var Sort = {
    init: function(curElement) {
        this.per_page = $('#per_page').val();
        this.originsArray = $('#po_table tbody tr.originTR');
        this.translationsArray = $('#po_table tbody tr.translationTR');
        this.lengthTr = this.originsArray.length;
        this.condition = false;
        this.isAsc = $(curElement).hasClass('asc');
        this.sortType = '';
    },
    default: function(curElement) {
        var lang = $('#langs').val();
        var type = $('#types').val();
        var module_template = $('#modules_templates').val();
        var per_page = $('#per_page').val();
        var url = '';

        this.removeSortArrows(curElement);

        switch (type) {
            case  'modules':
                url = '/admin/components/init_window/translator/renderModulePoFile/' + module_template + '/' + type + '/' + lang + '/0/' + per_page;
                break;
            case 'templates':
                url = '/admin/components/init_window/translator/renderModulePoFile/' + module_template + '/' + type + '/' + lang + '/0/' + per_page;
                break;
            case 'main':
                url = '/admin/components/init_window/translator/renderModulePoFile/' + type + '/' + type + '/' + lang + '/0/' + per_page;
                break;
        }
        $.ajax({url: url,
            success: function(data) {
                var tableData = data.replace(/<script[\W\w]+<\/script>/, '');
                $('#po_table tbody').html(tableData);
                $('.pagination ul li.active').removeClass('active');
                $($('.pagination ul li')[1]).addClass('active');
            }
        });
    },
    sortOrigins: function(curElement) {
        this.sortType = 'origin';
        this.sort(this.originsArray, this.translationsArray)
    },
    sortTranslations: function(curElement) {
        this.sortType = 'translation';
        this.sort(this.translationsArray, this.originsArray)
    },
    sortComments: function(curElement) {
        this.sortType = 'comment';
        this.sort(this.originsArray, this.translationsArray)
    },
    sortFuzzy: function(curElement) {
        this.init();
        this.removeSortArrows(curElement);
        var findContent = '';
        var leftContent = '';
        var condition = false;
        var fuzzy = $(curElement);

        $('#po_table tbody tr.originTR').each(function(iteration) {
            if (fuzzy.hasClass('asc')) {
                condition = $(this).find('.btn-danger').length;
            } else {
                condition = !$(this).find('.btn-danger').length;
            }
            if (condition) {
                findContent += $(this)[0].outerHTML + $(this).next()[0].outerHTML;
            } else {
                leftContent += $(this)[0].outerHTML + $(this).next()[0].outerHTML;
            }
        });

        var content = findContent + leftContent;
        if (content) {
            this.showResults(curElement, content);
        }
    },
    showResults: function(curElement, results) {
        if (results) {
            $('#po_table tbody').html(results);

            var per_page = this.per_page;
            $('#po_table tbody tr').each(function(iteration) {
                iteration = iteration / 2;
                if (iteration < per_page) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            $(curElement).addClass('active');
            if ($(curElement).hasClass('asc')) {
                $(curElement).removeClass('asc').addClass('desc');
            } else {
                $(curElement).removeClass('desc').addClass('asc');
            }
            showMessage(lang('Message'), lang('Successfully sorted.'));
        } else {
            showMessage(lang('Error'), lang('Can not sort.'), 'r');
        }
    },
    go: function(curElement) {
        this.init(curElement);
        this.removeSortArrows(curElement);

        if ($(curElement).hasClass('originHead')) {
            this.sortOrigins(curElement);
        }

        if ($(curElement).hasClass('translation')) {
            this.sortTranslations(curElement);
        }

        if ($(curElement).hasClass('comment')) {
            this.sortComments(curElement);
        }

        var results = '';
        var trnaslationArray = this.translationsArray;
        $(this.originsArray).each(function(i) {
            results += $(this)[0].outerHTML + trnaslationArray[i].outerHTML;
        });

        this.showResults(curElement, results);
    },
    swap: function(array, array2, indexA, indexB) {
        var temp = array[indexA];
        array[indexA] = array[indexB];
        array[indexB] = temp;

        var temp2 = array2[indexA];
        array2[indexA] = array2[indexB];
        array2[indexB] = temp2;
    },
    partition: function(array, array2, pivot, left, right) {

        var storeIndex = left,
                pivotValue = array[pivot];

        // put the pivot on the right
        this.swap(array, array2, pivot, right);

        // go through the rest
        for (var v = left; v < right; v++) {
            if (this.isAsc) {
                this.condition = $.trim($(array[v]).find('.' + this.sortType).text()).toLowerCase() < $.trim($(pivotValue).find('.' + this.sortType).text()).toLowerCase();
            } else {
                this.condition = $.trim($(array[v]).find('.' + this.sortType).text()).toLowerCase() > $.trim($(pivotValue).find('.' + this.sortType).text()).toLowerCase();
            }
            if (this.condition) {
                this.swap(array, array2, v, storeIndex);
                storeIndex++;
            }
        }

        // finally put the pivot in the correct place
        this.swap(array, array2, right, storeIndex);

        return storeIndex;
    },
    sort: function(array, array2, left, right) {
        var pivot = null;

        if (typeof left !== 'number') {
            left = 0;
        }

        if (typeof right !== 'number') {
            right = array.length - 1;
        }

        if (left < right) {

            pivot = left + Math.ceil((right - left) * 0.5);
            newPivot = this.partition(array, array2, pivot, left, right);

            // recursively sort to the left and right
            this.sort(array, array2, left, newPivot - 1);
            this.sort(array, array2, newPivot + 1, right);
        }

    },
    removeSortArrows: function(curElement) {
        $('.sortTable').each(function() {
            if ($(this)[0].className !== $(curElement)[0].className) {
                $(this).removeClass('asc');
                $(this).removeClass('desc');
            }
        });
    }
};

var Search = {
    perPage: 0,
    searchedObject: [],
    searchedObjectLength: 0,
    findValues: [],
    undiscoveredValues: [],
    condition: false,
    searchString: '',
    minSearchStringLength: 1,
    table: '#po_table tbody',
    tableTrs: '#po_table tbody tr',
    searchOptions: '.searchTranslatorOptions input',
    countResults: 0,
    init: function() {
        this.perPage = $('#per_page').val();
        this.searchedObject = $('#po_table tbody tr');
        this.searchedObjectLength = this.searchedObject.length;
        this.searchString = $('.searchString').val();
    },
    origin: function() {
        this.init();
        for (var i = 0; i < this.searchedObjectLength; ) {
            var origin = $(this.searchedObject[i]).find('.origin').val();
            if (this.checkCondition(origin)) {
                this.countResults += 1;
                $(this.searchedObject[i]).find('.origin').addClass('searched');
                this.findValues.push(this.searchedObject[i]);
                this.findValues.push(this.searchedObject[i + 1]);
            } else {
                $(this.searchedObject[i + 1]).find('.translation').removeClass('searched');
                $(this.searchedObject[i]).find('.origin').removeClass('searched');
                $(this.searchedObject[i]).find('.comment').removeClass('searched');
                this.undiscoveredValues.push(this.searchedObject[i]);
                this.undiscoveredValues.push(this.searchedObject[i + 1]);
            }
            i = i + 2;
        }
    },
    translation: function() {
        this.init();
        for (var i = 0; i < this.searchedObjectLength; ) {
            var translate = $(this.searchedObject[i + 1]).find('.translation').val();
            if (this.checkCondition(translate)) {
                this.countResults += 1;
                $(this.searchedObject[i + 1]).find('.translation').addClass('searched');
                this.findValues.push(this.searchedObject[i]);
                this.findValues.push(this.searchedObject[i + 1]);
            } else {
                $(this.searchedObject[i + 1]).find('.translation').removeClass('searched');
                if (!$('#originSearch').attr('checked')) {
                    $(this.searchedObject[i]).find('.origin').removeClass('searched');
                }
                $(this.searchedObject[i]).find('.comment').removeClass('searched');
                this.undiscoveredValues.push(this.searchedObject[i]);
                this.undiscoveredValues.push(this.searchedObject[i + 1]);
            }
            i = i + 2;
        }

    },
    comment: function() {
        this.init();
        for (var i = 0; i < this.searchedObjectLength; ) {
            var comment = $(this.searchedObject[i]).find('.comment').val();
            if (this.checkCondition(comment)) {
                $(this.searchedObject[i]).find('.comment').addClass('searched');
                this.findValues.push(this.searchedObject[i]);
                this.findValues.push(this.searchedObject[i + 1]);
                this.countResults += 1;
            } else {
                if (!$('#translationSearch').attr('checked')) {
                    $(this.searchedObject[i + 1]).find('.translation').removeClass('searched');
                }
                if (!$('#originSearch').attr('checked')) {
                    $(this.searchedObject[i]).find('.origin').removeClass('searched');
                }
                $(this.searchedObject[i]).find('.comment').removeClass('searched');

                this.undiscoveredValues.push(this.searchedObject[i]);
                this.undiscoveredValues.push(this.searchedObject[i + 1]);
            }
            i = i + 2;
        }
    },
    checkCondition: function(string) {
        var sensitive = $('#sensitiveSearch').attr('checked');
        if ($('#regularSearch').attr('checked')) {
            if (sensitive) {
                return string.match(new RegExp(this.searchString, 'g'));
            } else {
                return string.match(new RegExp(this.searchString, 'gi'));
            }

        } else {
            if ($('#fullStringSearch').attr('checked')) {
                return string == this.searchString;

            } else {
                if (sensitive) {
                    return string.indexOf(this.searchString) != -1;
                } else {
                    return string.toLowerCase().indexOf(this.searchString.toLowerCase()) != -1;
                }
            }
        }
    },
    displayResults: function() {
        var all = '';
        $(this.findValues.concat(this.undiscoveredValues)).each(function() {
            all += $(this)[0].outerHTML;
        })
        $(this.table).html(all);

        var searchObj = this;
        $(this.tableTrs).each(function(iteration) {
            iteration = iteration / 2;
            if (iteration < searchObj.perPage) {
                $(this).css('display', 'table-row');
            } else {
                $(this).css('display', 'none');
            }
        });
        this.findValues = [];
        this.undiscoveredValues = [];
    },
    canSearch: function() {
        var can = false;
        $(this.searchOptions).each(function() {
            if ($(this).attr('checked')) {
                can = true;
            }
        });
        return can;
    },
    go: function() {
        this.init();
        if (this.canSearch()) {
            if (this.searchString && this.searchString.length > this.minSearchStringLength) {

                if ($('#originSearch').attr('checked')) {
                    this.origin();
                    this.displayResults();
                }

                if ($('#translationSearch').attr('checked')) {
                    this.translation();
                    this.displayResults();
                }

                if ($('#commentSearch').attr('checked')) {
                    this.comment();
                    this.displayResults();
                }

                $('.pagination ul li.active').removeClass('active');
                $($('.pagination ul li')[1]).addClass('active');

                if (this.countResults) {
                    showMessage(lang('Message'), lang('Number of searched matches') + ': ' + this.countResults + '.');
                } else {
                    showMessage(lang('Message'), lang('Was not found any results'), 'r')
                }
                this.countResults = 0;
            } else {
                showMessage(lang('Error'), lang('Please, enter more than 1 symbol'), 'r')
            }
        } else {
            showMessage(lang('Error'), lang('You did not select search criteria'), 'r')
        }
    },
    goOnEnterPress: function() {
//        var start = new Date().getTime();
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            this.go();
        } else {
            return false;
        }
//        var end = new Date().getTime();
//        var time = end - start;
//        console.log('Execution time: ' + time);
    }


};

var Selectors = {
    init: function(curElement) {
        this.lang = $(curElement).closest('.poSelectorsHolder').find('#langs').val();
        this.type = $(curElement).closest('.poSelectorsHolder').find('#types').val();
        this.module_tempate = $(curElement).closest('.poSelectorsHolder').find('#modules_templates').val();
        this.per_page = parseInt($('#per_page').val());
    },
    clearContent: function() {
        $('#po_table tbody').html('');
        $('#po_table').hide();
        $('.pagination ul').html('');
        $('#per_page').hide();
        $('.pathHolder').html('');
        $('.pathParseHolder').hide();
        $('.statistic').hide();
    },
    langs: function(curElement) {
        this.init(curElement);

        if (this.lang) {
            $(curElement).closest('.poSelectorsHolder').find('#types').css('display', 'inline-block');
        } else {
            this.clearContent();
            $(curElement).closest('.poSelectorsHolder').find('#types').hide().val('');
            $(curElement).closest('.poSelectorsHolder').find('#modules_templates').val('');
            $(curElement).closest('.poSelectorsHolder').find('#modules_templates').hide().html('');

            return false;
        }

        if (!this.type) {
            this.clearContent();
        } else {
            if (this.module_tempate || this.type == 'main') {
                if (this.type == 'main')
                    this.module_tempate = 'main';

                var url = '/admin/components/init_window/translator/renderModulePoFile/' + this.module_tempate + '/' + this.type + '/' + this.lang + '/0/' + this.per_page;
                this.renderTable(url);
            }
        }
    },
    types: function(curElement) {
        this.init(curElement);
        this.clearContent();

        if (this.type) {
            $(curElement).closest('.poSelectorsHolder').find('#modules_templates').css('display', 'inline-block');
        } else {
            $(curElement).closest('.poSelectorsHolder').find('#modules_templates').hide().html('');
        }

        switch (this.type) {
            case 'modules':
                var url = '/admin/components/init_window/translator/renderModulesNames/' + this.lang;
                this.renderNames(url, curElement);
                break;
            case 'templates':
                var url = '/admin/components/init_window/translator/renderTemplatesNames/' + this.lang;
                this.renderNames(url, curElement);
                break;
            case 'main':
                $(curElement).closest('.poSelectorsHolder').find('#modules_templates').css('display', 'none');
                var url = '/admin/components/init_window/translator/renderModulePoFile/' + this.type + '/' + this.type + '/' + this.lang + '/0/' + this.per_page;
                this.renderTable(url);
                break;
        }
    },
    names: function(curElement) {
        this.init(curElement);

        if (!this.module_tempate) {
            this.clearContent();
            return false;
        }

        var url = '/admin/components/init_window/translator/renderModulePoFile/' + this.module_tempate + '/' + this.type + '/' + this.lang + '/0/' + this.per_page;
        this.renderTable(url);

    },
    renderTable: function(url) {
        $.ajax({url: url,
            success: function(data) {
                Translator.render(data);

            }
        });
    },
    renderNames: function(url, curElement) {
        $.ajax({url: url,
            success: function(data) {
                $(curElement).closest('.poSelectorsHolder').find('#modules_templates').html(data);
            }
        });
    }
};

var Translator = {
    filePath: '',
    init: function() {
        this.lang = $('#langs').val();
        this.type = $('#types').val();
        this.module_template = $('#modules_templates').val();
        this.per_page = parseInt($('#per_page').val());
    },
    getUrl: function(methodName) {
        switch (this.type) {
            case  'modules':
                return '/admin/components/init_window/translator/' + methodName + '/' + this.module_template + '/' + this.type + '/' + this.lang;
                break;
            case 'templates':
                return '/admin/components/init_window/translator/' + methodName + '/' + this.module_template + '/' + this.type + '/' + this.lang;
                break;
            case 'main':
                return '/admin/components/init_window/translator/' + methodName + '/' + this.type + '/' + this.type + '/' + this.lang;
                break;
        }
    },
    statisticRecount: function() {
        var totalStrings = $('textarea.origin').length;
        var fuzzyCount = $('.fuzzyTD .btn-danger').length;
        var translated = 0;
        var notTranslated = 0;

        $('textarea.translation').each(function() {
            if ($(this).val()) {
                translated++;
            } else {
                notTranslated++;
            }
        });

        $('.statistic').show();
        $('.allStringsCount').html(totalStrings);
        $('.notTranslatedStringsCount').html(notTranslated);
        $('.translatedStringsCount').html(translated);
        $('.fuzzyStringsCount').html(fuzzyCount);

    },
    createFile: function(curElement) {
        this.init();
        if (this.lang && this.type) {
            window.location.href = this.getUrl('createFile');
        }
    },
    render: function(data) {
        try
        {
            var respons = $.parseJSON(data);
            if (typeof respons == 'object') {
                console.log('333')
                var respons = JSON.parse(data);
                if (respons['error']) {
                    $('#po_table tbody').html('');
                    $('#po_table').css('display', 'none');
                    $('.pagination ul').html('');
                    $('.fileNotExist').show();
                    $('.fileNotExist .errors').html(respons['errors']);
                    if (respons['type'] == 'create') {
                        $('.fileNotExist .needToCreate').show();
                    }
                    $('.pathHolder').html('');
                    $('.po_settings').html('');
                    $('.pathParseHolder').hide();
                    return false;
                }
            }
        }
        catch (err)
        {
        }


        $('#cancel').removeAttr('disabled');
        if (!data) {
            $('#po_table tbody').html('');
            $('#po_table').css('display', 'none');
            $('.pagination ul').html('');
            $('.alert-info').css('display', 'block');

            return false;
        } else {
            $('.alert-info').css('display', 'none');
            $('#per_page').css('display', 'block');

            var tableData = data.replace(/<script[\W\w]+<\/script>/, '');
            $('#po_table tbody').html(tableData);
            $('#po_table').css('display', 'table');

            this.statisticRecount();

            var paths = $('.pathHolderClone').html();
            $('.pathHolder').html(paths);
            $('.pathParseHolder').show();

            var po_settings = $('.po_settingsClone').html();
            $('.po_settingsClone').html('');
            $('.po_settings').html(po_settings);

            $('#per_page option:selected').removeAttr('selected');
            $($('#per_page option')[0]).attr('selected', 'selected');

            Pagination.generate();
        }


    },
    setOriginsLang: function(curElement) {
        var originLang = $(curElement).val();
        $.ajax({
            type: "POST",
            data: {
                originsLang: originLang
            },
            url: '/admin/components/init_window/translator/setSettings',
            success: function(data) {
                if (data) {
                    showMessage(lang('Message'), lang('Origin language was successfully setted.'));
                } else {
                    showMessage(lang('Error'), lang('Can not set origin language.', 'r'));
                }
            }
        });
    },
    markFuzzy: function(curElement) {
        if ($(curElement).hasClass('btn-danger')) {
            $(curElement).removeClass('btn-danger');
        } else {
            $(curElement).addClass('btn-danger');
        }
        this.statisticRecount();
    },
    addNewPath: function(curElement) {
        var newPath = $(curElement).prev().html();
        var pathNumber = (parseInt($.trim($($('.pathHolder div b')[$('.pathHolder div b').length - 1]).html())) + 1) + '.';
        if (pathNumber == 'NaN.') {
            pathNumber = 2 + '.';
        }
        $('.pathHolder').append(newPath);
        $($('.pathHolder div b')[$('.pathHolder div b').length - 1]).html(pathNumber);
    },
    deletePath: function(curElement) {
        $(curElement).parent().remove();
    },
    checkPaths: function() {

    },
    parse: function(curElement) {
        this.init();
        var paths = this.getPaths();
        if (!paths.length) {
            showMessage(lang('Error'), lang('Please set paths to parsing files.'), 'r');
        } else {
            $('#loading').show();
            $.ajax({
                url: this.getUrl('updatePoFile'),
                type: 'POST',
                data: {
                    paths: paths
                },
                success: function(data) {
                    if (data) {
                        var results = JSON.parse(data);
                        var newCount = 0;
                        var oldCount = 0;
                        var ignoredCount = 0;
                        $('.modal_update_results').removeClass('hide').removeClass('fade');
                        $('.modal_update_results').modal('show');
                        $('.modal-backdrop').show();
                        $('.newStrings').html('');
                        $('.obsoleteStrings').html('');
                        $('.notCorrectStrings').html('');


                        for (var newString in results['new']) {
                            if (newString && newString.match(/[\D]/)) {
                                var paths = [];
                                var tooltipMsg = '';

                                newCount++;
                                for (var path in results['new'][newString]) {
                                    paths.push(results['new'][newString][path]);
                                }
                                for (var path in paths) {
                                    tooltipMsg += paths[path] + '<br>';
                                }
                                $('.newStrings').append('<span data-rel="tooltip" data-original-title=\'' + tooltipMsg + '\' data-paths=\'' + JSON.stringify(paths) + '\'>' + newString + '</span><br>');
                            } else {
                                if (!newString.match(/[\D]/)) {
                                    var paths = [];
                                    var tooltipMsg = '';

                                    ignoredCount++;
                                    for (var path in results['new'][newString]) {
                                        paths.push(results['new'][newString][path]);
                                    }
                                    for (var path in paths) {
                                        tooltipMsg += paths[path] + '<br>';
                                    }
                                    $('.notCorrectStrings').append('<span data-rel="tooltip" data-original-title=\'' + tooltipMsg + '\' data-paths=\'' + JSON.stringify(paths) + '\'>' + newString + '</span><br>');
                                }
                            }
                        }

                        for (var obsoleteString in results['old']) {
                            if (obsoleteString && obsoleteString != '0') {
                                var paths = [];
                                var tooltipMsg = '';

                                oldCount++;
                                for (var path in results['old'][obsoleteString]['links']) {
                                    paths.push(results['old'][obsoleteString]['links'][path]);
                                }
                                for (var path in paths) {
                                    tooltipMsg += paths[path] + '<br>';
                                }

                                $('.obsoleteStrings').append('<span data-rel="tooltip" data-original-title=\'' + tooltipMsg + '\' data-paths=\'' + JSON.stringify(paths) + '\'>' + obsoleteString + '</span><br>');
                            }
                        }


                        $('.parsedNewStringsCount').html(newCount);
                        $('.parsedRemoveStringsCount').html(oldCount);

                        if (ignoredCount) {
                            $('.notCorrectStringsLI').show();
                            $('.notCorrectStringsCount').html(ignoredCount);
                        }

                        $('.updateResults span').tooltip({
                            'delay': {
                                show: 300,
                                hide: 100
                            }
                        });

                    }
                    $('#loading').hide();

                }
            });
        }

    },
    update: function(curElement) {
        this.init();
        var newStrings = {};
        var obsoleteStrings = {};
        var results = {};

        $('.newStrings span').each(function() {
            newStrings[$(this).text()] = $(this).data('paths');
        });

        $('.obsoleteStrings span').each(function() {
            obsoleteStrings[$(this).text()] = $(this).text();
        });

        results['new'] = newStrings;
        results['old'] = obsoleteStrings;


        $.ajax({
            url: this.getUrl('update'),
            type: 'POST',
            data: {
                results: JSON.stringify(results),
                paths: this.getPaths()
            },
            success: function(data) {
                $('.modal_update_results').addClass('hide').addClass('fade');
                $('.modal_update_results').modal('hide');
                $('.modal-backdrop').remove();

                var tableData = data.replace(/<script[\W\w]+<\/script>/, '');
                $('#po_table tbody').html(tableData);
                $('.pagination ul li.active').removeClass('active');
                $($('.pagination ul li')[1]).addClass('active');
                $('.per_page10').attr('selected', 'selected');
                Pagination.generate();
                Translator.statisticRecount();

                if (data) {
                    showMessage(lang('File was successfuly updated.'), lang('Message'));
                }
            }
        });
    },
    save: function() {
        this.init();

        var po_array = this.getPoArray();
        po_array['paths'] = this.getPaths();
        po_array['po_settings'] = {};
        po_array['po_settings']['projectName'] = $('input[name=projectName]').val();
        po_array['po_settings']['translatorEmail'] = $('input[name=translatorEmail]').val();
        po_array['po_settings']['translatorName'] = $('input[name=translatorName]').val();
        po_array['po_settings']['langaugeTeamName'] = $('input[name=langaugeTeamName]').val();
        po_array['po_settings']['langaugeTeamEmail'] = $('input[name=langaugeTeamEmail]').val();
        po_array['po_settings']['language'] = $('input[name=language]').val();
        po_array['po_settings']['country'] = $('input[name=country]').val();

        $.ajax({
            type: 'POST',
            data: {
                po_array: JSON.stringify(po_array)
            },
            url: this.getUrl('savePoArray'),
            success: function(data) {
                $('body').append(data);
            }
        });
    },
    cancel: function() {
        this.init();
        if (this.lang && this.type && this.module_template) {
            $.ajax({
                url: this.getUrl('canselTranslation'),
                success: function(data) {
                    $('body').append(data);
                }
            });
        }
    },
    start: function(data, names, type, lang, name) {
        $($('.' + lang)[0]).attr('selected', '');
        $('#types').css('display', 'inline-block');
        $($('.' + type)[0]).attr('selected', '');

        if (type !== 'main') {
            $('#modules_templates').css('display', 'inline-block');
            $('#modules_templates').html(names);
        }

        $($('.' + name)[0]).attr('selected', '');
        $('#per_page').css('display', 'inline-block');

        if (data) {
            this.render(data);
        }
    },
    getPaths: function() {
        var pathHorders = $('.pathHolder .path input[name^="path"]');
        var paths = [];

        $(pathHorders).each(function() {
            if ($(this).val()) {
                paths.push($(this).val());
            }
        });
        return paths;
    },
    correctPaths: function(curElement) {
        this.init();
        $('#loading').fadeIn(100);
        $.ajax({
            url: this.getUrl('makeCorrectPoPaths'),
            type: 'POST',
            data: {
                paths: this.getPaths()
            },
            success: function(data) {
                if (data) {
                    var tableData = data.replace(/<script[\W\w]+<\/script>/, '');
                    $('#po_table tbody').html(tableData);
                }
            }
        });
    },
    openFileToEdit: function(curElement) {
        var filePath = $(curElement).val();
        var line = filePath.slice(filePath.indexOf(':') + 1, filePath.length);
        filePath = filePath.slice(0, filePath.indexOf(':'));
        var originString = $(curElement).closest('tr').find('.origin').val();
        this.filePath = filePath;
        var url = '/admin/components/init_window/translator/renderFile';
        $.ajax({
            type: 'POST',
            data: {
                filePath: filePath
            },
            url: url,
            success: function(data) {
                var response = JSON.parse(data);
                if (response['success']) {
                    var fileContent = response['data'];
                    var fileExtention = filePath.match(/\.([a-z]{2,4})/);
                    if (fileExtention) {
                        fileExtention = fileExtention[1];
                    }

                    $('.originStringInFileEdit').html(originString);
                    $('.originStringLineInFileEdit').html(line);
                    showMessage(lang('Message'), lang('File was successfully rendered.'));
                    $('.modal_file_edit').modal();
                    AceEditor.render(fileContent, line, fileExtention);
                } else {
                    if (response['error']) {
                        showMessage(lang('Error'), response['errors'], 'r');
                    }
                }

            }
        });

    },
    saveEditingFile: function(curElement) {
        var fileText = AceEditor.editor.getValue();
        var url = '/admin/components/init_window/translator/saveEditingFile';
        $.ajax({
            type: 'POST',
            data: {
                filePath: Translator.filePath,
                content: fileText
            },
            url: url,
            success: function(data) {
                var response = JSON.parse(data);
                if (response['success']) {
                    showMessage(lang('Message'), lang('File was successfully saved.'));
                    $('.modal').modal('hide');
                } else {
                    if (response['error']) {
                        showMessage(lang('Error'), response['errors'], 'r');
                    }
                }
            }
        });

    },
    translate: function(curElement, withEmptyTranslation) {
        withEmptyTranslation = withEmptyTranslation || false;
        var YandexApiKey = $.trim($('.YandexApiKey').val());
        var originLang = $('#originLang').val();

        if (!YandexApiKey) {
            showMessage(lang('Error'), lang('You have not specified Yandex Api Key.'), 'r');
            return false;
        }

        if (!originLang) {
            showMessage(lang('Error'), lang('You have not specified origins strings language.'), 'r');
            return false;
        }

        var lang = $('#langs').val();
        lang = lang.split("_", 1);

        this.init();
        $('#loading').fadeIn(100);
        var po_array = this.getPoArray();

        var values = [];
        var counter = 0;
        for (var origin in po_array) {
            if (origin) {
                var nextTmp = values[counter] + '&text=' + encodeURIComponent(origin);
                if (nextTmp.length < 9999) {
                    if (!values[counter]) {
                        values[counter] = '';
                    }
                    values[counter] += '&text=' + encodeURIComponent(origin);
                } else {
                    counter += 1;
                    values[counter] += '&text=' + encodeURIComponent(origin);
                }
            }
        }

        var translations = [];
        for (var value in values) {
            var text = values[value].replace("undefined", "");
            ;
            var url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=' + YandexApiKey + text + '&lang=' + originLang + '-' + lang + '&format=plain';
            $.ajax({
                crossDomain: true,
                async: false,
                url: url,
                success: function(Answer) {
                    if (Answer) {
                        translations[value] = Answer;
                    }
                }
            });
        }

        var answers = [];
        var result = [];
        for (var trans in translations) {
            var translationsTexts = translations[trans].text;
            for (var translated in translationsTexts) {
                if (translationsTexts[translated]) {
                    result.push(translationsTexts[translated]);
                }
            }
            answers.push(translations[trans].code);
        }

        $.ajax({
            type: 'POST',
            data: {
                po_array: JSON.stringify(po_array),
                withEmptyTranslation: withEmptyTranslation,
                results: JSON.stringify(result)
            },
            url: this.getUrl('translate'),
            success: function(response) {
                if (response) {
                    var data = JSON.parse(response);
                    var maxCode = Math.max.apply(Math, answers);
                    Translator.getAnswerCodeMessage(maxCode);
                    if (maxCode == '200') {
                        var tableData = data['data'].replace(/<script[\W\w]+<\/script>/, '');
                        $('#po_table tbody').html(tableData);
                        Translator.statisticRecount();
                    }
                }
            }
        });
    },
    translateString: function(curElement) {
        var YandexApiKey = $.trim($('.YandexApiKey').val());
        var originLang = $('#originLang').val();

        if (!YandexApiKey) {
            showMessage(lang('Error'), lang('You have not specified Yandex Api Key.'), 'r');
            return false;
        }

        if (!originLang) {
            showMessage(lang('Error'), lang('You have not specified origins strings language.'), 'r');
            return false;
        }

        var word = $.trim($(curElement).next('.origin').val());
        var originTR = $(curElement).closest('tr');
        var translationTR = originTR.next();
        var translation = translationTR.find('.translation').val();
        var language = $('#langs').val();
        language = language.split("_", 1);

        translationTR.find('.translationTEMP').val(translation);
        translationTR.find('.translationCancel').show();


        var text = '&text=' + encodeURI(word);
        var url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=' + YandexApiKey + text + '&lang=' + originLang + '-' + language + '&format=plain';
        $.ajax({
            type: 'POST',
            url: url,
            success: function(Answer) {
                if (Answer.code == '200') {
                    translationTR.find('.translation').val(Answer.text[0]);
                    Translator.statisticRecount();
                }
                Translator.getAnswerCodeMessage(Answer.code);
            }
        });
    },
    getAnswerCodeMessage: function(code) {
        switch (code.toString()) {
            case '200':
                showMessage(lang('Message'), lang('Successfully translated'));
                break;
            case '401':
                showMessage(lang('Error'), lang('Wrong API key.'), 'r');
                break;
            case '402':
                showMessage(lang('Error'), lang('API key is locked.'), 'r');
                break;
            case '403':
                showMessage(lang('Error'), lang('Exceeded the daily limit on the number of requests.'), 'r');
                break;
            case '404':
                showMessage(lang('Error'), lang('Exceeded the daily limit on the amount of translated text.'), 'r');
                break;
            case '413':
                showMessage(lang('Error'), lang('Exceeded the maximum allowable size of text.'), 'r');
                break;
            case '422':
                showMessage(lang('Error'), lang('Text can not be translated.'), 'r');
                break;
            case '501':
                showMessage(lang('Error'), lang('Set direction of translation is not supported.'), 'r');
                break;
            default:
                showMessage(lang('Error'), lang('Translation fails.'), 'r');

        }
    },
    getPoArray: function() {
        var origins = $('#po_table .originTR');
        var translations = $('#po_table .translationTR');

        var po_array = {};
        for (var i = 0; i < origins.length; i++) {

            var links = [];
            origin = $(origins[i]).find('.origin').text();
            comment = $(origins[i]).find('.comment').val();
            links_select = $(origins[i]).find('select.links option');
            fuzzy = $(origins[i]).find('.notCorrect').hasClass('btn-danger');

            $(links_select).each(function() {
                links.push($(this).val());
            });

            translation = $(translations[i]).find('.translation').val();
            po_array[origin] = {
                'translation': translation,
                'fuzzy': fuzzy,
                'comment': comment,
                'links': links
            };

        }
        return po_array;

    },
    addYandexApiKey: function(curElement) {
        var YandexApiKey = $.trim($('.YandexApiKey').val());
        $.ajax({
            type: "POST",
            data: {
                YandexApiKey: YandexApiKey
            },
            url: '/admin/components/init_window/translator/setSettings',
            success: function(data) {
                if (data) {
                    showMessage(lang('Message'), lang('Yandex Api Key was successfully setted.'));
                } else {
                    showMessage(lang('Error'), lang('Can not set Yandex Api Key.', 'r'));
                }
            }
        });
    },
    showYandexTranslateWindow: function() {
        $('.modal_yandex_translate').removeClass('hide').removeClass('fade');
        $('.modal_yandex_translate').modal('show');
        $('.modal-backdrop').show();
    },
    yandexTranslate: function(curElement) {
        var langFrom = $(curElement).closest('.modal_yandex_translate').find('.languageFrom').attr('locale');
        var langTo = $(curElement).closest('.modal_yandex_translate').find('.languageTo').attr('locale');
        var textToTranslate = $.trim($(curElement).closest('.modal_yandex_translate').find('.translation_text').val());
        var text = '&text=' + encodeURI(textToTranslate);
        var YandexApiKey = $.trim($('.YandexApiKey').val());

        if (!YandexApiKey) {
            showMessage(lang('Error'), lang('You have not specified Yandex Api Key.'), 'r');
            return false;
        }

        if (!langFrom) {
            showMessage(lang('Error'), lang('You have not specified source text language.'), 'r');
            return false;
        }

        if (!langTo) {
            showMessage(lang('Error'), lang('You have not specified translation text language.'), 'r');
            return false;
        }

        if (!text) {
            showMessage(lang('Error'), lang('You have not specified text to translate.'), 'r');
            return false;
        } else {
            var url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=' + YandexApiKey + text + '&lang=' + langFrom + '-' + langTo + '&format=plain';
            $.ajax({
                type: 'POST',
                url: url,
                success: function(Answer) {
                    if (Answer.code == '200') {
                        $(curElement).closest('.modal_yandex_translate').find('.translation_result').val(Answer.text[0]);
                    }
                    Translator.getAnswerCodeMessage(Answer.code);
                }
            });
        }
    }
};
var Pagination = {
    generate: function() {
        if ($('#langs').val()) {
            $('.pagination').show();
        }

        var page_number = $('#page_number').val();
        var per_page = parseInt($('#per_page').val());
        var rows_count = Math.ceil(($('#po_table tbody tr').length / 2) / per_page);
        if (10 < rows_count) {
            var to = 10;
        } else {
            var to = rows_count;
        }

        var pages = "<li><a>< " + lang('First') + "</a></li><li data-number='1'><span>1</span></li>";
        if (page_number == 1) {
            pages = "<li><a>< " + lang('First') + "</a></li><li class='active' data-number='1'><span>1</span></li>";
        }

        var i = 2;
        while (i <= to) {
            if (rows_count == i - 1)
                break;
            var active = '';
            if (page_number == i)
                active = 'active';

            pages += "<li class='" + active + "' data-number='" + i + "'><span>" + i + "</span></li>";
            i++;
        }
        pages += "<li data-number='" + rows_count + "'><a>" + lang('Last ') + " ></a></li>";

        $('.pagination ul').html(pages);
    },
    navigate: function(curElement) {
        var module = $('#modules_templates').val();
        var lang = $('#langs').val();
        var type = $('#types').val();
        var per_page = parseInt($('#per_page').val());
        var offset = (parseInt($(curElement).data('number')) - 1) * per_page;
        var page = parseInt($(curElement).data('number'));

        if (type == 'main')
            module = 'main';

        $('#po_table tbody tr').each(function(iteration) {
            iteration = iteration / 2;
            if ((iteration >= offset) && (iteration < per_page + offset)) {
                $(this).css('display', 'table-row');
            } else {
                $(this).css('display', 'none');
            }
        });
        var rows_count = Math.ceil(($('#po_table tbody tr').length / 2) / per_page);
        var pages = '<li data-number="1"><a>< First</a></li>';
        var from = 1;
        var plus_to = 0;

        if (page > 6) {
            from = page - 5;
        } else {
            plus_to = 10 - 5 - page;
        }

        var to = rows_count;
        var minus_from = 0;
        if (page + 5 < rows_count) {
            to = page + 5;
        } else {
            if (!(page < 5))
                minus_from = 5 - (rows_count - page);
        }

        if (minus_from > from)
            minus_from = 0;

        if (plus_to + page > rows_count)
            plus_to = 0;


        if (rows_count < 10) {
            to = rows_count;
            plus_to = 0;
        }
        var i = from - minus_from;
        while (i <= to + plus_to) {
            if (i == page) {
                pages += "<li class='active' data-number='" + i + "'><span>" + i + "</span></li>";
            } else {
                pages += "<li data-number='" + i + "'><span>" + i + "</span></li>";
            }

            i++;
        }
        pages += "<li data-number='" + rows_count + "'><a>Last ></a></li>";
        $('.pagination ul').html(pages);
    },
    perPage: function() {
        var perPageCurrent = parseInt($('#per_page').val());

        $('#po_table tbody tr').each(function(iteration) {
            iteration = iteration / 2;
            if (iteration < perPageCurrent) {
                $(this).css('display', 'table-row');
            } else {
                $(this).css('display', 'none');
            }
        });

        this.generate()
    },
    movePrev: function() {
        var activeNum = $('ul.pagination li.active').data('number');
        console.log(activeNum)
        if (activeNum > 1) {
            if ($('ul.pagination li')[activeNum - 1]) {
                console.log($($('ul.pagination li')[activeNum - 1]))
                $($('ul.pagination li')[activeNum - 1]).click();
            }
        }

        return false;
    },
    moveNext: function() {
        return false;
    }

}

var CreatePoFile = {
    addPath: function(curElement) {
        var path = $.trim($(curElement).next().val());
        var pathSelector = $(curElement).next().next();
        $(pathSelector).append('<option selected value="' + path + '">' + path + '</option>')
        $(curElement).next().val('');
    }
};

var Exchange = {
    go: function(curElement) {
        var langExchanger = $('.exchanger #langs').val();
        var langReceiver = $('.receiver #langs').val();

        var typeExchanger = $('.exchanger #types').val();
        var typeReceiver = $('.receiver #types').val();

        var modules_templatesExchanger = $('.exchanger #modules_templates').val();
        var modules_templatesReceiver = $('.receiver #modules_templates').val();

        $.ajax({
            type: 'POST',
            data: {
                langExchanger: langExchanger,
                langReceiver: langReceiver,
                typeExchanger: typeExchanger,
                typeReceiver: typeReceiver,
                modules_templatesExchanger: modules_templatesExchanger,
                modules_templatesReceiver: modules_templatesReceiver
            },
            url: '/admin/components/init_window/translator/exchangeTranslation',
            success: function(data) {
                if (data) {
                    var tableData = data.replace(/<script[\W\w]+<\/script>/, '');
                    $('#mainContent').html(tableData);
                    window.history.pushState({}, "", "/admin/components/init_window/translator");
                }
            }
        });
    }
};

var AceEditor = {
    editor: {},
    highlightModes: {js: 'javascript', php: 'php', tpl: 'html'},
    changeTheme: function(curElement) {
        var theme = $(curElement).val();
        if (theme) {
            this.editor.setTheme("ace/theme/" + theme);
            $.ajax({
                type: "POST",
                data: {
                    theme: theme
                },
                url: '/admin/components/init_window/translator/setSettings',
                success: function(data) {
                }
            });
        }

    },
    setTheme: function(theme) {
        var curTheme = theme ? theme : $('.editorTheme').val();
        if (curTheme) {
            this.editor.setTheme("ace/theme/" + curTheme);
        }
    },
    init: function() {
        this.editor = ace.edit("fileEdit");
        this.editor.setTheme("ace/theme/chrome");
        this.editor.getSession().setMode("ace/mode/xml");
    },
    render: function(fileContent, selectedLine, fileExtention) {
        this.init();
        this.editor.setValue(fileContent);
        this.setTheme();
        if (fileExtention) {
            this.setHighlight(fileExtention);
        }
        setTimeout(function() {
            AceEditor.editor.gotoLine(selectedLine, 0);
        }, 500);

    },
    setHighlight: function(extention) {
        var mode = this.highlightModes[extention] ? this.highlightModes[extention] : 'html';
        this.editor.getSession().setMode("ace/mode/" + mode);
    },
    goToLang: function(curElement) {
        var line = $.trim($('.originStringLineInFileEdit').html());
        if (line) {
            this.editor.gotoLine(line, 0);
        }

    }
};

function escapeHtml(text) {
    return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
}

function htmlspecialchars_decode(str) {
    str = str_replace('&lt;', '<', str);
    str = str_replace('&gt;', '>', str);
    str = str_replace('&amp;', '&', str);

    return str;
}


//window.onerror=function(message, url, linenumber){
// console.log(message)
// console.log(url)
// console.log(linenumber)
// return true;
//}