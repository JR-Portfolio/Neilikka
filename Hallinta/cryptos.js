//nomics api key: d6559ccd322d5b5c07e07ab67f8e27f40e347c62
var key = "d6559ccd322d5b5c07e07ab67f8e27f40e347c62";
var nomicUrl = "https://api.nomics.com/v1/currencies/ticker?key=" + key + "&ids=BTC,ETH,XRP&interval=1d,30d&convert=EUR&per-page=100&page=1";
var currencies = nomicUrl.trim();
 
//document.addEventListener('DOMContentLoaded', function() {
fetch(currencies)
    .then(response => response.json())
    .then(data => {
        console.log(data);
 
        //ul elementti html:ssä.
        var order = document.querySelector("#all");
 
        for (const key in data) {
            console.log(`${key}:
            ${data[key].name} ${data[key].price} in usd`);
            //Luo lista elementti eli li
            var lista = document.createElement('li');
            //Populoi se.
            var usd = 1.17;
            lista.innerHTML = `${data[key].name} ${data[key].price * usd}` + '<br>';
            //Lisää lista ul elementtiin.
            order.appendChild(lista);
        }
    });
 
//https: //yfapi.net
//get: /v6/finance / quote
//stock/v2/get-financials
//fetch("https://apidojo-yahoo-finance-v1.p.rapidapi.com/auto-complete?q=nokia&region=FI", {
fetch("https://apidojo-yahoo-finance-v1.p.rapidapi.com/stock/v2/get-financials?symbol=nok&region=FI", {
        "method": "GET",
        "headers": {
            "x-rapidapi-host": "apidojo-yahoo-finance-v1.p.rapidapi.com",
            "x-rapidapi-key": "4177a9055emsheec3ed52c7200fap1dad8cjsnf4da14b400f3"
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.price);
        console.log(data.price.regularMarketPrice.fmt);
        let eurKurssi = (data.price.regularMarketPrice.fmt * 0.86);
        console.log(eurKurssi);
        console.log("Nokia euroina " +
            eurKurssi);
        document.querySelector('#nok').innerHTML = "Nokia euroina: " + eurKurssi;
    });
 
