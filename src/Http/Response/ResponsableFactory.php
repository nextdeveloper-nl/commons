<?php

namespace NextDeveloper\Commons\Http\Response;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\Pagination\Cursor;

class ResponsableFactory {
    public static function makeResponse(
        $controller,
        $data,
        $transformer = null,
        $resourceKey = null,
        Cursor $cursor = null,
        array $meta = [],
        array $headers = []
    ) {
        if(is_array($data)) {
            return $controller->withArray([
                'data'  =>  $data
            ]);
        }

        $returnType = class_basename($data);
        $returnObject = null;

        if($data instanceof Model) {
            //  Here if are getting an model directly, this means that we need to return an item.
            //  That is why we are checking if the data received is an instance of a model or not.
            $returnType = 'Item';
            $returnObject = get_class($data);
        } else {
            if($data) {
                if(count($data) > 0)
                    $returnObject = get_class($data[0]);
                else
                    $returnObject = null;
            } else {
                $returnObject = null;
            }
        }

        if(!$returnObject) {
            return $controller->errorNotFound('Cannot find the object you are looking for. We may not have that' .
                ' object or you may need to change your search filters.');
        }

        
        $exploded = explode('\\', $returnObject);

        $transformer = $exploded[0] . '\\' . $exploded[1] . '\\Http\\Transformers\\' . $exploded[4] . 'Transformer';

        switch ($returnType) {
            case 'Collection':
                return $controller->withCollection($data, app( $transformer ));
            case 'LengthAwarePaginator':
                return $controller->withPaginator($data, app( $transformer ));
            case 'Item':
                return $controller->withItem($data, app( $transformer ));
        }
    }
}
