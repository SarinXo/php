'use strict'

export function getView(json)
{
	var wrapper = $('<div class="books-wrapper"></div>');

	json.forEach(book =>
	{
		wrapper.append
		(`
			<div class="book">
				<p class="book-title">${book.title}</p>
				<p class="book-author">${book.author}</p>
				<p class="book-isbn">${book.isbn}</p>
				<p class="book-price">${book.price}</p>
			</div>
		`);
	});
	/*	<p>
            <strong> Название: ${book.title}</strong>
            <br/>Автор: ${book.author}
            <br/>ISBN: ${book.isbn}
            <br/>Цена: ${book.price}
        </p>*/
	return wrapper;
}