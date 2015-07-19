$.ajax({
	method: "POST",
	url: [base_url, 'admin', 'lang'].join('/'),
	data: { }
})
	.done(function( result ) {
		lang = result;
	});
