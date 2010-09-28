<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    if (!function_exists('shop_url'))
    {
        function shop_url($url)
        {
            return site_url('shop/'.$url);
        }
    }

    if (!function_exists('productImageUrl'))
    {
        function productImageUrl($name)
        {
            return media_url('uploads/shop/'.$name.'?'.rand(1,1000));
        }
    }

    if (!function_exists('renderCategoryPath'))
    {
        function renderCategoryPath(SCategory $model)
        {
            $path = $model->buildCategoryPath();
            $size = sizeof($path);

            if ($size > 0)
            {
                echo anchor('shop', ShopCore::t('Главная'));
                echo ' →  '; 

                $n = 0;
                foreach ($path as $category)
                {
                    echo anchor(shop_url('category/' . $category->getFullPath()), ShopCore::encode($category->getName()));
                    if ($n < $size - 1)
                        echo ' →  ';

                    $n++;
                }
            }
            else
            {
                echo anchor('shop', ShopCore::t('Главная'));  
                echo ' →  ';
                echo anchor(shop_url('category/'.$model->getFullPath()), ShopCore::encode($model->getName())); 
            }
        }
    }
