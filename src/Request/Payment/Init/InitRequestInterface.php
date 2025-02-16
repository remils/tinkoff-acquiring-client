<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\Init;

use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;

/**
 * InitRequestInterface
 *
 * @template TData of array<string,mixed>
 * @template TSignatureData of array<string,string>
 *
 * @extends RequestInterface<TData,TSignatureData>
 */
interface InitRequestInterface extends RequestInterface
{
}
