<?php

namespace DynalistPhpClient\Tests;

use DynalistPhpClient\DynalistClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class DynalistClientTest
 * @package DynalistPhpClient\Tests
 */
class DynalistClientTest extends TestCase
{
    public function testSendToInbox()
    {
        $mockedResponse = json_decode(
            '{"_code":"Ok","file_id":"2134234ewrsdfsdf","node_id":"234werew23-3DdId","index":0}',
            true
        );

        $stub = $this->getClientMock();

        $stub->method('sendToInbox')->willReturn($mockedResponse);

        $this->assertEquals(
            $mockedResponse,
            $stub->sendToInbox(
                0,
                'some content',
                'some note'
            )
        );
    }

    public function testGetDocumentContent()
    {
        $mockedResponse = json_encode(
            '{
  "_code": "Ok",
  "file_id": "NCYyJertertertudf6m6",
  "title": "some content",
  "nodes": [
    {
      "id": "root",
      "content": "some content",
      "note": "",
      "children": [
        "bb6xL-ertdfgerteoFEln8"
      ],
      "created": 1608771296222,
      "modified": 1608771323439
    },
    {
      "id": "Of9mbv-dfgertrt_ad",
      "content": "some content",
      "note": "",
      "checkbox": true,
      "created": 1611403728111,
      "modified": 1616201114892
    }
  ],
  "version": 435
}',
            true
        );

        $stub = $this->getClientMock();

        $stub->method('getDocumentContent')->willReturn($mockedResponse);

        $this->assertEquals(
            $mockedResponse,
            $stub->getDocumentContent(
                'some-file-id'
            )
        );
    }

    private function getClientMock(): DynalistClient|MockObject
    {
        return $this->createMock(DynalistClient::class);
    }
}
