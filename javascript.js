//Call api
jQuery.ajax({
		type: "GET",
		url: "https://url.com",
		dataType: 'json',
		data: data,
    beforeSend: function() {
    },
    success: function(data) {
    },
    error: function(xhr) { // if error occured
        alert("Error occured.please try again");
    },
    complete: function() {
    }
	});

fetch("https://url.com", {
  method: 'post',
  headers: {
    'Content-Type' : 'application/json'
  },
  body: JSON.stringify({
    id: id
  })
})
.then((response) => {
  return response.json()
})
.then((jsonData) => {
  
})
.catch((error) => {
  
});
