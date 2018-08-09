<?php
/**
 * Created by PhpStorm.
 * User: tanvi
 * Date: 8/5/18
 * Time: 6:55 PM
 */
namespace App;
use SplDoublyLinkedList;
use App\PostData;
class PostLink
{

    public $next;
    public $prev;
    public static $list;
    public static $data;
    public static $firstNode;





    public function __construct()
    {
        self::$list = new SplDoublyLinkedList();
        self::$data = new PostData();
    }


    public function isEmpty()
    {
        if ((static::$list->isEmpty()) == true)
            return true;
        else
            return false;

    }

    public function addNode($id, $user_id, $content)
    {
        if (static::$list->isEmpty()) {
            $prev = null;
            $next = null;
            $NextNode = null;
            static::$list->push(static::$data->setData($NextNode, $id, $user_id, $content));
            $current = static::$list->current();
            self::$firstNode = $current;
            $prev = $current;
            static::$list->next();
            $next = static::$list->current();
        } else {
            $NextNode = null;
            $current = static::$list->current();
            static::$list->push(static::$data->setData($NextNode, $id, $user_id, $content));
            $prev = $current;
            static::$list->next();
            $next = static::$list->current();
        }
    }

    public function searchList1($id,$node)
    {

        $SearchNode = $node;
        if (static::$list->isEmpty())
            return false;
        else {
            while (static::$list->valid()) {
                $getid = static::$data->getId($SearchNode);
                if ($getid == $id) {

                    return $SearchNode;
                    break;
                } else
                    {
                    $current = static::$list->current();
                    $SearchNode = $current->next();
                }
            }
            return false;
        }
    }

    public function searchList($id,$node)
    {

        $SearchNode = $node;
                $getid = static::$data->getId($SearchNode);
                if ($getid == $id) {

                    return $SearchNode;

                } else
                {
                    return false;
                }
            }




    public function getCurrent()
    {
        return static::$list->current();
    }

    public function getValid()
    {
        return static::$list->valid();
    }

    function getUserId($node)
    {
        return $node->user_id;

    }

    function getPostId($node)
    {
        return $node->id;

    }

    public function getNext()
    {
        static::$list->next();
        $next=static::$list->current();
        return $next;
    }

}