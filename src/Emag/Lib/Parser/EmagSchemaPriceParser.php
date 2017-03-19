<?php

namespace Emag\Lib\Parser;

/**
 * Class EmagSchemaPriceParser
 * @package Emag\Lib\Parser
 */
class EmagSchemaPriceParser
{
    /**
     * @var string
     */
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * parses XML taken from $this->filePath and extracts products price data
     * @return array
     * @throws \Exception
     */
    public function parse()
    {
        $data = file_get_contents($this->filePath);
        $emag = simplexml_load_string($data);
        if ($emag === false) {
            $errors = '';
            foreach (libxml_get_errors() as $error) {
                $errors .= $error->message . "\n";
            }
            throw new \Exception("Failed loading XML: %s", $errors);
        }

        $ret = [];
        foreach ($emag->offerList->offer as $offer) {
            $partNo = (string)$offer['partNo'];
			$price = (float)$offer->price;

            $ret[$partNo] = $price;
        }

        return $ret;
    }
}
