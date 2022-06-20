# Controller api com resource
```sh
php artisan make:controller NameController --api
```


# Eloquente api resource
- é uma Transformação entre seus modelos Eloquent e as respostas JSON que são retornadas aos usuários app
- Criar um
```sh
art make:resource NameResource
```

- Dentro de um resouce
```php
public function toArray($request)
{
    // return [
    //     'name' => ucwords($this->name),
    //     'price' => $this->price
    // ];
    // devolve todos items em um array pq é um model eloquent que tem method toArray
    return $this->resource->toArray();
}
```
- Usando no controller
```php
public function show($id)
{
    $product = $this->product->findOrFail($id);
    // em vez de usar return response()->json($product);
    return new ProductResource($product);
}
```

## Resource collection
```sh
php artisan make:resource ProductCollection
php artisan make:resource Product --collection
```

- Retorno
```php
public function toArray($request)
{
    return [
        'data' => $this->collection
    ];
}
```

## Passar informações adicionais tanto em um resource como em uma collection
```php
public function toArray($request)
{
    return [
        'data' => $this->collection,
        'dados_add' => 'dados adicionais dentro metodo toArray'
    ];
}

// colocado aqui é adicionado dentro do retorno json
public function with($request)
{
    return ['extra_information' => 'Informação extra dentro metodo with'];
}
```

# Tirar wrapper "data"
```php
// quando colocado algum dado extra (usando metodo with), ele adiciona um wrapper mesmo assim
JsonResource::withoutWrapping();
```

# Pernalizar nome do wrapper 
```php
JsonResource::wrap('wrap');
```
