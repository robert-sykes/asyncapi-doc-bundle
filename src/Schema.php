<?php

declare(strict_types=1);

namespace Ferror\AsyncapiDocBundle;

class Schema
{
    public function render(array $document): array
    {
        $properties = [];
        $required = [];

        foreach ($document['properties'] as $property) {
            $properties[$property['name']]['type'] = PropertyTypeTranslator::translate($property['type']);

            if (isset($property['description'])) {
                $properties[$property['name']]['description'] = $property['description'];
            }

            if (isset($property['format'])) {
                $properties[$property['name']]['format'] = $property['format'];
            }

            if (isset($property['example'])) {
                $properties[$property['name']]['example'] = $property['example'];
            }

            if (isset($property['required'])) {
                $required[] = $property['name'];
            }
        }

        $message[$document['name']] = [
            'payload' => [
                'type' => 'object',
                'properties' => $properties,
                'required' => $required,
            ],
        ];

        return $message;
    }

    public function renderChannels(array $document): array
    {
        $channel[$document['channel']] = [
            $document['channelType'] => [
                'message' => [
                    '$ref' => '#/components/messages/' . $document['name'],
                ],
            ],
        ];

        return $channel;
    }
}
