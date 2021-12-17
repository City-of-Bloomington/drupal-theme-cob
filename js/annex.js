jQuery(document).ready(function ($) {
    var ANNEX = {
        select: document.getElementById('fieldname'),
        query:  document.getElementById('annexation_query'),
        form:   document.getElementById('annexationSearchForm'),
        table:  document.getElementById('annexationResults'),
        resource_url: 'https://bloomington.data.socrata.com/resource/x8s7-g7v5.json',
        fields: [
            'annex_area', 'waiver', 'parcel', 'owner', 'owner_address', 'property_address',
            'gross_tax_change', 'net_tax_change'
        ],
        autocompleteQuery: function (request, response, fieldname) {
            const url = ANNEX.resource_url
                      + encodeURI("?$where=" + fieldname + " like '%" + ANNEX.query.value + "%'");
            $.ajax(url).done(function (result) { ANNEX.autoCompleteResult(result, response, fieldname); })
                       .fail(function (result) { response([]); });
        },
        autoCompleteResult: function (result, response, fieldname) {
            let items = [];

            if (result.length > 0) {
                result.forEach(function (row) { items.push(row[fieldname]); });
            }
            response(items);
        },
        searchQuery: function (e) {
            const fieldname = ANNEX.select.options[ANNEX.select.selectedIndex].value,
                  url       = ANNEX.resource_url
                            + encodeURI("?$where=" + fieldname + " like '%" + ANNEX.query.value + "%'");

            e.preventDefault();

            $.ajax(url).done(ANNEX.searchResult).fail(function (result) {});
        },
        searchResult: function (result) {
            let table = '<p>No results found</p>';

            if (result.length > 0) {
                table = '<thead><tr>';
                ANNEX.fields.forEach(function (f) {
                    f = f.replaceAll('_', ' ');
                    table += '<th>' + f + '</th>';

                });
                table += '</tr></thead><tbody>';
                result.forEach(function (row) {
                    let tr = '<tr>';
                    ANNEX.fields.forEach(function (f) {
                        let v = row[f] ? row[f] : '';
                        tr += '<td>' + v + '</td>';
                    });
                    tr += '</tr>';
                    table  += tr;
                });
                table += '</tbody>';
            }
            ANNEX.table.innerHTML = table;
        }
    };

    ANNEX.select.addEventListener('change', function (e) { ANNEX.query.value = ''; }, false);
    ANNEX.form.  addEventListener('submit', ANNEX.searchQuery, false);

    $("#query").autocomplete({
        source: function (request, response) {
            const fieldname = ANNEX.select.options[ANNEX.select.selectedIndex].value;

            ANNEX.autocompleteQuery(request, response, fieldname);
        }
    });
});
