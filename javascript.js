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

/*sample class*/
function RouteApi(){
	this.key = 'secretkey';
	this.setHeader = function(){
		return {
			'Content-Type': 'application/json',
			'key': this.key
		};
	}


	this.post = function(url,data){
		return fetch(url, {
			method: 'post',
			headers: this.setHeader(),
			body: JSON.stringify(data)
		})
		.then((response) => {
			return response.json()
		})
		.then((jsonData) => {
			return jsonData;
		});
	};

	this.get = function (url){
		return fetch(url, {
			method: 'get',
			headers: this.setHeader()
		})
		.then((response) => {
			return response.json()
		})
		.then((jsonData) => {
			return jsonData;
		});
	}

	
}
