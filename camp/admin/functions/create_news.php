<?php

/**
 * Description: Добавить пользователя в бд
 * @param array $params data
 * @return bool 
 */
function create_news(array $params)
{           
        $news = $params['id'] ? R::load('news', $params['id']) : R::dispense('news');
        
        $news->h1 = htmlspecialchars($params['h1']);
        $news->title = htmlspecialchars($params['title']);
        $news->description = htmlspecialchars($params['description']);
        $news->keywords = htmlspecialchars($params['keywords']);

        $news->header = htmlspecialchars($params['header']);

        $news->text = htmlspecialchars($params['text']);

        $news->date_news = $params['date_news'] ?? date('Y-m-d');
        
        if(!empty($params['photo'])){
                $news->photo = $params['photo'];
        }

        R::store($news);
        }
