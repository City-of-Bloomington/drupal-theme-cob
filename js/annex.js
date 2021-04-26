jQuery(document).ready(function ($) {
    var ANNEX = {
        select: document.getElementById('fieldname'),
        query:  document.getElementById('query'),
        form:   document.getElementById('annexationSearchForm'),
        table:  document.getElementById('annexationResults'),
        resource_url: 'https://data.bloomington.in.gov/api/3/action/datastore_search?resource_id=37d3f8b5-0844-412a-ac2f-953dd2ed5aec&distinct=true',
        fields: [
            'Annex Area', 'Waiver', 'Parcel', 'Owner', 'Owner Address', 'Property Address'
        ],
        autocompleteQuery: function (request, response, fieldname) {
            const url = ANNEX.resource_url
                    + '&q={"'    + fieldname + '":"' + request.term + '"}'
                    + '&fields=' + fieldname
                    + '&sort='   + fieldname;
            $.ajax(url).done(function (result) { ANNEX.autoCompleteResult(result, response, fieldname); })
                    .fail(function (result) { response([]); });
        },
        autoCompleteResult: function (result, response, fieldname) {
            let items = [];

            if (result.success) {
                result.result.records.forEach(function (row) { items.push(row[fieldname]); });
            }
            response(items);
        },
        searchQuery: function (e) {
            const fieldname = ANNEX.select.options[ANNEX.select.selectedIndex].value,
                    url       = ANNEX.resource_url + '&q={"' + fieldname + '":"' + ANNEX.query.value + '"}&sort=' + fieldname;

            e.preventDefault();

            $.ajax(url).done(ANNEX.searchResult).fail(function (result) {});
        },
        searchResult: function (result) {
            let table = '<p>No results found</p>';

            if (result.success) {
                if (result.result.records.length > 0) {
                    table = '<thead><tr>';
                    ANNEX.fields.forEach(function (f) { table += '<th>' + f + '</th>'; });
                    table += '</tr></thead><tbody>';
                    result.result.records.forEach(function (row) {
                        var tr = '<tr>';
                        ANNEX.fields.forEach(function (f) {
                            tr += '<td>' + row[f] + '</td>';
                        });
                        tr += '</tr>';
                        table  += tr;
                    });
                    table += '</tbody>';
                }
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
