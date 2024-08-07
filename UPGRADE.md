# Guia de Atualização para v1.2

## Requisitos

- PHP versão mínima atualizada para 8.0.
- Laravel versão mínima atualizada para 8.0.

## Mudanças Principais nas classes da biblioteca

- Constantes para controle das chaves de retorno na função `Kascat\EasyModule\Core\Service::buildReturn`
  ```
  Kascat\EasyModule\Core\Service::RESPONSE; // 'response'
  Kascat\EasyModule\Core\Service::HTTP_STATUS; // 'status'
  ```
- Constantes para chaves de paginação e carregamento de relacionamento
  ```
  Kascat\EasyModule\Core\Service::WITH_RELATIONSHIP; // 'with'
  Kascat\EasyModule\Core\Service::PER_PAGE; // 'perPage'
  ```


## Mudanças Principais nos arquivos gerados no módulo

- Adição de return types em funções e tipagem de parâmetros
- Remoção de DocBlocks, deixando os arquivos mais limpos
- Definição da propriedade privada de acesso ao `Service` do módulo diretamente no construct da controller
- Novo nome para função de filtro da listagem no Repository: `defautFiltersQuery`
- Exemplo comentado de filtro na função `defautFiltersQuery`, facilitando adição de próximos
- Uso das novas contantes de paginação e carregamento de relacionamento no Service
- Definição de Constantes das propriedades da Model
  - A ideia é fazer o uso das contantes ao invez de usar diretamente fixo no código as propriedades da Model
  - Exemplo: `$objeto->update([ExemploModel::NOME_PROPRIEDADE => 'valor'])`
- Mapeamento das propriedades no DocBlock da Model, auxiliando a leitura das propriedades pelas IDEs
- Alteração da definição de `protected $fillable` na Model para `protected $guarded`
- Exemplo de validações no Request, com uso de constante da Model na definição da chave do array
