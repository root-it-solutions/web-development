<?php

class DeFiChain
{
    const NODECLI = '/ris/defi/defi-node-001/defi-cli -rpcpassword=1qayse4 -datadir=/ris/defi/defi-node-001/';
    const DEFICHAINAPI = 'https://ocean.defichain.com/v0';
    #const DEFICHAINAPI = 'https://mainnet-api.defichain.io/api/DFI';

    public function getLastBlockNumber(): int
    {
        $exec_command = self::NODECLI.' getblockcount';
        return (int)$this->callEXEC($exec_command,true);
    }

    protected function callAPI($url, $returnJson = false)
    {
        $options = stream_context_create(
            array(
                'http'=> array('timeout' => 15),
                'https'=> array('timeout' => 15)
            ));
//         echo $url."\n";

        $json = @file_get_contents($url, false, $options);

        if($json !== false)
        {
            if($returnJson)
            {
                return $json;
            }
            else
            {
                $obj = json_decode($json);
//             var_dump($obj);exit;
                return $obj;
            }
        }
        else
        {
            return false;
            echo "API Defichain Problem\n".$url."\n";
            echo "Return object:\n";
            var_dump($json);
            exit;
        }
    }

    protected function callEXEC($url, $returnJson = true)
    {
//         echo $url."\n";exit;
        $json = shell_exec($url);
//         $json = @file_get_contents($url);

        if($json !== false)
        {
            if($returnJson)
            {
                return $json;
            }
            else
            {
                $obj = json_decode($json);
                //             var_dump($obj);exit;
                return $obj;
            }
        }
        else
        {
            echo "EXEC Defichain Problem\n".$url."\n";
            echo "Return object:\n";
            var_dump($json);
            exit;
        }
    }
}
