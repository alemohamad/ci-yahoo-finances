<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Yahoo! Finances Library
 *
 * Library that get information about finances from Yahoo!
 *
 * @package		CodeIgniter
 * @category	Library
 * @author		Ale Mohamad
 * @link		alemohamad.com
 * @version 	1.0
 */

class YFinances {

    private $_cpc = array();
    private $_stock_info = array();

    /**
     * Get CPC (Cardholder Preferred Currency)
     *
     * This method read the Yahoo service, and only returns information about the selected currencies
     *
     * @access	public
     * @param	array	currencies
     * @return	array	currencies information
     */
    public function get_cpc($currencies)
    {
        if(!is_array($currencies)) {
            return false;
        }

        $cpc_data = file_get_contents("http://finance.yahoo.com/webservice/v1/symbols/allcurrencies/quote?view=basic&format=json");

        if ($cpc_data !== false) {
            $cpc_data = json_decode($cpc_data);

            foreach($cpc_data->list->resources as $resource) {
                $item = array();
                $item['symbol'] = substr($resource->resource->fields->symbol, 0, 3);
                $item['percent'] = number_format($resource->resource->fields->chg_percent, 2, ',', '');
                $item['price'] = number_format($resource->resource->fields->price, 2, ',', '');

                // is this currency selected?
                if( in_array($item['symbol'], $currencies) ) {
                    $this->_cpc[] = $item;
                }
            }
        } else {
            // there was an error
            return false;
        }

        return $this->_cpc;
    }

    /**
     * Get Stock
     *
     * This method returns stock market information about selected companies
     *
     * @access	public
     * @param	array	companies market code
     * @return	array	companies market information
     */
    public function get_stock($companies)
    {
        if(!is_array($companies)) {
            return false;
        }

        foreach($companies as $company) {
            $this->_stock_info[] = $this->read_stock($company);
        }

        return $this->_stock_info;
    }

    /**
     * Read and return information about a specific company
     *
     * @access	private
     * @param	string	company market symbol
     * @return	array	company market information
     */
    private function read_stock($company_symbol)
    {
        $legend = array(
            'n0' => 'Name',
            's0' => 'Symbol',
            'x0' => 'Exchange',
            'l1' => 'Price',
            'g0' => 'Intraday Low',
            'h0' => 'Intraday High',
            'j0' => '52-Week Low',
            'k0' => '52-Week High',
            'c1' => 'Day Change ($)',
            'p2' => 'Day Change (%)',
            'v0' => 'Volume',
            'a2' => 'Average Daily Volume',
            'p0' => 'Previous Close',
            'o0' => 'Today\'s Open'
        );

        $params = '';
        foreach (array_keys($legend) as $keys) {
            $params .= $keys;
        }

        $service = file_get_contents('http://download.finance.yahoo.com/d/quotes.csv?s=' . $company_symbol . '&f=' . $params . '&e=.csv'); 

        if ($service !== false) {
            $service = str_replace('"', '', $service);
            $service = explode(',', $service);

            $num = count($service);

            $label = array();
            foreach ($legend as $key => $value) {
                $label[] = $value;
            }

            if($num) {
                // found company symbol's info
                return $service;
            } else {
                // the company symbol does not exist
                return false;
            }
        } else {
            // there was an error
            return false;
        }
    }

}

/* End of file YFinances.php */