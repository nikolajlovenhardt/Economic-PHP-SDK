<?php

namespace tkj\Economics\Debtor;

use stdClass;
use tkj\Economics\ClientInterface as Client;

class Entry
{
    /**
     * Client Connection
     *
     * @var Client
     */
    protected $client;

    /**
     * Instance of Client
     *
     * @var Client
     */
    protected $client_raw;

    /**
     * Construct class and set dependencies
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client     = $client->getClient();
        $this->client_raw = $client;
    }

    /**
     * Find by invoice number
     *
     * @param string $from
     * @param null|string $to
     * @return mixed
     */
    public function findByInvoiceNumber($from, $to = null)
    {
        if (!$to) {
            $to = $from;
        }

        $result = $this->client
            ->DebtorEntry_FindByInvoiceNumber([
                'from' => $from,
                'to' => $to
            ])
            ->DebtorEntry_FindByInvoiceNumberResult
            ->DebtorEntryHandle;

        if (!is_array($result)) {
            $result = [$result];
        }

        return $result;
    }

    /**
     * Get data from debtor entry handle
     *
     * @param stdClass $handle
     * @return mixed
     */
    public function getData($handle)
    {
        return $this->client
            ->DebtorEntry_GetData([
                'entityHandle' => $handle,
            ])
            ->DebtorEntry_GetDataResult;
    }
}
