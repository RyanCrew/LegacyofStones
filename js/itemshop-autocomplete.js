$(function() {
    // Array of items - this would be replaced with an asynchronous fetch in a real application
    var items = [
        { vnum: 1, name: 'Sword of Destiny' },
        { vnum: 2, name: 'Shield of Valor' },
        { vnum: 3, name: 'Potion of Healing' },
        // More items...
    ];

    // Transform the items for use in the autocomplete
    var availableItems = items.map(function(item) {
        return item.name + ' (VNUM: ' + item.vnum + ')';
    });

    // Initialize jQuery UI autocomplete
    $('#item-search').autocomplete({
        source: availableItems,
        minLength: 1,
    });
});

// HTML for the search input
// <input type='text' id='item-search' placeholder='Search for items...'>