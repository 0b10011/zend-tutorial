<?php
namespace Album\Model;

 use Zend\Db\TableGateway\TableGateway;

 class AlbumCommentTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getComment($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveComment(Comment $album)
     {
         $data = array(
             'artist' => $album->artist,
             'title'  => $album->title,
         );

         $id = (int) $album->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getComment($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Comment id does not exist');
             }
         }
     }

     public function deleteComment($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }