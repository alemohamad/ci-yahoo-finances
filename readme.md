# CodeIgniter Library: Yahoo! Finances

**ci-yahoo-finances**

## About this library

This CodeIgniter's Library is used to get information from Yahoo! Finances, so we can read about currencies and stock market.

Its usage is recommended for CodeIgniter 2 or greater.

## Usage

```php
$this->load->library('YFinances');

$currencies = array("ARS", "USD", "AUD");
$cpc = $this->yfinances->get_cpc($currencies); // Array

$companies = array("GOOG", "AAPL", "YHOO");
$stocks = $this->yfinances->get_stock($companies); // Array
```

The arrays can have the following structure:

```
// CURRENCIES
array(3) {
  [0] => array(3) {
    ["symbol"] => string(3) "AUD"
    ["percent"] => string(5) "-0,10"
    ["price"] => string(4) "1,06"
  }
  [1] => array(3) {
    ["symbol"] => string(3) "USD"
    ["percent"] => string(5) "0,00"
    ["price"] => string(4) "1,00"
  }
  [2] => array(3) {
    ["symbol"] => string(3) "ARS"
    ["percent"] => string(5) "0,02"
    ["price"] => string(4) "5,82"
  }
}

// STOCK MARKET (this may vary)
array(3) {
  [0] => array(14) {
    ["symbol"] => string(11) "Google Inc."
    ["symbol"] => string(4) "GOOG"
    ["symbol"] => string(8) "NasdaqNM"
    ["symbol"] => string(6) "853.67"
    ["symbol"] => string(6) "851.63"
    ["symbol"] => string(6) "865.98"
    ["symbol"] => string(6) "636.00"
    ["symbol"] => string(6) "928.00"
    ["symbol"] => string(6) "-12.07"
    ["symbol"] => string(6) "-1.39%"
    ["symbol"] => string(7) "1945418"
    ["symbol"] => string(7) "1837140"
    ["symbol"] => string(6) "865.74"
    ["symbol"] => string(6) "865.32"
  }
  [1] => array(14) {
    ["symbol"] => string(10) "Apple Inc."
    ["symbol"] => string(4) "AAPL"
    ["symbol"] => string(8) "NasdaqNM"
    ["symbol"] => string(6) "480.94"
    ["symbol"] => string(6) "480.54"
    ["symbol"] => string(6) "490.64"
    ["symbol"] => string(6) "385.10"
    ["symbol"] => string(6) "652.79"
    ["symbol"] => string(5) "-6.81"
    ["symbol"] => string(6) "-1.40%"
    ["symbol"] => string(8) "10389858"
    ["symbol"] => string(8) "12812600"
    ["symbol"] => string(6) "487.75"
    ["symbol"] => string(6) "489.61"
  }
  [2] => array(14) {
    ["symbol"] => string(11) "Yahoo! Inc."
    ["symbol"] => string(4) "YHOO"
    ["symbol"] => string(8) "NasdaqNM"
    ["symbol"] => string(5) "32.93"
    ["symbol"] => string(5) "32.10"
    ["symbol"] => string(5) "34.50"
    ["symbol"] => string(5) "15.65"
    ["symbol"] => string(5) "35.06"
    ["symbol"] => string(5) "-1.21"
    ["symbol"] => string(6) "-3.54%"
    ["symbol"] => string(8) "42914644"
    ["symbol"] => string(8) "18542500"
    ["symbol"] => string(5) "34.14"
    ["symbol"] => string(5) "34.41"
  }
}
```

![Ale Mohamad](http://alemohamad.com/github/logo2012am.png)