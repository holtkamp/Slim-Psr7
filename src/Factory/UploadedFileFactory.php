<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim-Psr7/blob/master/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Psr7\Factory;

use InvalidArgumentException;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UploadedFileInterface;
use Slim\Psr7\UploadedFile;

class UploadedFileFactory implements UploadedFileFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createUploadedFile(
        StreamInterface $stream,
        int $size = null,
        int $error = \UPLOAD_ERR_OK,
        string $clientFilename = null,
        string $clientMediaType = null
    ): UploadedFileInterface {
        $file = $stream->getMetadata('uri');

        if (!is_readable($file)) {
            throw new InvalidArgumentException('File is not readable');
        }
        if (!isset($size)) {
            $size = $stream->getSize();
        }

        return new UploadedFile($file, $clientFilename, $clientMediaType, $size, $error);
    }
}
