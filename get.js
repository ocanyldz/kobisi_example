function getTopTenCustomers(param){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/kobisi_example/api/topTenCustomers.php?param='+param);
    xhr.responseType = 'json';
    xhr.send();

    xhr.onload = function() {
        let json = xhr.response.body;
        var element = document.getElementById("results");
        element.innerHTML = "";

        element.innerHTML += '<caption>Top 10 customers who spend most money on the last '+param+'</caption>'+
        '<tr><th>Firstname</th><th>Lastname</th><th>Total</th></tr>';

        for (var key of Object.keys(json)) {
            element.innerHTML +=
            '<tr><td>'+ json[key]['name']+ '</td><td>'+ json[key]['surname']+ '</td><td>'+ json[key]['total']+ '</td></tr>';
        }
    }
}

function getBestSellingProducts(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/kobisi_example/api/bestSellingProducts.php');
    xhr.responseType = 'json';
    xhr.send();

    xhr.onload = function() {
        let json = xhr.response.body;
        var element = document.getElementById("results");
        element.innerHTML = "";

        element.innerHTML += '<caption>Top 10 best selling products</caption>'+
        '<tr><th>Product Name</th><th>Sale Count</th></tr>';

        for (var key of Object.keys(json)) {
            element.innerHTML +=
            '<tr><td>'+ json[key]['name']+ '</td><td>'+ json[key]['sale_count']+ '</td></tr>';
        }
    }
}

function getProductCount(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/kobisi_example/api/productCount.php');
    xhr.responseType = 'json';
    xhr.send();

    xhr.onload = function() {
        let json = xhr.response.body;
        var element = document.getElementById("results");
        element.innerHTML = "";

        element.innerHTML += '<caption>Total Products</caption>'+
        '<tr><th>Product Count</th></tr>';

        for (var key of Object.keys(json)) {
            element.innerHTML +=
            '<tr><td>'+ json[key]['product_count']+ '</td></tr>';
        }
    }
}

function getTodaysSaleCount(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/kobisi_example/api/todaysSaleCount.php');
    xhr.responseType = 'json';
    xhr.send();

    xhr.onload = function() {
        let json = xhr.response.body;
        var element = document.getElementById("results");
        element.innerHTML = "";

        element.innerHTML += "<caption>Today's sale count</caption>"+
        '<tr><th>Sale Count</th></tr>';

        for (var key of Object.keys(json)) {
            element.innerHTML +=
            '<tr><td>'+ json[key]['sale_count']+ '</td></tr>';
        }
    }
}