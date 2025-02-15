<?php


function getListsByUserId(PDO $pdo, int $userId):array
{
    $query = $pdo->prepare("SELECT list.* , category.name as category_name , 
                            category.icon as category_icon FROM list
                            JOIN category ON category.id = list.category_id 
                            WHERE user_id = :user_id");
    $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $query->execute();
    $lists = $query->fetchAll(PDO::FETCH_ASSOC);

        return $lists;
}

function getListById(PDO $pdo, int $id):array|bool
{
    $query = $pdo->prepare('SELECT * FROM list WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}

function saveList(PDO $pdo, string $title, int $userId, int $categoryId, int $id=null): int|bool
{
    if ($id) {
        //UPDATE
        $query = $pdo->prepare("UPDATE list SET title = :title, category_id = :category_id
                                WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    } else {
        //INSERTION
        $query = $pdo->prepare("INSERT INTO list (title, user_id, category_id)
                                VALUES (:title, :user_id, :category_id)");
        $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
    }    
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $query->bindValue(':user_id', $userId, PDO::PARAM_INT);

    $res = $query->execute();
    if ($res) {
        if ($id) {
            return $id;
        } else {
            return $pdo->lastInsertId();
        }        
    } else {
        return false;
    }
}

function saveListItem(PDO $pdo, string $name, int $listId, bool $status = false, int $id=null): int|bool
{
    if ($id) {
        //UPDATE
        $query = $pdo->prepare("UPDATE item SET name = :name, list_id = :list_id, status = :status
                                WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    } else {
        //INSERTION
        $query = $pdo->prepare("INSERT INTO item (name, list_id, status)
                                VALUES (:name, :list_id, :status)");
    }    
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':list_id', $listId, PDO::PARAM_INT);
    $query->bindValue(':status', $status, PDO::PARAM_BOOL);

    return $query->execute();
}

