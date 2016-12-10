var app = angular.module("proshop");
app.factory('getSingleProducts', function ($http) {

	//var getProduct = function (pid) {
	//	alert(1);
	//	$http.defaults.headers.post["Content-Type"] = "application/JSON";
	//	// Angular $http() and then() both return promises themselves 
	//  return $http({
	//		url: 'http://capstone.devview.info/product/getProductDetails',
	//		method: "POST",
	//		data: { 'id': pid }
	//	}) .then(function (result) {
    //        	// What we return here is the data that will be accessible 
    //        	// to us after the promise resolves
    //        	return result.data.products;
    //        });
	//};
	
	var getProduct = function (pid) {
		console.log("here");
		$http.defaults.headers.post["Content-Type"] = "application/JSON";
		// Angular $http() and then() both return promises themselves 
		return $http({ method: "POST", url: "http://capstone.devview.info/product/getProductDetails", data: { 'id': pid } }).then(function (result) {

			// What we return here is the data that will be accessible 
			// to us after the promise resolves
			return result.data.products;
		});
	};
	return { getProduct: getProduct };
});