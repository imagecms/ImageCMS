### Перелинковка товаров 

- - -

Модуль позволяет привязать товары к обычной странице, 
выводить подвязание товары на этой странице 
и выводить обратную ссылку со страницы товара.
Также модуль позволяет устанавливать дату акстивности связи.

### Получение данных о подвязаных товарах для конкретной страницы

Загрузка модуля mod_link и получение объекта PageLink по id страницы

```php
module('mod_link')->getLinkByPage($pageId)
```

метод возвращает объект PageLink если текущая дата удовлетворяет условия от - до указанные в админке

### Получение данных о странице к которой подвязан конкретный товар

Загрузка подуля mod_link и получение объектов PageLink по id товара

```php
module('mod_link')->getLinksByProduct($productId)
```

метод возвращает массив актуальных по дате объектов PageLink


### Объект PageLink 

Объект PageLink (далее $pl) хранит полную информацию связи:

* ```$pl->getPageData():array``` - данные страницы c дополнительными полями
* ```$pl->getLinkedProducts():array``` - товары страници
* ```$pl->getActiveFrom():integer``` - дата активности от
* ```$pl->getActiveTo():integer``` -  дата активности до
* ```$pl->getActiveFrom($format):string``` - отформатированая дата активности от
* ```$pl->getActiveTo($format):string``` - отформатированая дата активности до
* ```$pl->getPermanent():boolean``` - связь постоянная (даты от и до не используются)

### Пример использования на странице

    {$link = module('mod_link')->getLinkByPage($page['id'])}  
    {if $link}  
        {foreach $link->getLinkedProducts() as $product}  
            <div>  
                <a href="{shop_url('product/'.$product->getUrl())}">{echo $product->getName()}</a>  
            </div>  
        {/foreach}  
    {/if}  

### Пример использования на странице товара


    {$links = module('mod_link')->getLinksByProduct($model->getId())}  
    {if $link}  
        {foreach $links as $link}  
            {$pageData = $link->getPageData()}  
    		<a href="/{$pageData['full_url']}">{echo $pageData['title']}</a>
    		<p>{echo $pageData['prev_text']}</p>
        {/foreach}  
    {/if}  
 



