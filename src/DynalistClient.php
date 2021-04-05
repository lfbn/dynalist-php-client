<?php

namespace DynalistPhpClient;

use Exception;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class DynalistClient
 * @package DynalistPhpClient
 */
class DynalistClient
{
    /* @var string */
    private const DYNALIST_ENDPOINT = 'https://dynalist.io/api/v1';

    /* @var string */
    private $apiKey;

    /**
     * DynalistClient constructor.
     * @param  string  $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param  int  $index
     * @param  string  $content
     * @param  string  $note
     * @param  bool  $checked
     * @param  bool  $checkbox
     * @param  int  $heading
     * @param  int  $color
     */
    public function sendToInbox(
        int $index,
        string $content,
        string $note = '',
        bool $checked = false,
        bool $checkbox = false,
        int $heading = 0,
        int $color = 0
    ) {
        return $this->post(
            self::DYNALIST_ENDPOINT.'/inbox/add',
            [
                'index' => $index,
                'content' => $content,
                'note' => $note,
                'checked' => $checked,
                'checkbox' => $checkbox,
                'heading' => $heading,
                'color' => $color
            ]
        );
    }

    /**
     * @param $endpoint
     * @param $params
     * @return mixed
     */
    private function post(string $endpoint, array $params)
    {
        $body = array_merge(
            ['token' => $this->apiKey],
            $params
        );

        try {
            $client = HttpClient::create();
        } catch (Exception $exception) {
            throw new Exception('DynalistClient failed response: '.$exception->getMessage());
        }

        $response = $client->request(
            'POST',
            $endpoint,
            [
                'body' => json_encode($body)
            ]
        );

        return json_decode($response->getContent(), true);
    }

    /**
     * @param  string  $fileId
     */
    public function getDocumentContent(string $fileId)
    {
        return $this->post(
            self::DYNALIST_ENDPOINT.'/doc/read',
            ['file_id' => $fileId]
        );
    }
}
