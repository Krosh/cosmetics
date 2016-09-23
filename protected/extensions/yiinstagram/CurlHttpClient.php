<?php
class CurlHttpClient
{

    /**
     * Used HTTP request methods
     */
    const GET = 'GET';
    const POST = 'POST';
    const DELETE = 'DELETE';

    /**
     * cURL handler
     * @var resource
     */
    private $handler;

    /**
     * Store the POST fields
     */
    private $postParams = array();


    /**
     *
     */
    private $url;

    /**
     * Initiate a cURL session
     * @param string $url
     */
    public function __construct($uri)
    {
        $this->handler = curl_init();
        $this->_setOptions($uri);
    }

    protected function _setOptions($uri)
    {

        //curl_setopt($this->handler, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($this->handler, CURLOPT_USERAGENT, "yiinstragram HTTP Client");
        curl_setopt($this->handler, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->handler, CURLOPT_TIMEOUT, 10);
        curl_setopt($this->handler, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->handler, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->handler, CURLOPT_FOLLOWLOCATION, FALSE);
        curl_setopt($this->handler, CURLOPT_URL, $uri);

        // process the headers
        curl_setopt($this->handler, CURLOPT_HEADERFUNCTION, array($this, 'curlHeader'));
        curl_setopt($this->handler, CURLOPT_HEADER, FALSE);
        curl_setopt($this->handler, CURLINFO_HEADER_OUT, TRUE);

    }

    /**
     * Set the URI
     * @param $uri
     */
    public function setUri($uri)
    {
        $this->handler = curl_init();
        $this->_setOptions($uri);
    }

    /**
     * Receive the response with full headers
     * @param boolean $value
     */
    public function setHeaders($value = true)
    {
        curl_setopt($this->handler, CURLOPT_HEADER, $value);
    }

    /**
     * Set the HTTP request method
     * @param string $method
     */
    public function setMethod($method = self::GET)
    {
        switch ($method) {
            case self::GET :
                curl_setopt($this->handler, CURLOPT_HTTPGET, true);
                break;
            case self::POST :
                curl_setopt($this->handler, CURLOPT_POST, true);
                break;
            case self::DELETE :
                curl_setopt($this->handler, CURLOPT_CUSTOMREQUEST, self::DELETE);
                break;
            default:
                throw new CurlHttpClientException('Method not supported');
        }
    }

    /*
     * Add a new post param to the set
     * @param string $name
     * @param mixed $value
     */
    public function setPostParam($name, $value)
    {
        $this->postParams[$name] = $value;
        curl_setopt($this->handler, CURLOPT_POSTFIELDS, $this->postParams);
    }

    /**
     * Get the response
     * @return string
     */
    public function getResponse()
    {
        $response = curl_exec($this->handler);
        curl_close($this->handler);
        return $response;
    }


    /**
     * Utility function to parse the returned curl headers and store them in the
     * class array variable.
     *
     * @param object $ch curl handle
     * @param string $header the response headers
     * @return the string length of the header
     */
    private function curlHeader($ch, $header)
    {
        $i = strpos($header, ':');
        if (!empty($i)) {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->response['headers'][$key] = $value;
        }
        return strlen($header);
    }


    /**
     * Extract the headers from a response string
     *
     * @param string $response
     * @return mixed[]
     */
    protected function extractHeaders($response)
    {
        $headers = array();

        // First, split body and headers
        $parts = preg_split('|(?:\r?\n){2}|m', $response_str, 2);
        if (!$parts[0]) return $headers;

        // Split headers part to lines
        $lines = explode("\n", $parts[0]);
        unset($parts);
        $last_header = null;

        foreach ($lines as $line) {
            $line = trim($line, "\r\n");
            if ($line == "") break;

            // Locate headers like 'Location: ...' and 'Location:...' (note the missing space)
            if (preg_match("|^([\w-]+):\s*(.+)|", $line, $m)) {
                unset($last_header);
                $h_name = strtolower($m[1]);
                $h_value = $m[2];

                if (isset($headers[$h_name])) {
                    if (!is_array($headers[$h_name])) {
                        $headers[$h_name] = array($headers[$h_name]);
                    }

                    $headers[$h_name][] = $h_value;
                } else {
                    $headers[$h_name] = $h_value;
                }
                $last_header = $h_name;
            } else if (preg_match("|^\s+(.+)$|", $line, $m) && $last_header !== null) {
                if (is_array($headers[$last_header])) {
                    end($headers[$last_header]);
                    $last_header_key = key($headers[$last_header]);
                    $headers[$last_header][$last_header_key] .= $m[1];
                } else {
                    $headers[$last_header] .= $m[1];
                }
            }
        }

        return $headers;
    }
}

class CurlHttpClientException extends CException
{
}
