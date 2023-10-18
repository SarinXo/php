'use strict'

import { getJson as booksSortByPriceJson } from './books/sortByPrice.js';
import { getJson as booksSortBySellsJson } from './books/sortBySells.js';
import { getView as booksCreateView } from './books/view.js';

$(document).ready(function()
{
	$('#sort-books').on('submit', function(event)
	{
		event.preventDefault();

		var formData = $('#sort-books').serializeArray();

		switch(formData[0]['value'])
		{
			case "price": booksSortByPriceJson(function(json)
			{
				$('#books').html(booksCreateView(json));
			});
			break;
			case "sells": booksSortBySellsJson(function(json)
			{
				$('#books').html(booksCreateView(json));

			});
			break;
		}
	});
});