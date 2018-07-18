<?php

declare(strict_types=1);

namespace Niden\Api\Controllers\ProductTypes;

use Niden\Http\Request;
use Niden\Http\Response;
use Niden\Models\ProductTypes;
use Niden\Traits\FractalTrait;
use Niden\Traits\QueryTrait;
use Niden\Traits\ResponseTrait;
use Niden\Transformers\TypesTransformer;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Micro;

/**
 * Class GetController
 *
 * @package Niden\Api\Controllers\ProductTypes
 *
 * @property Micro    $application
 * @property Request  $request
 * @property Response $response
 */
class GetController extends Controller
{
    use FractalTrait;
    use QueryTrait;
    use ResponseTrait;

    /**
     * Get a user
     */
    public function callAction()
    {
        $results = $this->getRecords(ProductTypes::class, [], 'prt_name');

        return $this->format($results, TypesTransformer::class);
    }
}
