<?php
/**
 * Created by PhpStorm.
 * User: tanvi
 * Date: 8/5/18
 * Time: 7:15 PM
 */
namespace App;
class PostData
{
    /* Data to hold */
    public $id;
    public $user_id;
    public $content;
    public $data;

    /* Node constructor */
    function __construct()
    {

    }
    public function setData($data,$id,$user_id,$content)
    {
        $this->$data->id = $id;
        $this->$data->user_id = $user_id;
        $this->$data->content=$content;
        }

    function getId($node)
    {
        return $this->$node->id;

    }

    function getUserId($node)
    {
        return $this->$node->user_id;

    }

    function getPostId($node)
    {
        return $this->$node->post_id;

    }

    function readNode()
    {
        return $this->data;
    }
}
